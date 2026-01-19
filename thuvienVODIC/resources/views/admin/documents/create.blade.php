@extends('admin.layout.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
        <i class="fa-solid fa-cloud-arrow-up mr-2 text-blue-600"></i> Upload Tài liệu mới
    </h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Thuộc Dự án / Đề án nào? <span class="text-red-500">*</span></label>
            <select name="project_id" required class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2 bg-white">
                <option value="">-- Chọn dự án --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên hiển thị của tài liệu <span class="text-red-500">*</span></label>
            <input type="text" name="title" required placeholder="VD: Báo cáo tổng hợp Giai đoạn 1..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Cơ quan soạn thảo / Tác giả</label>
            <input type="text" name="author_org" placeholder="VD: Viện Nghiên cứu..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Chọn file từ máy tính (PDF, Word, Excel...) <span class="text-red-500">*</span></label>
            <input type="file" name="file_url" required class="w-full text-sm text-slate-500
              file:mr-4 file:py-2 file:px-4
              file:rounded-full file:border-0
              file:text-sm file:font-semibold
              file:bg-blue-50 file:text-blue-700
              hover:file:bg-blue-100
            "/>
            <p class="text-xs text-gray-500 mt-1">Dung lượng tối đa: 20MB.</p>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.documents.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Hủy bỏ</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                <i class="fa-solid fa-upload mr-1"></i> Bắt đầu Upload
            </button>
        </div>
    </form>
</div>
@endsection