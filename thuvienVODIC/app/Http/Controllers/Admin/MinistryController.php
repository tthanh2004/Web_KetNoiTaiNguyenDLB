<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ministry;

class MinistryController extends Controller
{
    public function index()
    {
        $ministries = Ministry::orderBy('id', 'desc')->paginate(10);
        return view('admin.ministries.index', compact('ministries'));
    }

    public function create()
    {
        return view('admin.ministries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'nullable|string|max:20|unique:ministries,code', 
            'name' => 'required|string|max:255|unique:ministries,name',
        ], 
        [
            'code.unique' => 'Mã này đã tồn tại.',
            'name.required' => 'Tên bộ ngành không được để trống.',
            'name.unique' => 'Tên bộ ngành này đã tồn tại.',
        ]);
        
        Ministry::create($request->all());

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Thêm bộ ngành thành công!');
    }

    public function edit($id)
    {
        $ministry = Ministry::findOrFail($id);
        return view('admin.ministries.edit', compact('ministry'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // Thêm 'nullable' và sửa cú pháp unique
            'code' => 'nullable|string|max:20|unique:ministries,code,'.$id,
            'name' => 'required|string|max:255|unique:ministries,name,'.$id,
        ],
        [
            'code.unique' => 'Mã này đã tồn tại.',
            'name.unique' => 'Tên bộ ngành này đã tồn tại.',
        ]);

        $ministry = Ministry::findOrFail($id);
        $ministry->update($request->all());

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $ministry = Ministry::findOrFail($id);
        
        if($ministry->implementing_units()->count() > 0) {
            return back()->with('error', 'Không thể xóa! Vẫn còn Đơn vị trực thuộc Bộ này.');
        }

        $ministry->delete();

        return redirect()->route('admin.ministries.index')
                         ->with('success', 'Đã xóa bộ ngành!');
    }
}