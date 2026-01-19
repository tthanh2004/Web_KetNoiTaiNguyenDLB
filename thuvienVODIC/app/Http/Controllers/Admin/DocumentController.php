<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Thư viện xử lý file
use App\Models\Document;
use App\Models\Project;

class DocumentController extends Controller
{
    // Hiển thị danh sách tài liệu
    public function index()
    {
        $documents = Document::with('project')->orderBy('id', 'desc')->paginate(15);
        return view('admin.documents.index', compact('documents'));
    }

    // Form thêm tài liệu (Cần chọn Dự án)
    public function create()
    {
        $projects = Project::select('id', 'name')->get();
        return view('admin.documents.create', compact('projects'));
    }

    // Xử lý Upload file
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'project_id' => 'required',
            'file_url' => 'required|file|max:20480', // Tối đa 20MB
        ]);

        $data = $request->except('file_url');
        $data['user_id'] = Auth::id();

        // Xử lý File Upload
        if ($request->hasFile('file_url')) {
            // Lưu file vào thư mục: storage/app/public/documents
            $path = $request->file('file_url')->store('documents', 'public');
            $data['file_url'] = $path; // Lưu đường dẫn vào DB
            
            // Nếu bạn có thêm cột type (loại file)
            $data['type'] = $request->file('file_url')->getClientOriginalExtension();
        }

        Document::create($data);

        return redirect()->route('admin.documents.index')
                         ->with('success', 'Upload tài liệu thành công!');
    }

    // Xóa tài liệu (Xóa cả trong Database lẫn file thực)
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        // Xóa file trong ổ cứng
        if (Storage::disk('public')->exists($document->file_url)) {
            Storage::disk('public')->delete($document->file_url);
        }

        // Xóa dữ liệu trong DB
        $document->delete();

        return back()->with('success', 'Đã xóa tài liệu và file đính kèm!');
    }
}