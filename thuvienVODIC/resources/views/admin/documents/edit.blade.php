@extends('admin.layout.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Chỉnh sửa Tài liệu</h1>
        <a href="{{ route('admin.documents.index') }}" class="text-gray-500 hover:text-blue-600">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded shadow-lg">
        @csrf
        @method('PUT')

        {{-- Tên tài liệu --}}
        <div class="mb-5">
            <label class="block text-sm font-bold text-gray-700 mb-1">Tên tài liệu <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $document->title) }}" class="w-full border-gray-300 rounded p-2 border focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        {{-- Thuộc dự án --}}
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-1">Thuộc Dự án</label>
            <select name="project_id" class="w-full border-gray-300 rounded p-2 border bg-white">
                <option value="">-- Tài liệu chung (Không thuộc dự án) --</option>
                @foreach($projects as $proj)
                    <option value="{{ $proj->id }}" {{ $document->project_id == $proj->id ? 'selected' : '' }}>
                        [{{ $proj->code_number }}] {{ Str::limit($proj->name, 60) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- File đính kèm --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">File đính kèm</label>
            
            {{-- Hiển thị file cũ nếu có --}}
            @if($document->file_path)
                <div class="mb-3 text-sm text-blue-700 bg-blue-50 p-3 rounded border border-blue-200 flex items-center">
                    <i class="fa-solid fa-file mr-2 text-lg"></i> 
                    <span class="mr-2">File hiện tại:</span>
                    <a href="{{ route('admin.documents.download', $document->id) }}" class="font-bold underline hover:text-blue-900 truncate">
                        {{ basename($document->file_path) }}
                    </a>
                    <span class="text-xs text-gray-500 ml-2">({{ $document->type }})</span>
                </div>
            @endif

            <input type="file" name="file_path" class="w-full text-sm text-slate-500
              file:mr-4 file:py-2 file:px-4
              file:rounded-full file:border-0
              file:text-sm file:font-semibold
              file:bg-violet-50 file:text-violet-700
              hover:file:bg-violet-100
            "/>
            <p class="text-xs text-gray-500 mt-2 italic">
                <i class="fa-solid fa-circle-info"></i> Chỉ upload file mới nếu bạn muốn thay thế file hiện tại.
            </p>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition-colors">
                <i class="fa-solid fa-save mr-1"></i> Lưu thay đổi
            </button>
        </div>
    </form>
</div>
@endsection