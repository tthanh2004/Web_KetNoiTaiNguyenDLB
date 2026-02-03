<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::with('project', 'uploader')->orderBy('id', 'desc')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        return view('admin.documents.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'file_path' => 'required|file|max:51200', // Max 50MB
        ]);

        $data = $request->all();

        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            
            // 1. Làm sạch tên file (chỉ giữ lại chữ cái, số, gạch ngang, chấm)
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            // 2. Lưu file vào storage/app/public/documents
            $file->storeAs('documents', $filename, 'public');
            
            // 3. Lưu thông tin vào mảng data
            $data['file_path'] = 'documents/' . $filename;
            $data['type'] = $file->getClientOriginalExtension();
            $data['size'] = round($file->getSize() / 1024, 2); // KB
        }

        $data['uploaded_by'] = auth()->id() ?? null;

        Document::create($data);

        return redirect()->route('admin.documents.index')->with('success', 'Upload tài liệu thành công!');
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $projects = Project::select('id', 'name', 'code_number')->orderBy('created_at', 'desc')->get();
        return view('admin.documents.edit', compact('document', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'project_id' => 'nullable|exists:projects,id',
            'file_path' => 'nullable|file|max:51200', // Nullable khi update
        ]);

        $document->title = $request->title;
        $document->project_id = $request->project_id;

        if ($request->hasFile('file_path')) {
            // Xóa file cũ
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }

            // Upload file mới
            $file = $request->file('file_path');
            $cleanName = preg_replace('/[^A-Za-z0-9\-\_.]/', '_', $file->getClientOriginalName());
            $filename = time() . '_' . $cleanName;
            
            $file->storeAs('documents', $filename, 'public');
            
            $document->file_path = 'documents/' . $filename;
            $document->type = $file->getClientOriginalExtension();
            $document->size = round($file->getSize() / 1024, 2);
        }

        $document->save();

        return redirect()->route('admin.documents.index')->with('success', 'Cập nhật tài liệu thành công!');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }
        
        $document->delete();

        return redirect()->back()->with('success', 'Đã xóa tài liệu!');
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        
        if (!$document->file_path || !Storage::disk('public')->exists($document->file_path)) {
            return redirect()->back()->with('error', 'File không tồn tại trên hệ thống!');
        }

        return Storage::disk('public')->download($document->file_path, $document->title . '.' . $document->type);
    }
}