<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectGroup;

class ProjectGroupController extends Controller
{
    /**
     * Danh sách nhóm dự án
     */
    public function index()
    {
        // Lấy danh sách kèm số lượng dự án con
        $groups = ProjectGroup::withCount('projects')->orderBy('id', 'desc')->paginate(10);
        return view('admin.project_groups.index', compact('groups'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        return view('admin.project_groups.create');
    }

    /**
     * Lưu dữ liệu
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_groups,name',
        ], [
            'name.required' => 'Tên nhóm dự án không được để trống.',
            'name.unique' => 'Tên nhóm này đã tồn tại.',
        ]);

        ProjectGroup::create($request->all());

        return redirect()->route('admin.project-groups.index')
                         ->with('success', 'Thêm nhóm dự án thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $group = ProjectGroup::findOrFail($id);
        return view('admin.project_groups.edit', compact('group'));
    }

    /**
     * Cập nhật dữ liệu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:project_groups,name,'.$id,
        ]);

        $group = ProjectGroup::findOrFail($id);
        $group->update($request->all());

        return redirect()->route('admin.project-groups.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa nhóm
     */
    public function destroy($id)
    {
        $group = ProjectGroup::findOrFail($id);

        // Kiểm tra nếu nhóm đang có dự án thì không cho xóa để bảo toàn dữ liệu
        if ($group->projects()->count() > 0) {
            return back()->with('error', 'Không thể xóa! Nhóm này đang chứa các Dự án.');
        }

        $group->delete();

        return redirect()->route('admin.project-groups.index')
                         ->with('success', 'Đã xóa nhóm dự án!');
    }
}