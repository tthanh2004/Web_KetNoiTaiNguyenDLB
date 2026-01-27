<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Để xử lý xóa ảnh
use App\Models\Product;
use App\Models\Project;

class ProductController extends Controller
{
    // 1. Danh sách sản phẩm
    public function index()
    {
        $products = Product::with('project')->orderBy('id', 'desc')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    // 2. Form thêm mới
    public function create()
    {
        // Lấy danh sách dự án để chọn
        $projects = Project::select('id', 'name')->get(); 
        return view('admin.products.create', compact('projects'));
    }

    // 3. Xử lý lưu (Store) - Có Upload File
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required|exists:projects,id',
            'file_url' => 'nullable|file|max:20480', // Max 20MB
        ]);

        $data = $request->all();

        // Xử lý Upload file nếu có
        if ($request->hasFile('file_url')) {
            // Lưu vào thư mục 'public/products'
            $path = $request->file('file_url')->store('products', 'public');
            $data['file_url'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Thêm sản phẩm thành công!');
    }

    // 4. Form sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $projects = Project::select('id', 'name')->get();
        return view('admin.products.edit', compact('product', 'projects'));
    }

    // 5. Cập nhật (Update)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'project_id' => 'required',
        ]);

        $data = $request->all();

        // Kiểm tra nếu upload file mới thì xóa file cũ đi
        if ($request->hasFile('file_url')) {
            if ($product->file_url) {
                Storage::disk('public')->delete($product->file_url);
            }
            $path = $request->file('file_url')->store('products', 'public');
            $data['file_url'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa (Destroy)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Xóa file đính kèm khỏi ổ cứng để tiết kiệm dung lượng
        if ($product->file_url) {
            Storage::disk('public')->delete($product->file_url);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Đã xóa sản phẩm!');
    }
}