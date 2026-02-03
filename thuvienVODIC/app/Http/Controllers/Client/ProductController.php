<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Lấy sản phẩm mới nhất, phân trang 12 item
        $products = Product::with('project')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        return view('client.products.index', compact('products'));
    }

    // Xem chi tiết sản phẩm (nếu cần)
    public function detail($id)
    {
        $product = Product::with('project')->findOrFail($id);
        return view('client.products.detail', compact('product'));
    }

    // Form thêm mới
    public function create()
    {
        // Lấy danh sách dự án để chọn
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        return view('admin.products.create', compact('projects'));
    }

    // Lưu dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',

            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        // Xử lý upload ảnh thumbnail
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('public/products');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    // Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm');
    }

    /**
     * Hiển thị form chỉnh sửa
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Lấy danh sách dự án để hiển thị dropdown chọn lại
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        
        return view('admin.products.edit', compact('product', 'projects'));
    }

    /**
     * Xử lý cập nhật dữ liệu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048', // Ảnh không bắt buộc khi sửa
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        // Xử lý upload ảnh mới (nếu có)
        if ($request->hasFile('thumbnail')) {
            // 1. Xóa ảnh cũ đi để tiết kiệm dung lượng
            if ($product->thumbnail) {
                // Chuyển đường dẫn 'storage/...' thành 'public/...' để xóa
                $oldPath = str_replace('storage/', 'public/', $product->thumbnail);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
            }

            // 2. Lưu ảnh mới
            $path = $request->file('thumbnail')->store('public/products');
            $data['thumbnail'] = str_replace('public/', 'storage/', $path);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
}