<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    // Trang chủ hiển thị danh sách
    public function index()
    {
        // Lấy dự án công khai, phân trang 12 cái/trang
        $projects = Project::with('implementing_unit')
                           ->orderBy('start_date', 'desc')
                           ->paginate(12);

        return view('client.projects.index', compact('projects'));
    }

    // Xem chi tiết 1 dự án
    public function show($id)
    {
        $project = Project::with(['documents', 'implementing_unit', 'project_group'])
                          ->findOrFail($id);

        return view('client.projects.show', compact('project'));
    }
}