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
        // Top 10 đơn vị thực hiện nhiều dự án nhất
        $units = ImplementingUnit::withCount('projects')
            ->orderBy('projects_count', 'desc')
            ->take(10)->get();
        return view('client.statistics.units', compact('units'));
    }
}