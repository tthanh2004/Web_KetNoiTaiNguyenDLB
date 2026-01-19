<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Document;
use App\Models\DataRequest;

class DashboardController extends Controller
{
    public function index()
    {
        // Thống kê số lượng để hiển thị cho đẹp
        $stats = [
            'total_projects' => Project::count(),
            'total_documents' => Document::count(),
            'new_requests'   => DataRequest::where('status', 'new')->count(),
            'total_requests' => DataRequest::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}