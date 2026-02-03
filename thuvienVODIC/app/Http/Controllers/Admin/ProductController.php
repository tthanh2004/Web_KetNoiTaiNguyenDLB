<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Project;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('project')->orderBy('id', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get(); 
        return view('admin.products.create', compact('projects'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required|exists:projects,id',
            'thumbnail' => 'nullable|image|max:5120',
            'product_file' => 'nullable|mimes:pdf,zip,rar,docx,xlsx|max:20480',
        ]);

        $data = $request->all();

        // Lưu Thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('products/images', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        // Lưu File sản phẩm
        if ($request->hasFile('product_file')) {
            $file = $request->file('product_file');
            $path = $file->store('products/files', 'public');
            $data['file_path'] = 'storage/' . $path;
            $data['file_extension'] = $file->getClientOriginalExtension();
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required|exists:projects,id',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ nếu có
            if ($product->thumbnail) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->thumbnail));
            }
            $path = $request->file('thumbnail')->store('products/images', 'public');
            $data['thumbnail'] = 'storage/' . $path;
        }

        if ($request->hasFile('product_file')) {
            if ($product->file_path) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->file_path));
            }
            $file = $request->file('product_file');
            $path = $file->store('products/files', 'public');
            $data['file_path'] = 'storage/' . $path;
            $data['file_extension'] = $file->getClientOriginalExtension();
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        return view('admin.products.edit', compact('product', 'projects'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->thumbnail) {
            $oldPath = str_replace('storage/', '', $product->thumbnail);
            Storage::disk('public')->delete($oldPath);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}