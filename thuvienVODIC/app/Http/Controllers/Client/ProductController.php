<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Khởi tạo query
        $query = Product::query();

        // 1. Logic Tìm kiếm: Nếu có từ khóa 'keyword' gửi lên
        if ($request->has('keyword') && $request->keyword != '') {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', '%' . $keyword . '%')
                  ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        // 2. Logic Lọc theo Dự án (Nếu cần)
        if ($request->has('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        // 3. Lấy dữ liệu + Phân trang (20 sản phẩm/trang)
        // with('project'): Kỹ thuật Eager Loading để lấy luôn tên dự án, tránh query nhiều lần
        $products = $query->with('project')
                          ->orderBy('created_at', 'desc')
                          ->paginate(20);

        // Trả về View
        return view('client.products.index', compact('products'));
    }
}