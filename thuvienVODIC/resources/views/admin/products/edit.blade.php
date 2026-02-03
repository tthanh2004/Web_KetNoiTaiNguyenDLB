@extends('admin.layout.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Cập nhật Sản phẩm</h2>
        <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- Bắt buộc phải có dòng này để Laravel hiểu là Update --}}

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Thuộc Dự án nào? <span class="text-red-500">*</span></label>
            <select name="project_id" required class="w-full border p-2 rounded focus:ring-blue-500">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $product->project_id == $project->id ? 'selected' : '' }}>
                        [{{ $project->code_number }}] {{ Str::limit($project->name, 80) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Tên sản phẩm <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ $product->name }}" required class="w-full border p-2 rounded" placeholder="VD: Bản đồ địa hình...">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ảnh minh họa mới (Nếu muốn thay)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full border p-1 rounded bg-gray-50">
                
                @if($product->thumbnail)
                    <div class="mt-2">
                        <p class="text-xs text-gray-500 mb-1">Ảnh hiện tại:</p>
                        <img src="{{ asset($product->thumbnail) }}" class="h-20 w-auto rounded border border-gray-300">
                    </div>
                @endif
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Mô tả chi tiết</label>
            <textarea name="description" rows="4" class="w-full border p-2 rounded">{{ $product->description }}</textarea>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t">
            <button type="submit" class="px-6 py-2 bg-yellow-500 text-white font-bold rounded hover:bg-yellow-600 shadow transition-colors">
                <i class="fa-solid fa-save mr-1"></i> Lưu thay đổi
            </button>
        </div>
    </form>
</div>
@endsection