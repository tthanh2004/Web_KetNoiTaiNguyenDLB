<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Document;
use App\Models\Ministry;
use App\Models\ImplementingUnit;
use App\Models\Project;

class StatisticController extends Controller
{
    /**
     * 1. Thống kê Tài liệu (Trang /thong-ke/tai-lieu)
     */
    public function documents()
    {
        $totalDocs = Document::count();
        
        $mapDocs = Document::where('title', 'like', '%bản đồ%')->count();
        $reportDocs = Document::where('title', 'like', '%báo cáo%')->count();
        $dataDocs = Document::where('title', 'like', '%số liệu%')
                            ->orWhere('title', 'like', '%quan trắc%')->count();

        $recentDocs = Document::with('project.implementing_unit')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('client.statistics.documents', compact('totalDocs', 'mapDocs', 'reportDocs', 'dataDocs', 'recentDocs'));
    }

    /**
     * 2. Thống kê Dự án Tổng quát (Trang /thong-ke/du-an) --> BẠN ĐANG THIẾU HÀM NÀY
     */
    public function projects()
    {
        $total = Project::count();

        $completed = Project::where('status', 'completed')->count();
        $ongoing = Project::where('status', 'ongoing')->count();

        $projectsByYear = Project::select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->limit(5)
            ->get();

        $fields = [
            'Địa chất' => Project::where('name', 'like', '%địa chất%')->count(),
            'Sinh học' => Project::where('name', 'like', '%sinh học%')->orWhere('name', 'like', '%nguồn lợi%')->count(),
            'Môi trường' => Project::where('name', 'like', '%môi trường%')->count(),
            'Hải văn' => Project::where('name', 'like', '%hải văn%')->count(),
        ];

        return view('client.statistics.projects', compact('total', 'completed', 'ongoing', 'projectsByYear', 'fields'));
    }

    /**
     * 3. Thống kê Đề án 47
     */
    public function scheme47()
    {
        // 1. Tìm nhóm dự án "Đề án 47"
        $group = \App\Models\ProjectGroup::where('name', 'like', '%Đề án 47%')->first();
        
        if (!$group) {
            // Xử lý nếu chưa có nhóm này
            return view('client.statistics.scheme47', [
                'total47' => 0, 'percentCompleted' => 0, 'listProjects' => collect(), 'components' => collect()
            ]);
        }

        // 2. Query cơ bản
        $query = \App\Models\Project::where('project_group_id', $group->id);
        
        $total47 = $query->count();
        $percentCompleted = $total47 > 0 ? round($query->avg('progress')) : 0;

        // 3. Danh sách dự án (SỬA LỖI TẠI ĐÂY)
        $listProjects = $query->with('implementing_unit')
                              ->orderBy('start_year', 'desc') // <--- Đổi 'start_date' thành 'start_year' hoặc 'created_at'
                              ->get();

        // 4. Lấy 4 dự án tiêu biểu làm components
        $components = $listProjects->take(4);

        return view('client.statistics.scheme47', compact('total47', 'percentCompleted', 'listProjects', 'components'));
    }

    /**
     * 4. Thống kê Bộ ngành (Trang /thong-ke/bo-nganh)
     */
    public function ministries()
    {
        $ministries = Ministry::withCount(['projects', 'implementing_units'])
            ->orderBy('projects_count', 'desc')
            ->get();

        return view('client.statistics.ministries', compact('ministries'));
    }

    /**
     * 5. Thống kê Đơn vị (Trang /thong-ke/don-vi)
     */
    public function byUnit()
    {
        $units = ImplementingUnit::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->take(20)
            ->get();

        return view('client.statistics.units', compact('units'));
    }
}