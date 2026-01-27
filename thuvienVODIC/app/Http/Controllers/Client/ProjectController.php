<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup; // Đừng quên import Model này

class ProjectController extends Controller
{
    /**
     * Hiển thị danh sách dự án kèm chức năng Tra cứu / Lọc
     */
    public function index(Request $request)
    {
        // 1. Khởi tạo query
        $query = Project::query()->with('implementing_unit');

        // 2. Logic Lọc theo từ khóa (Tên, Mã số, Nội dung)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('code_number', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // 3. Logic Lọc theo Nhóm dự án (Dropdown)
        if ($request->filled('group_id')) {
            $query->where('project_group_id', $request->group_id);
        }

        // 4. Logic Sắp xếp
        if ($request->sort == 'newest') {
            $query->orderBy('start_date', 'desc');
        } elseif ($request->sort == 'oldest') {
            $query->orderBy('start_date', 'asc');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            // Mặc định: Mới nhất trước
            $query->orderBy('start_date', 'desc');
        }

        // 5. Phân trang (10 dự án mỗi trang)
        $projects = $query->paginate(10);

        // 6. Lấy danh sách nhóm dự án để hiển thị vào Select Box lọc
        $projectGroups = ProjectGroup::all(); 

        // 7. Trả về View
        return view('client.projects.index', compact('projects', 'projectGroups'));
    }

    /**
     * Xem chi tiết 1 dự án
     */
    public function show($id)
    {
        // Eager load các quan hệ để hiển thị trong trang chi tiết
        $project = Project::with(['documents', 'implementing_unit', 'project_group', 'children', 'parent'])
                          ->findOrFail($id);

        return view('client.projects.show', compact('project'));
    }
}