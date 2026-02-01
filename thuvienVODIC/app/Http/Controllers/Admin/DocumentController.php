<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Storage; // Nhớ import thư viện này

class DocumentController extends Controller
{
    // Hiển thị form upload
    public function index()
    {
        // Lấy danh sách tài liệu mới nhất
        $documents = Document::with('project')->orderBy('id', 'desc')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('admin.documents.create', compact('projects'));
    }

    // XỬ LÝ LƯU FILE (Quan trọng)
    public function store(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'author_org' => 'nullable|string|max:255',
            
            // Lỗi của bạn nằm ở đây: Phải validate đúng tên "file_url" như bên Form
            'file_url' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:20480', // Max 20MB
        ], [
            'file_url.required' => 'Vui lòng chọn file tài liệu.',
            'file_url.mimes' => 'Định dạng file không hỗ trợ (chỉ nhận PDF, Office).',
            'file_url.max' => 'File quá lớn (tối đa 20MB).',
        ]);

        // 2. Xử lý Upload File
        if ($request->hasFile('file_url')) {
            $file = $request->file('file_url');
            
            // Lấy tên gốc của file
            $originalName = $file->getClientOriginalName();
            // Lấy đuôi file (pdf, docx...)
            $extension = $file->getClientOriginalExtension();
            
            // Tạo tên file mới để tránh trùng: timestamp_tengoc
            $fileName = time() . '_' . $originalName;
            
            // Lưu file vào thư mục: storage/app/public/documents
            $path = $file->storeAs('public/documents', $fileName);
            
            // Đường dẫn để lưu vào DB (bỏ chữ public/ đi để link được)
            $dbPath = 'storage/documents/' . $fileName;
        }

        // 3. Lưu vào Database
        Document::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'author_org' => $request->author_org,
            'file_url' => $dbPath ?? null, // Lưu đường dẫn
            'type' => $extension ?? 'file',
            'user_id' => auth()->id(), // Người đang đăng nhập
        ]);

        return redirect()->route('admin.documents.index')
                         ->with('success', 'Upload tài liệu thành công!');
    }
    
    // Hàm xóa tài liệu (kèm xóa file trong ổ cứng)
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $filePath = str_replace('storage/', 'public/', $document->file_url);
        
        if(Storage::exists($filePath)){
            Storage::delete($filePath);
        }

        $document->delete();

        return redirect()->route('admin.documents.index')
                         ->with('success', 'Đã xóa tài liệu!');
    }


    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = str_replace('storage/', 'public/', $document->file_url);

        if (Storage::exists($filePath)) {
            $downloadName = \Illuminate\Support\Str::slug($document->title) . '.' . $document->type;
            
            return Storage::download($filePath, $downloadName);
        }

        return back()->with('error', 'File không tồn tại trên hệ thống!');
    }
}