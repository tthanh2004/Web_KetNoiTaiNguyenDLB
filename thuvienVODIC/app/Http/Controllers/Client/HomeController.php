<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\DataRequest;

class HomeController extends Controller
{
    // 1. Trang chủ: Giới thiệu + List Dự án
    public function index()
    {
        // Lấy 6 dự án mới nhất để hiển thị
        $projects = Project::with('implementing_unit')
                           ->orderBy('created_at', 'desc')
                           ->take(6)
                           ->get();

        return view('client.home', compact('projects'));
    }

    // 2. Trang hiển thị Form yêu cầu
    public function createRequest()
    {
        return view('client.request'); // Tạo file này ở Bước 4
    }

    // 3. Xử lý lưu Form
    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'content'  => 'required|string',
            'phone'    => 'nullable|string|max:20',
        ]);

        DataRequest::create($validated);

        return redirect()->route('client.request.create')
                         ->with('success', 'Yêu cầu đã gửi thành công!');
    }

    // 4. Chi tiết dự án
    public function showProject($id)
    {
        $project = Project::with(['documents', 'implementing_unit', 'project_group'])->findOrFail($id);
        return view('client.projects.show', compact('project'));
    }
}