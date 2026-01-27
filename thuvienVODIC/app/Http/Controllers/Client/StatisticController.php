<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ImplementingUnit;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function byProject() {
        // Thống kê số lượng dự án theo từng năm
        $projectsByYear = Project::select(DB::raw('YEAR(start_date) as year'), DB::raw('count(*) as total'))
            ->groupBy('year')->orderBy('year', 'desc')->get();
        return view('client.statistics.projects', compact('projectsByYear'));
    }

    public function byUnit() {
        // Lấy danh sách đơn vị kèm số lượng dự án, sắp xếp giảm dần
        // withCount('projects') sẽ tạo ra thuộc tính 'projects_count'
        $units = ImplementingUnit::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->take(20) // Lấy top 20 đơn vị
            ->get();

        return view('client.statistics.units', compact('units'));
    }
}