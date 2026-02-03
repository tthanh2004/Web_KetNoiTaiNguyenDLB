@extends('admin.layout.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8 flex items-center justify-between">
        <h2 class="text-3xl font-black text-slate-800 tracking-tight">
            {{ isset($product) ? 'Cập nhật Sản phẩm' : 'Thêm Sản phẩm mới' }}
        </h2>
        <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-slate-800 font-bold text-sm uppercase tracking-widest flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Danh sách
        </a>
    </div>

    <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($product)) @method('PUT') @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cột Nội dung --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                    <div class="mb-6">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Tên sản phẩm *</label>
                        <input type="text" name="name" value="{{ $product->name ?? '' }}" required class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-800">
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Thuộc dự án *</label>
                        <select name="project_id" required class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-600">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ (isset($product) && $product->project_id == $project->id) ? 'selected' : '' }}>
                                    [{{ $project->code_number }}] {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Mô tả sản phẩm</label>
                        <textarea name="description" rows="6" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none">{{ $product->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Cột File/Ảnh --}}
            <div class="space-y-6">
                {{-- Ảnh Thumbnail --}}
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Ảnh minh họa</label>
                    <div class="relative group cursor-pointer h-44 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden">
                        {{-- input file --}}
                        <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                        
                        <div id="imgPreview" class="w-full h-full flex items-center justify-center pointer-events-none">
                            @if(isset($product) && $product->thumbnail)
                                <img src="{{ $product->thumbnail_url }}" class="w-full h-full object-cover">
                            @else
                                <div id="placeholderImg" class="text-center text-slate-300">
                                    <i class="fa-solid fa-camera text-3xl mb-2"></i>
                                    <p class="text-[10px] font-bold uppercase">Tải ảnh</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Upload File Sản phẩm --}}
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Tệp tin sản phẩm (PDF, ZIP, DOCX)</label>
                    <div class="bg-slate-50 rounded-2xl p-4 text-center border-2 border-slate-100">
                        <input type="file" name="product_file" class="text-xs text-slate-500">
                        @if(isset($product) && $product->file_path)
                            <div class="mt-2 text-[10px] text-blue-600 font-bold italic">File hiện tại: {{ basename($product->file_path) }}</div>
                        @endif
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-200 hover:bg-black transition-all">
                    Lưu thông tin
                </button>
            </div>
        </div>
    </form>
</div>

{{-- QUAN TRỌNG: JAVASCRIPT ĐỂ HIỂN THỊ ẢNH --}}
<script>
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Thay thế toàn bộ nội dung trong imgPreview bằng thẻ img mới
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover animate-fade-in">`;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection