<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;

class ProjectController extends Controller
{
    /**
     * Hiển thị danh sách dự án kèm chức năng Tra cứu / Lọc
     */
    public function index(Request $request)
    {
        // 1. Khởi tạo query và Eager Load
        $query = Project::query()->with(['implementing_unit', 'ministry', 'project_group']);

        // --- CÁC BỘ LỌC MỚI (THÊM VÀO ĐÂY) ---

        // Lọc theo Bộ ngành
        if ($request->filled('ministry_id')) {
            // Tìm các dự án có ministry_id trực tiếp HOẶC đơn vị thực hiện thuộc ministry_id đó
            $minId = $request->ministry_id;
            $query->where(function($q) use ($minId) {
                $q->where('ministry_id', $minId)
                ->orWhereHas('implementing_unit', function($subQ) use ($minId) {
                    $subQ->where('ministry_id', $minId);
                });
            });
        }

        // Lọc theo Đơn vị thực hiện
        if ($request->filled('unit_id')) {
            $query->where('implementing_unit_id', $request->unit_id);
        }

        // Lọc theo Trạng thái (completed, ongoing...)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo Năm bắt đầu
        if ($request->filled('year')) {
            $query->where('start_year', $request->year);
        }

        // --- GIỮ NGUYÊN CÁC LOGIC CŨ ---
        
        // Lọc từ khóa
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('code_number', 'like', "%{$keyword}%")
                ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // Lọc Nhóm dự án
        if ($request->filled('group_id')) {
            $query->where('project_group_id', $request->group_id);
        }

        // Sắp xếp
        if ($request->sort == 'oldest') {
            $query->orderBy('start_year', 'asc'); // Nhớ sửa thành start_year
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // Mặc định
        }

        $projects = $query->paginate(10);
        $projectGroups = ProjectGroup::all(); 

        // Truyền thêm biến hiển thị thông báo đang lọc
        $filterTitle = '';
        if($request->ministry_id) $filterTitle = 'Thuộc Bộ: ' . \App\Models\Ministry::find($request->ministry_id)->name ?? '';
        if($request->unit_id) $filterTitle = 'Đơn vị: ' . \App\Models\ImplementingUnit::find($request->unit_id)->name ?? '';

        return view('client.projects.index', compact('projects', 'projectGroups', 'filterTitle'));
    }

    /**
     * Xem chi tiết 1 dự án
     */
    public function show($id)
    {
        // Eager load: Thêm 'ministry' vào đây nữa
        $project = Project::with([
            'documents', 
            'implementing_unit', 
            'ministry',
            'project_group', 
            'children', 
            'parent'
        ])->findOrFail($id);

        return view('client.projects.show', compact('project'));
    }
}