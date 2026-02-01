<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeItem;

class FeeItemController extends Controller
{
    /**
     * Lưu loại phí mới (Xử lý Form trong Modal)
     */
    public function store(Request $request)
    {
        $request->validate([
            'fee_category_id' => 'required|exists:fee_categories,id',
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'price' => 'required|numeric',
        ]);

        FeeItem::create($request->all());

        return back()->with('success', 'Đã thêm phí mới!');
    }

    /**
     * Xóa loại phí
     */
    public function destroy($id)
    {
        $item = FeeItem::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Đã xóa phí!');
    }

    public function edit($id)
    {
        $feeItem = FeeItem::findOrFail($id);
        // Trả về view sửa chi tiết phí
        return view('admin.fees.edit-item', compact('feeItem'));
    }

    /**
     * Lưu cập nhật
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
        ]);

        $feeItem = FeeItem::findOrFail($id);
        
        $feeItem->update([
            'name' => $request->name,
            'unit' => $request->unit,
            'price' => $request->price,
        ]);

        // Sau khi sửa xong, quay lại trang danh sách nhóm phí
        return redirect()->route('admin.fee-categories.index')
                         ->with('success', 'Cập nhật chi tiết phí thành công!');
    }
}