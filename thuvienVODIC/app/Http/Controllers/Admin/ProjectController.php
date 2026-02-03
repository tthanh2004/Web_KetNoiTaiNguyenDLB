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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            'ministry_id' => 'required_without:parent_id',
            'implementing_unit_id' => 'required_with:parent_id',
            'thumbnail' => 'nullable|image|max:5120',
            'start_year' => 'nullable|integer',
        ]);

        $data = $request->all();

        // 1. Logic Cha/Con
        if ($request->filled('parent_id')) {
            $data['ministry_id'] = null;
        } else {
            $data['implementing_unit_id'] = null;
            $data['parent_id'] = null;
        }

        // 2. Xử lý upload ảnh (QUAN TRỌNG: Thêm tham số 'public')
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            
            // Làm sạch tên file
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            // Lưu vào disk 'public', folder 'projects'
            // Kết quả file nằm ở: storage/app/public/projects/ten-file.png
            $file->storeAs('projects', $filename, 'public');
            
            // Lưu đường dẫn DB (để asset() đọc được từ folder public/storage)
            $data['thumbnail'] = 'storage/projects/' . $filename;
        }

        $data['user_id'] = auth()->id() ?? null;
        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công');
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            'ministry_id' => 'required_without:parent_id',
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
            // Xóa ảnh cũ
            if ($project->thumbnail) {
                // Chuyển 'storage/projects/abc.jpg' thành 'projects/abc.jpg' để xóa trong disk public
                $oldFile = str_replace('storage/', '', $project->thumbnail);
                Storage::disk('public')->delete($oldFile);
            }
            
            $file = $request->file('thumbnail');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            // Lưu file mới vào disk public
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
             $oldPath = str_replace('storage/', 'public/', $project->thumbnail);
             if (Storage::exists($oldPath)) Storage::delete($oldPath);
        }
        $project->delete();
        
        return redirect()->back()->with('success', 'Đã xóa dự án');
    }
}