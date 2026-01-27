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
}