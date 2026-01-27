<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request) {
        $query = Document::query();
        if ($request->has('keyword')) {
            $query->where('title', 'like', '%'.$request->keyword.'%');
        }
        // Lấy tài liệu, phân trang 20
        $documents = $query->with('project')->orderBy('created_at', 'desc')->paginate(20);
        return view('client.documents.index', compact('documents'));
    }
}