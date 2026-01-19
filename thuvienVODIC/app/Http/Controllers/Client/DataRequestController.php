<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataRequest;

class DataRequestController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'content'  => 'required|string',
            'phone'    => 'nullable|string|max:20',
            'organization' => 'nullable|string|max:255',
        ]);

        // 2. Lưu vào DB (status mặc định là 'new')
        DataRequest::create($validated);

        // 3. Thông báo
        return back()->with('success', 'Yêu cầu của bạn đã được gửi. Chúng tôi sẽ sớm liên hệ lại!');
    }
}