<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ministry;

class MinistryController extends Controller
{
    public function index() {
        $ministries = Ministry::paginate(10);
        return view('admin.ministries.index', compact('ministries'));
    }

    public function create() {
        return view('admin.ministries.create');
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required', 'code' => 'nullable']);
        Ministry::create($request->all());
        return redirect()->route('admin.ministries.index')->with('success', 'Thêm mới thành công');
    }

    public function edit($id) {
        $ministry = Ministry::findOrFail($id);
        return view('admin.ministries.edit', compact('ministry'));
    }

    public function update(Request $request, $id) {
        $ministry = Ministry::findOrFail($id);
        $ministry->update($request->all());
        return redirect()->route('admin.ministries.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id) {
        Ministry::findOrFail($id)->delete();
        return back()->with('success', 'Đã xóa!');
    }
}