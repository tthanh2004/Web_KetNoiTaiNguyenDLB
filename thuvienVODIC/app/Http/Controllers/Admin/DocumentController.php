<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index() {
        $documents = Document::with('project')->orderBy('id', 'desc')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    public function create() {
        $projects = Project::all();
        return view('admin.documents.create', compact('projects'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:20480', // Max 20MB
        ]);

        $data = $request->all();

        // Xử lý upload file
        if ($request->hasFile('file_path')) {
            // Lưu vào folder 'documents' trong storage/app/public
            $path = $request->file('file_path')->store('documents', 'public');
            $data['file_path'] = $path;
        }

        Document::create($data);
        return redirect()->route('admin.documents.index')->with('success', 'Upload tài liệu thành công!');
    }

    // --- PHẦN SỬA ---
    public function edit($id) {
        $document = Document::findOrFail($id);
        $projects = Project::all();
        return view('admin.documents.edit', compact('document', 'projects'));
    }

    public function update(Request $request, $id) {
        $document = Document::findOrFail($id);
        
        $request->validate([
            'title' => 'required',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,zip|max:20480',
        ]);

        $data = $request->except('file_path');
        
        if ($request->hasFile('file_path')) {
            // 1. Xóa file cũ
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            // 2. Lưu file mới
            $data['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $document->update($data);
        return redirect()->route('admin.documents.index')->with('success', 'Cập nhật tài liệu thành công!');
    }

    // --- PHẦN XÓA ---
    public function destroy($id) {
        $document = Document::findOrFail($id);

        // Xóa file vật lý trước
        if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Đã xóa tài liệu!');
    }
}