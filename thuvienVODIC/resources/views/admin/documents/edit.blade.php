@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Chỉnh sửa Tài liệu</h1>

<form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow max-w-2xl">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Tên tài liệu <span class="text-red-500">*</span></label>
        <input type="text" name="title" value="{{ $document->title }}" class="w-full border-gray-300 rounded p-2 border" required>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Thuộc Dự án</label>
        <select name="project_id" class="w-full border-gray-300 rounded p-2 border">
            <option value="">-- Tài liệu chung (Không thuộc dự án) --</option>
            @foreach($projects as $proj)
                <option value="{{ $proj->id }}" {{ $document->project_id == $proj->id ? 'selected' : '' }}>
                    {{ $proj->code_number }} - {{ Str::limit($proj->name, 50) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700">File đính kèm</label>
        <div class="mb-2 text-sm text-blue-600">
            Hiện tại: <a href="{{ asset('storage/'.$document->file_path) }}" target="_blank" class="underline">Xem file cũ</a>
        </div>
        <input type="file" name="file_path" class="w-full border-gray-300 rounded p-2 border bg-gray-50">
        <p class="text-xs text-gray-500 mt-1">Chỉ upload nếu muốn thay đổi file cũ.</p>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu thay đổi</button>
</form>
@endsection