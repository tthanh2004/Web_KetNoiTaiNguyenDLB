@extends('admin.layout.app')

@section('content')
<div class="max-w-5xl mx-auto">
    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-slate-800 tracking-tight">Cập nhật Sản phẩm</h2>
            <p class="text-slate-500 text-sm italic">Sản phẩm ID: #{{ $product->id }}</p>
        </div>
        <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-slate-800 font-bold text-sm uppercase tracking-widest flex items-center gap-2 transition-colors">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
            <p class="font-bold mb-1">Vui lòng kiểm tra lại:</p>
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- CỘT TRÁI: THÔNG TIN CHÍNH --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                    
                    {{-- Chọn dự án --}}
                    <div class="mb-6">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Thuộc Dự án nào? *</label>
                        <select name="project_id" required class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-700 appearance-none">
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $product->project_id == $project->id ? 'selected' : '' }}>
                                    [{{ $project->code_number }}] {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tên sản phẩm --}}
                    <div class="mb-6">
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Tên sản phẩm *</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required 
                               class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none font-bold text-slate-800"
                               placeholder="VD: Bản đồ địa hình đáy biển tỷ lệ 1/50.000">
                    </div>

                    {{-- Mô tả --}}
                    <div>
                        <label class="block text-xs font-black text-slate-500 uppercase tracking-widest mb-2">Mô tả chi tiết</label>
                        <textarea name="description" rows="6" 
                                  class="w-full bg-slate-50 border border-slate-100 rounded-2xl py-4 px-6 focus:ring-2 focus:ring-blue-500 outline-none text-slate-600 leading-relaxed">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- CỘT PHẢI: FILE & HÌNH ẢNH --}}
            <div class="space-y-6">
                
                {{-- Ảnh Thumbnail --}}
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Ảnh minh họa</label>
                    <div class="relative group cursor-pointer h-48 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center overflow-hidden transition-all hover:border-blue-400">
                        <input type="file" name="thumbnail" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                        <div id="imgPreview" class="w-full h-full flex items-center justify-center">
                            @if($product->thumbnail)
                                <img src="{{ $product->thumbnail_url }}" class="w-full h-full object-cover">
                            @else
                                <div class="text-center text-slate-300">
                                    <i class="fa-solid fa-camera text-3xl mb-2"></i>
                                    <p class="text-[10px] font-bold uppercase">Thay ảnh</p>
                                </div>
                            @endif
                        </div>
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                            <span class="text-white text-xs font-bold px-3 py-1 border border-white rounded-full">Đổi ảnh</span>
                        </div>
                    </div>
                </div>

                {{-- Tệp tin sản phẩm --}}
                <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 text-center">Tệp tin đính kèm</label>
                    <div class="bg-slate-50 rounded-2xl p-5 border-2 border-slate-100">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-file-arrow-up text-2xl text-blue-500 mb-2"></i>
                            <input type="file" name="product_file" class="text-[11px] text-slate-500 w-full">
                        </div>
                        
                        @if($product->file_path)
                            <div class="mt-4 p-3 bg-blue-50 rounded-xl border border-blue-100">
                                <p class="text-[10px] font-black text-blue-400 uppercase mb-1">File hiện tại:</p>
                                <div class="flex items-center gap-2 truncate">
                                    <i class="fa-solid fa-paperclip text-blue-600 text-xs"></i>
                                    <span class="text-xs font-bold text-blue-700 truncate">{{ basename($product->file_path) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    <p class="text-[10px] text-slate-400 mt-3 text-center italic">Định dạng: PDF, ZIP, DOCX, XLSX (Max 20MB)</p>
                </div>

                {{-- Nút lưu --}}
                <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-[2rem] font-black text-sm uppercase tracking-widest shadow-xl shadow-blue-200 hover:bg-blue-700 transform hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-save"></i> Lưu thay đổi
                </button>

                {{-- Nút Hủy --}}
                <a href="{{ route('admin.products.index') }}" class="block w-full py-4 bg-white text-slate-400 rounded-[2rem] font-bold text-sm uppercase tracking-widest text-center border border-slate-100 hover:bg-slate-50 transition-all">
                    Hủy bỏ
                </a>
            </div>
        </div>
    </form>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection