@extends('client.layout')

@section('content')
<div class="bg-white min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-5xl">
        
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl text-blue-900 mb-2 font-bold">
                Tra cứu sản phẩm & Tài liệu
            </h1>
            <p class="text-slate-500 mb-8">Hệ thống cơ sở dữ liệu tài nguyên, môi trường biển và hải đảo quốc gia.</p>

            <form action="{{ route('client.products.index') }}" method="GET" class="relative max-w-3xl">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                    </div>
                    <input type="text" 
                           name="keyword" 
                           value="{{ request('keyword') }}"
                           class="w-full border border-slate-300 rounded-full py-3.5 pl-12 pr-32 shadow-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none text-slate-700 transition-all text-base"
                           placeholder="Nhập tên sản phẩm, báo cáo, bản đồ cần tìm...">
                    
                    <div class="absolute inset-y-0 right-1.5 flex items-center">
                        <button type="submit" class="bg-blue-900 hover:bg-cyan-700 text-white px-6 py-2 rounded-full font-medium transition-colors shadow-md text-sm">
                            Tìm kiếm
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            
            <div class="flex-grow">
                
                @if(request('keyword') || $products->total() > 0)
                    <div class="mb-6 text-sm text-slate-500 border-b border-slate-100 pb-2">
                        @if(request('keyword'))
                            Kết quả tìm kiếm cho từ khóa: <strong>"{{ request('keyword') }}"</strong> - 
                        @endif
                        <span class="text-rose-600 font-medium italic">
                            Tìm thấy {{ $products->total() }} sản phẩm
                        </span>
                        <span class="text-slate-400">({{ round(microtime(true) - LARAVEL_START, 2) }} giây)</span>
                    </div>
                @endif

                <div class="space-y-8">
                    @forelse($products as $product)
                    <div class="group">
                        <div class="flex items-center gap-2 text-xs mb-1">
                            <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2 py-0.5 rounded">
                                San Pham
                            </span>
                            <i class="fa-solid fa-angle-right text-slate-300 text-[10px]"></i>
                            @if($product->project)
                                <a href="{{ route('client.project.detail', $product->project_id) }}" class="text-slate-600 hover:text-blue-700 hover:underline truncate max-w-md" title="{{ $product->project->name }}">
                                    {{ $product->project->name }}
                                </a>
                            @else
                                <span class="text-slate-400 italic">Dự án không xác định</span>
                            @endif
                        </div>

                        <h3 class="text-xl font-medium mb-1">
                            <a href="#" class="text-[#1a0dab] hover:underline decoration-blue-800 underline-offset-2 visited:text-[#681da8]">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <p class="text-slate-600 text-sm leading-relaxed line-clamp-2 mb-2">
                            {{ $product->description ?? 'Không có mô tả chi tiết cho sản phẩm này.' }}
                        </p>

                        @if($product->file_url)
                            <div class="flex items-center gap-4 mt-1">
                                <a href="{{ Storage::url($product->file_url) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-bold text-cyan-700 hover:text-cyan-900 hover:bg-cyan-50 px-2 py-1 rounded transition-colors">
                                    <i class="fa-solid fa-file-arrow-down"></i> Tải tài liệu gốc
                                </a>
                            </div>
                        @endif
                    </div>
                    @empty
                        <div class="py-10 text-center bg-slate-50 rounded-xl border border-dashed border-slate-200">
                            <div class="inline-block p-4 bg-white rounded-full shadow-sm mb-4">
                                <i class="fa-solid fa-magnifying-glass text-4xl text-slate-300"></i>
                            </div>
                            <h3 class="text-lg font-medium text-slate-700 mb-2">Không tìm thấy kết quả nào</h3>
                            <p class="text-slate-500 text-sm max-w-md mx-auto">
                                Hãy thử sử dụng từ khóa khác chung chung hơn hoặc kiểm tra lại lỗi chính tả.
                            </p>
                            @if(request('keyword'))
                                <a href="{{ route('client.products.index') }}" class="inline-block mt-4 text-blue-600 hover:underline text-sm font-medium">
                                    Xóa bộ lọc tìm kiếm
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $products->appends(['keyword' => request('keyword')])->links() }}
                </div>
            </div>

            <div class="w-full md:w-64 flex-none hidden md:block">
                <div class="sticky top-24">
                    <div class="bg-slate-50 rounded-lg p-5 border border-slate-100">
                        <h4 class="font-bold text-slate-700 mb-4 text-sm uppercase tracking-wide">Mẹo tìm kiếm</h4>
                        <ul class="space-y-3 text-sm text-slate-600">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Nhập mã hiệu dự án (VD: 47, KHCN...) để tìm nhanh.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-check text-green-500 mt-1"></i>
                                <span>Tìm theo địa danh (VD: Hải Phòng, Trường Sa).</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection