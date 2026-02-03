<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectGroup;
// Cần thêm Model Ministry và ImplementingUnit để lấy tên hiển thị bộ lọc
use App\Models\Ministry;
use App\Models\ImplementingUnit;

class ProjectController extends Controller
{
    /**
     * Hiển thị danh sách dự án kèm chức năng Tra cứu / Lọc
     */
    public function index(Request $request)
    {
        // 1. Khởi tạo query và Eager Load (Nên load cả parent để tối ưu query)
        $query = Project::query()->with(['implementing_unit', 'ministry', 'project_group', 'parent']);

        // --- CÁC BỘ LỌC ---

        // 1. Lọc theo Bộ ngành (QUAN TRỌNG: ĐÃ SỬA LOGIC)
        if ($request->filled('ministry_id')) {
            $minId = $request->ministry_id;
            
            $query->where(function($q) use ($minId) {
                // Trường hợp 1: Dự án Cha trực tiếp thuộc Bộ (ministry_id = X)
                $q->where('ministry_id', $minId)
                
                // Trường hợp 2: Dự án thuộc Đơn vị, mà Đơn vị đó thuộc Bộ
                  ->orWhereHas('implementing_unit', function($subQ) use ($minId) {
                      $subQ->where('ministry_id', $minId);
                  })
                  
                // Trường hợp 3: Dự án Con (có parent_id) -> Kiểm tra xem Cha nó có thuộc Bộ này không
                  ->orWhereHas('parent', function($parentQ) use ($minId) {
                      $parentQ->where('ministry_id', $minId);
                  });
            });
        }

        // 2. Lọc theo Đơn vị thực hiện
        if ($request->filled('unit_id')) {
            $query->where('implementing_unit_id', $request->unit_id);
        }

        // 3. Lọc theo Trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 4. Lọc theo Năm bắt đầu
        if ($request->filled('year')) {
            $query->where('start_year', $request->year);
        }

        // 5. Lọc từ khóa (Tên, Mã số, Nội dung)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('code_number', 'like', "%{$keyword}%")
                  ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        // 6. Lọc Nhóm dự án
        if ($request->filled('group_id')) {
            $query->where('project_group_id', $request->group_id);
        }

        // --- SẮP XẾP ---
        if ($request->sort == 'oldest') {
            $query->orderBy('start_year', 'asc');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('created_at', 'desc'); // Mặc định: Mới nhất
        }

        // --- PHÂN TRANG ---
        $projects = $query->paginate(10);
        
        // Lấy danh sách nhóm để đổ vào select box
        $projectGroups = ProjectGroup::all(); 

        // Tạo tiêu đề bộ lọc (Optional: Để hiển thị dòng "Đang lọc theo bộ...")
        $filterTitle = '';
        if($request->filled('ministry_id')) {
            $minName = Ministry::find($request->ministry_id)->name ?? 'Không xác định';
            $filterTitle = 'Thuộc Bộ: ' . $minName;
        }
        if($request->filled('unit_id')) {
            $unitName = ImplementingUnit::find($request->unit_id)->name ?? 'Không xác định';
            $filterTitle = 'Đơn vị: ' . $unitName;
        }

        return view('client.projects.index', compact('projects', 'projectGroups', 'filterTitle'));
    }

    /**
     * Xem chi tiết 1 dự án
     */
    public function show($id)
    {
        // Eager load đầy đủ các quan hệ cần thiết cho trang chi tiết
        $project = Project::with([
            'documents', 
            'implementing_unit', 
            'ministry',
            'project_group', 
            'children', 
            'parent.ministry' // Load thêm ministry của cha để hiển thị nếu cần
        ])->findOrFail($id);

        return view('client.projects.show', compact('project'));
    }
}