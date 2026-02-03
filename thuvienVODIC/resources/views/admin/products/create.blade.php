@extends('admin.layout.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Thêm Sản phẩm mới</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Thuộc Dự án nào? <span class="text-red-500">*</span></label>
            <select name="project_id" required class="w-full border p-2 rounded focus:ring-blue-500">
                <option value="">-- Chọn dự án --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">
                        [{{ $project->code_number }}] {{ Str::limit($project->name, 80) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
            <input type="text" name="name" required class="w-full border p-2 rounded" placeholder="VD: Bản đồ địa hình tỉ lệ 1:50000...">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ảnh minh họa (Thumbnail)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full border p-1 rounded bg-gray-50">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả chi tiết</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded" placeholder="Mô tả về quy cách, định dạng, hệ tọa độ..."></textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Hủy bỏ</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-bold rounded hover:bg-blue-700 shadow">
                <i class="fa-solid fa-save mr-1"></i> Lưu sản phẩm
            </button>
        </div>
    </form>
</div>
@endsection