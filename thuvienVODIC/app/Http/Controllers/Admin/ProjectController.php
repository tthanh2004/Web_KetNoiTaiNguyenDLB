<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\Ministry;
use App\Models\ImplementingUnit;
use App\Models\Field; // Thêm Model Field
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['project_group', 'implementing_unit', 'ministry', 'parent', 'field'])
                           ->orderBy('id', 'desc')
                           ->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $ministries = Ministry::all(); 
        $groups = ProjectGroup::all();
        $units = ImplementingUnit::all();
        $fields = Field::all(); // Lấy danh sách Lĩnh vực
        
        $parents = Project::select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.create', compact('groups', 'units', 'parents', 'ministries', 'fields'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            'field_id' => 'required|exists:fields,id', // Validate Lĩnh vực
            'ministry_id' => 'nullable', 
            'implementing_unit_id' => 'nullable',
            'thumbnail' => 'nullable|image|max:5120',
            'start_year' => 'nullable|integer',
        ]);

        // Chỉ lấy các trường cần thiết để tránh dữ liệu rác từ request->all()
        $data = $request->only([
            'name', 'project_group_id', 'field_id', 'code_number', 'library_code',
            'content', 'note', 'start_year', 'end_year', 'handover_time',
            'scale', 'budget', 'price', 'cabinet_location', 'status'
        ]);

        // LOGIC CHA/CON TƯỜNG MINH
        if ($request->filled('parent_id')) {
            $data['parent_id'] = $request->parent_id;
            $data['implementing_unit_id'] = $request->implementing_unit_id;
            $data['ministry_id'] = null; // Bắt buộc null nếu là dự án con
        } else {
            $data['parent_id'] = null;
            $data['implementing_unit_id'] = null;
            $data['ministry_id'] = $request->ministry_id; // Lưu bộ ngành nếu là dự án lớn
        }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            $file->storeAs('projects', $filename, 'public');
            $data['thumbnail'] = 'storage/projects/' . $filename;
        }

        $data['user_id'] = auth()->id() ?? null;
        $data['data_entry_person'] = auth()->user()->name ?? 'Admin';

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công');
    }

    public function edit($id)
    {
        $project = Project::with('children')->findOrFail($id);
        $ministries = Ministry::all();
        $groups = ProjectGroup::all();
        $units = ImplementingUnit::all();
        $fields = Field::all(); // Lấy danh sách Lĩnh vực
        
        $parents = Project::where('id', '!=', $id)
                          ->select('id', 'name', 'code_number')
                          ->orderBy('created_at', 'desc')
                          ->get();

        return view('admin.projects.edit', compact('project', 'groups', 'units', 'parents', 'ministries', 'fields'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'project_group_id' => 'required',
            'field_id' => 'required|exists:fields,id',
            'ministry_id' => 'nullable|exists:ministries,id',
            'implementing_unit_id' => 'nullable|exists:implementing_units,id',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $data = $request->only([
            'name', 'project_group_id', 'field_id', 'code_number', 'start_year', 'end_year', 
            'budget', 'price', 'library_code', 'cabinet_location', 'scale', 
            'content', 'note', 'status'
        ]);

        if ($request->filled('parent_id')) {
            $data['parent_id'] = $request->parent_id;
            $data['implementing_unit_id'] = $request->implementing_unit_id;
            $data['ministry_id'] = null; 
        } else {
            $data['parent_id'] = null;
            $data['implementing_unit_id'] = null; 
            $data['ministry_id'] = $request->ministry_id;
        }

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                $oldFile = str_replace('storage/', '', $project->thumbnail);
                if (Storage::disk('public')->exists($oldFile)) {
                    Storage::disk('public')->delete($oldFile);
                }
            }
            $file = $request->file('thumbnail');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
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
             if (Storage::disk('public')->exists($oldFile)) {
                 Storage::disk('public')->delete($oldFile);
             }
        }
        $project->delete();
        return redirect()->back()->with('success', 'Đã xóa dự án');
    }
}