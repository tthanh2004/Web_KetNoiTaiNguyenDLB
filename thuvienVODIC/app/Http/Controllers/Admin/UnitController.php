<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImplementingUnit;
use App\Models\Ministry; // Import model Bộ ngành (nếu có)

class UnitController extends Controller
{
    /**
     * Danh sách đơn vị
     */
    public function index()
    {
        // Lấy danh sách, kèm thông tin Bộ (nếu có quan hệ)
        $units = ImplementingUnit::with('ministry')->orderBy('id', 'desc')->paginate(10);
        return view('admin.units.index', compact('units'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        $ministries = Ministry::all(); // Lấy danh sách bộ để chọn
        return view('admin.units.create', compact('ministries'));
    }

    /**
     * Lưu dữ liệu mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ministry_id' => 'nullable|exists:ministries,id',
        ]);

        ImplementingUnit::create($request->all());

        return redirect()->route('admin.units.index')
                         ->with('success', 'Thêm đơn vị thành công!');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit($id)
    {
        $unit = ImplementingUnit::findOrFail($id);
        $ministries = Ministry::all();
        return view('admin.units.edit', compact('unit', 'ministries'));
    }

    /**
     * Cập nhật dữ liệu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ministry_id' => 'nullable|exists:ministries,id',
        ]);

        $unit = ImplementingUnit::findOrFail($id);
        $unit->update($request->all());

        return redirect()->route('admin.units.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    /**
     * Xóa đơn vị
     */
    public function destroy($id)
    {
        $unit = ImplementingUnit::findOrFail($id);
        $unit->delete();

        return redirect()->route('admin.units.index')
                         ->with('success', 'Đã xóa đơn vị!');
    }
}