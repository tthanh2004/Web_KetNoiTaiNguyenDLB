<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ministry;

class MinistryController extends Controller
{
    /**
     * Danh sách Bộ ngành
     */
    public function index()
    {
        $ministries = Ministry::orderBy('id', 'desc')->paginate(10);
        return view('admin.ministries.index', compact('ministries'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        return view('admin.ministries.create');
    }

    /**
     * Lưu dữ liệu
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name',
        ], [
            'name.required' => 'Tên bộ ngành không được để trống.',
            'name.unique' => 'Tên bộ ngành này đã tồn tại.',
        ]);

        Ministry::create($request->all());

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Thêm bộ ngành thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $ministry = Ministry::findOrFail($id);
        return view('admin.ministries.edit', compact('ministry'));
    }

    /**
     * Cập nhật dữ liệu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:ministries,name,'.$id,
        ]);

        $ministry = Ministry::findOrFail($id);
        $ministry->update($request->all());

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa dữ liệu
     */
    public function destroy($id)
    {
        $ministry = Ministry::findOrFail($id);
        
        // Kiểm tra xem có đơn vị nào thuộc bộ này không trước khi xóa
        if($ministry->implementing_units()->count() > 0) {
            return back()->with('error', 'Không thể xóa! Vẫn còn Đơn vị trực thuộc Bộ này.');
        }

        $ministry->delete();

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Đã xóa bộ ngành!');
    }
}