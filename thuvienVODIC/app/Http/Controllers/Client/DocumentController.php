<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request) {
        // 1. Thống kê (Giữ nguyên để hiển thị các ô số liệu)
        $totalDocs   = Document::count();
        $mapDocs     = Document::where('title', 'like', '%bản đồ%')->count();
        $reportDocs  = Document::where('title', 'like', '%báo cáo%')->count();
        $dataDocs    = Document::where('title', 'like', '%số liệu%')->count();

        // 2. Query chính
        $query = Document::query()->with('project.implementing_unit');

        // 3. Lọc theo từ khóa
        if ($request->has('keyword') && $request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%'.$request->keyword.'%')
                  ->orWhere('code_number', 'like', '%'.$request->keyword.'%');
            });
        }

        // 4. Lọc theo loại
        if ($request->has('type')) {
            switch ($request->type) {
                case 'map':
                    $query->where('title', 'like', '%bản đồ%');
                    break;
                case 'report':
                    $query->where('title', 'like', '%báo cáo%');
                    break;
                case 'data':
                    $query->where('title', 'like', '%số liệu%');
                    break;
            }
        }

        // 5. Lấy dữ liệu
        // SỬA TẠI ĐÂY: Đổi tên biến thành $documents để khớp với View
        $documents = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('client.documents.index', compact(
            'documents',
            'totalDocs', 
            'mapDocs', 
            'reportDocs', 
            'dataDocs'
        ));
    }
}