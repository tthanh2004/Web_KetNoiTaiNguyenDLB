<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    /**
     * Hiển thị danh sách phí (Trang chính của phần quản lý phí)
     */
    public function index()
    {
        // Lấy tất cả danh mục kèm theo các loại phí con (feeItems)
        $feeCategories = FeeCategory::with('feeItems')->orderBy('id', 'asc')->get();
        
        return view('admin.fees.index', compact('feeCategories'));
    }

    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ], [
            'name.required' => 'Vui lòng nhập tên nhóm phí.',
        ]);

        // 2. Lưu vào Database
        FeeCategory::create([
            'name' => $request->name,
            'order' => $request->order ?? 0,
        ]);

        // 3. Quay lại trang cũ & thông báo
        return back()->with('success', 'Đã thêm nhóm phí mới thành công!');
    }

    /**
     * Xóa nhóm phí
     */
    public function destroy($id)
    {
        $category = FeeCategory::findOrFail($id);
        
        // Xóa nhóm sẽ xóa luôn các phí con
        $category->delete();

        return back()->with('success', 'Đã xóa nhóm phí thành công!');
    }

    /**
     * Mở form chỉnh sửa Nhóm phí
     */
    public function edit($id)
    {
        $feeCategory = \App\Models\FeeCategory::findOrFail($id);
        // Trả về view sửa nhóm (đã tạo ở bước trước)
        return view('admin.fees.edit-category', compact('feeCategory'));
    }

    /**
     * Lưu cập nhật Nhóm phí
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $feeCategory = \App\Models\FeeCategory::findOrFail($id);
        $feeCategory->update([
            'name' => $request->name,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('admin.fee-categories.index')
                         ->with('success', 'Cập nhật nhóm phí thành công!');
    }
}