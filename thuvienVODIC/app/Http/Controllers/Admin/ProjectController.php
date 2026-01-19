<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\ImplementingUnit;

class ProjectController extends Controller
{
    // 1. Danh sách
    public function index()
    {
        $projects = Project::with(['project_group', 'implementing_unit', 'creator'])
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    // 2. Form thêm mới
    public function create()
    {
        $groups = ProjectGroup::all();
        $units  = ImplementingUnit::all();
        return view('admin.projects.create', compact('groups', 'units'));
    }

    // 3. Lưu dữ liệu (Store)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code_number' => 'nullable|max:50',
            'project_group_id' => 'required',
            'implementing_unit_id' => 'required',
            'start_date' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id(); // Lưu Admin tạo

        Project::create($data);

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Thêm dự án thành công!');
    }

    // 4. Form sửa
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $groups = ProjectGroup::all();
        $units  = ImplementingUnit::all();
        return view('admin.projects.edit', compact('project', 'groups', 'units'));
    }

    // 5. Cập nhật (Update)
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'name' => 'required|max:255',
            'project_group_id' => 'required',
            'implementing_unit_id' => 'required',
        ]);

        $project->update($request->all());

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Cập nhật dự án thành công!');
    }

    // 6. Xóa (Destroy)
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        // Do có onDelete('cascade') ở database, các tài liệu con sẽ tự mất
        $project->delete();

        return redirect()->route('admin.projects.index')
                         ->with('success', 'Đã xóa dự án!');
    }
}