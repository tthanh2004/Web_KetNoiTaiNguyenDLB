<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ImplementingUnit;
use App\Models\FeeItem;
use App\Models\Product;
use App\Models\Ministry; 
use App\Models\FeeCategory;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $type = $request->input('type', 'all'); 
        
        $unit_id = $request->input('unit_id');
        $ministry_id = $request->input('ministry_id');
        $category_id = $request->input('category_id');

        $units = ImplementingUnit::all();
        $ministries = Ministry::all();
        $feeCategories = FeeCategory::all(); 
        
        $results = null;
        $dataAll = [];

        if ($type == 'all') {
            // --- TÌM TẤT CẢ ---
            
            // 1. Dự án
            $projects = Project::query()->with('implementing_unit');
            if ($keyword) {
                $projects->where(function($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('code_number', 'like', "%{$keyword}%");
                });
            }
            
            // 2. Sản phẩm
            $products = Product::query()->with('project');
            if ($keyword) $products->where('name', 'like', "%{$keyword}%");

            // 3. Phí (SỬA LẠI TÊN QUAN HỆ Ở ĐÂY)
            // Đổi 'category' thành 'feeCategory'
            $fees = FeeItem::query()->with('feeCategory'); 
            if ($keyword) $fees->where('name', 'like', "%{$keyword}%");
            
            $dataAll = [
                'projects' => $projects->orderBy('created_at', 'desc')->take(5)->get(),
                'products' => $products->orderBy('created_at', 'desc')->take(4)->get(),
                // Group by cũng phải theo tên quan hệ mới
                'fees' => $fees->get()->groupBy('feeCategory.name') 
            ];

        } else {
            // --- TÌM CHI TIẾT ---

            if ($type == 'project') {
                // ... (Giữ nguyên logic dự án) ...
                $query = Project::query()->with('implementing_unit');
                if ($keyword) {
                    $query->where(function($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%")
                          ->orWhere('code_number', 'like', "%{$keyword}%");
                    });
                }
                if ($unit_id) $query->where('implementing_unit_id', $unit_id);
                if ($ministry_id) {
                    $query->whereHas('implementing_unit', function($q) use ($ministry_id) {
                        $q->where('ministry_id', $ministry_id);
                    });
                }
                $results = $query->orderBy('created_at', 'desc')->paginate(10);

            } elseif ($type == 'product') {
                // ... (Giữ nguyên logic sản phẩm) ...
                $query = Product::query()->with('project');
                if ($keyword) $query->where('name', 'like', "%{$keyword}%");
                if ($unit_id) {
                    $query->whereHas('project', function($q) use ($unit_id) {
                        $q->where('implementing_unit_id', $unit_id);
                    });
                }
                $results = $query->orderBy('created_at', 'desc')->paginate(12);

            } elseif ($type == 'fee') {
                // SỬA LẠI TÊN QUAN HỆ Ở ĐÂY NỮA
                $query = FeeItem::query()->with('feeCategory'); // Đổi 'category' -> 'feeCategory'

                if ($keyword) $query->where('name', 'like', "%{$keyword}%");
                if ($category_id) $query->where('fee_category_id', $category_id);

                $allFees = $query->get(); 
                // Group by theo tên quan hệ mới
                $results = $allFees->groupBy('feeCategory.name'); 
            }
        }

        return view('client.search', compact(
            'results', 'dataAll', 'units', 'ministries', 'feeCategories',
            'unit_id', 'ministry_id', 'category_id', 
            'keyword', 'type'
        ));
    }
}