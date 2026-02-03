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
        
        $parents = Project::select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.create', compact('groups', 'units', 'parents', 'ministries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            
            // --- SỬA: Cho phép null, không bắt buộc nữa ---
            'ministry_id' => 'nullable', 
            
            'implementing_unit_id' => 'required_with:parent_id',
            'thumbnail' => 'nullable|image|max:5120',
            'start_year' => 'nullable|integer',
        ], [
            // Bạn có thể bỏ thông báo lỗi tùy chỉnh cho ministry_id vì nó không còn required
            'implementing_unit_id.required_with' => 'Vui lòng chọn Đơn vị thực hiện (đối với dự án thành phần).',
        ]);

        $data = $request->all();

        // 1. Logic Cha/Con
        if ($request->filled('parent_id')) {
            // LÀ CON: Bộ phải null
            $data['ministry_id'] = null;
        } else {
            // LÀ CHA: Đơn vị và Parent phải null
            $data['implementing_unit_id'] = null;
            $data['parent_id'] = null;
            // ministry_id sẽ lấy giá trị từ request (có thể là ID hoặc null nếu không chọn)
        }

        // 2. Xử lý upload ảnh
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            $file->storeAs('projects', $filename, 'public');
            $data['thumbnail'] = 'storage/projects/' . $filename;
        }

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
        
        $parents = Project::where('id', '!=', $id)
                          ->select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.edit', compact('project', 'groups', 'units', 'parents', 'ministries'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            
            // --- SỬA: Cho phép null ---
            'ministry_id' => 'nullable',
            
            'implementing_unit_id' => 'required_with:parent_id',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['thumbnail']); 

        // 1. Logic Cha/Con
        if ($request->filled('parent_id')) {
            $data['ministry_id'] = null;
        } else {
            $data['implementing_unit_id'] = null;
            $data['parent_id'] = null;
        }

        // 2. Xử lý ảnh
        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                $oldFile = str_replace('storage/', '', $project->thumbnail);
                Storage::disk('public')->delete($oldFile);
            }
            
            $file = $request->file('thumbnail');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            $file->storeAs('projects', $filename, 'public');
            $data['thumbnail'] = 'storage/projects/' . $filename;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật dự án thành công');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if ($project->thumbnail) {
             $oldFile = str_replace('storage/', '', $project->thumbnail);
             Storage::disk('public')->delete($oldFile);
        }
        $project->delete();
        
        return redirect()->back()->with('success', 'Đã xóa dự án');
    }
}