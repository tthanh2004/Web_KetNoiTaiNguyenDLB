<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\Ministry;
use App\Models\ImplementingUnit;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        // Load các quan hệ: Nhóm, Đơn vị, Bộ, Dự án Cha
        $projects = Project::with(['project_group', 'implementing_unit', 'ministry', 'parent'])
                           ->orderBy('id', 'desc')
                           ->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $ministries = Ministry::all(); 
        $groups = ProjectGroup::all();
        $units = ImplementingUnit::all();
        
        // Lấy danh sách dự án cha
        $parents = Project::select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.create', compact('groups', 'units', 'parents', 'ministries'));
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu theo logic Cha/Con
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            
            // Logic: Nếu không có cha (parent_id trống) -> Bắt buộc chọn Bộ
            'ministry_id' => 'required_without:parent_id',
            
            // Logic: Nếu có cha (parent_id có giá trị) -> Bắt buộc chọn Đơn vị
            'implementing_unit_id' => 'required_with:parent_id',
            
            'thumbnail' => 'nullable|image|max:2048',
            'start_year' => 'nullable|integer|min:1900|max:2100',
        ], [
            'ministry_id.required_without' => 'Vui lòng chọn Bộ chủ trì (đối với dự án cấp Bộ/Lớn).',
            'implementing_unit_id.required_with' => 'Vui lòng chọn Đơn vị thực hiện (đối với dự án thành phần).',
        ]);

        $data = $request->all();

        // 2. Làm sạch dữ liệu (Data Cleaning)
        if ($request->filled('parent_id')) {
            // Nếu là Con: Xóa dữ liệu Bộ (để null), set Đơn vị
            $data['ministry_id'] = null;
        } else {
            // Nếu là Cha: Xóa dữ liệu Đơn vị (để null), set Bộ
            $data['implementing_unit_id'] = null;
            // Đảm bảo parent_id là null chứ không phải chuỗi rỗng
            $data['parent_id'] = null;
        }

        // 3. Xử lý upload ảnh
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/projects');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        // 4. Gán User tạo (nếu có Auth)
        $data['user_id'] = auth()->id() ?? null;

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công');
    }

    public function edit($id)
    {
        $project = Project::with('children')->findOrFail($id);
        
        $ministries = Ministry::all();
        $groups = ProjectGroup::all();
        $units = ImplementingUnit::all();
        
        // Lấy danh sách cha (Trừ chính nó để tránh vòng lặp)
        $parents = Project::where('id', '!=', $id)
                          ->select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.edit', compact('project', 'groups', 'units', 'parents', 'ministries'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        // 1. Validate tương tự Store
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            'ministry_id' => 'required_without:parent_id',
            'implementing_unit_id' => 'required_with:parent_id',
            'thumbnail' => 'nullable|image|max:2048',
            'start_year' => 'nullable|integer|min:1900|max:2100',
        ]);

        $data = $request->all();

        // 2. Làm sạch dữ liệu
        if ($request->filled('parent_id')) {
            $data['ministry_id'] = null;
        } else {
            $data['implementing_unit_id'] = null;
            $data['parent_id'] = null;
        }

        // 3. Xử lý ảnh
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                $oldPath = str_replace('storage/', 'public/', $project->thumbnail);
                if (Storage::exists($oldPath)) Storage::delete($oldPath);
            }
            
            $path = $request->file('thumbnail')->store('public/projects');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật dự án thành công');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->thumbnail) {
             $oldPath = str_replace('storage/', 'public/', $project->thumbnail);
             if (Storage::exists($oldPath)) Storage::delete($oldPath);
        }
        $project->delete();
        
        return redirect()->back()->with('success', 'Đã xóa dự án');
    }
}