@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Thêm Nhóm Dự án mới</h1>

<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.project-groups.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên Nhóm / Chương trình <span class="text-red-500">*</span></label>
            <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" 
                   required placeholder="VD: Đề án 47, Chương trình KC-09...">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả (Tùy chọn)</label>
            <textarea name="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border"></textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.project-groups.index') }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Hủy bỏ</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                <i class="fa-solid fa-save mr-1"></i> Lưu lại
            </button>
        </div>
    </form>
</div>
@endsection