<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;      // <-- Nhớ dòng này
use App\Models\ImplementingUnit;  // <-- Nhớ dòng này

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['project_group', 'implementing_unit', 'creator'])
                           ->orderBy('id', 'desc')
                           ->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    // --- HÀM BẠN ĐANG THIẾU ---
    public function create()
    {
        // Lấy dữ liệu cho dropdown chọn Nhóm và Đơn vị
        $groups = ProjectGroup::all();
        $units = ImplementingUnit::all();
        
        return view('admin.projects.create', compact('groups', 'units'));
    }
    // ---------------------------

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        // Gán người tạo là admin đang đăng nhập
        $data['user_id'] = auth()->id(); 
        
        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Thêm dự án thành công');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        
        // Cần lấy lại danh sách nhóm/đơn vị để hiển thị trong dropdown sửa
        $groups = ProjectGroup::all(); 
        $units = ImplementingUnit::all();

        return view('admin.projects.edit', compact('project', 'groups', 'units'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data = $this->validateData($request);
        
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Đã xóa dự án');
    }

    // Hàm validate chung
    private function validateData($request)
    {
        $data = $request->validate([
            'name' => 'required',
            'code_number' => 'nullable',
            'project_group_id' => 'required',
            'implementing_unit_id' => 'required',
            'content' => 'nullable',
            'start_date' => 'nullable|date',
            'status' => 'required|in:new,ongoing,completed,paused',
            'progress' => 'required|integer|min:0|max:100',
            'completed_at' => 'nullable|date',
        ]);

        if ($data['status'] == 'completed' && empty($data['completed_at'])) {
            $data['completed_at'] = now();
        }
        
        if ($data['status'] != 'completed') {
            $data['completed_at'] = null;
        }

        return $data;
    }
}