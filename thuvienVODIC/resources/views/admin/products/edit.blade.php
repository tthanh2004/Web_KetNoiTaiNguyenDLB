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
        @method('PUT')

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
            <input type="text" name="name" value="{{ $product->name }}" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh minh họa</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-2 h-48 flex items-center justify-center relative hover:bg-gray-50 transition-colors">
                <input type="file" name="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                <div id="imgPreview" class="w-full h-full flex items-center justify-center">
                    @if($product->thumbnail)
                        {{-- Dùng thumbnail_url từ Model --}}
                        <img src="{{ $product->thumbnail_url }}" class="w-full h-full object-contain rounded">
                    @else
                        <div class="text-gray-400 flex flex-col items-center">
                            <i class="fa-regular fa-image text-3xl mb-1"></i>
                            <span class="text-xs">Chưa có ảnh</span>
                        </div>
                    @endif
                </div>
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

<script>
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain rounded">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection