<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;
use App\Models\Ministry;
use App\Models\ImplementingUnit;

class ProjectController extends Controller
{
    /**
     * Hiển thị danh sách dự án kèm chức năng Tra cứu / Lọc
     */
    public function index(Request $request)
    {
        // 1. Lấy danh sách nhóm cho Sidebar
        $groups = ProjectGroup::withCount(['projects' => function($q) {
            $q->whereNull('parent_id'); 
        }])->get();

        // 2. Khởi tạo query và THÊM withCount('children')
        $query = Project::query()
            ->whereNull('parent_id')
            ->withCount('children') // <--- PHẢI CÓ DÒNG NÀY ĐỂ HIỂN THỊ SỐ LƯỢNG
            ->with(['implementing_unit', 'project_group', 'ministry', 'field']);

        // 3. Lọc theo nhóm
        $currentGroup = null;
        if ($request->filled('group_id')) {
            $query->where('project_group_id', $request->group_id);
            $currentGroup = ProjectGroup::find($request->group_id);
        }

        // 4. Lọc từ khóa
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('code_number', 'like', "%{$keyword}%");
            });
        }

        // 5. Phân trang
        $projects = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('client.projects.index', compact('projects', 'groups', 'currentGroup'));
    }
    /**
     * Xem chi tiết 1 dự án
     */
    public function show($id)
    {
        $project = Project::with([
            'documents', 
            'implementing_unit', 
            'ministry',
            'project_group', 
            'children', 
            'parent.ministry'
        ])->findOrFail($id);

        return view('client.projects.show', compact('project'));
    }
}