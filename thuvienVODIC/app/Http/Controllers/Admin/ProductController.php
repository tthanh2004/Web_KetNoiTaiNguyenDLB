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
            'thumbnail' => 'nullable|image|max:5120', // 5MB
        ]);

        $data = $request->all();

        // Xử lý Upload Ảnh (Thumbnail)
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            
            // Làm sạch tên file
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            // Lưu vào storage/app/public/products
            $file->storeAs('products', $filename, 'public');
            
            // Lưu đường dẫn vào DB
            $data['thumbnail'] = 'storage/products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        return view('admin.products.edit', compact('product', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        $data = $request->except(['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            // Xóa ảnh cũ
            if ($product->thumbnail) {
                $oldPath = str_replace('storage/', '', $product->thumbnail);
                Storage::disk('public')->delete($oldPath);
            }

            $file = $request->file('thumbnail');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            $file->storeAs('products', $filename, 'public');
            $data['thumbnail'] = 'storage/products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
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