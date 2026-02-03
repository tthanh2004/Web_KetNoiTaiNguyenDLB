<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $documents = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('client.documents.index', compact(
            'documents',
            'totalDocs', 
            'mapDocs', 
            'reportDocs', 
            'dataDocs'
        ));
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        
        // Xử lý đường dẫn file
        $path = $document->file_path;
        
        if (strpos($path, 'storage/') === 0) {
            $path = str_replace('storage/', '', $path);
        }

        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->download($path, $document->title . '.' . $document->type);
        }

        return redirect()->back()->with('error', 'File không tồn tại hoặc đã bị xóa!');
    }

    public function show($id)
    {
        // Load tài liệu cùng với quan hệ project và đơn vị (ministry)
        $document = Document::with(['project.ministry'])->findOrFail($id);
        return view('client.documents.detail', compact('document'));
    }
}