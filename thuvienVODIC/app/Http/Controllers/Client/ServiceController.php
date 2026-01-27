<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\FeeCategory;

class ServiceController extends Controller
{
    public function fees() {
        // Lấy danh sách phí để hiển thị bảng giá
        $feeCategories = FeeCategory::with('feeItems')->orderBy('order')->get();
        return view('client.services.fees', compact('feeCategories'));
    }

    public function other() {
        return view('client.services.other');
    }
}