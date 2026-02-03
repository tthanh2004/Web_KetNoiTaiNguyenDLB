@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-12">
    <div class="container mx-auto px-4 md:px-6">
        
        {{-- HEADER & SEARCH AREA --}}
        <div class="max-w-4xl mx-auto text-center mb-16">
            <span class="inline-block py-1.5 px-4 rounded-full bg-blue-100 text-blue-700 text-[10px] font-black uppercase tracking-[0.2em] mb-4">
                National Marine Database
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">
                Tra cứu Sản phẩm & Kết quả
            </h1>
            <p class="text-slate-500 text-lg mb-10 font-medium italic">
                Hệ thống lưu trữ bản đồ số, báo cáo khoa học và dữ liệu điều tra cơ bản tài nguyên biển.
            </p>

            {{-- Thanh tìm kiếm hiện đại --}}
            <form action="{{ route('client.products.index') }}" method="GET" class="relative group">
                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-blue-600 transition-colors"></i>
                </div>
                <input type="text" 
                       name="keyword" 
                       value="{{ request('keyword') }}"
                       class="w-full bg-white border-none shadow-2xl shadow-blue-900/5 rounded-full py-5 pl-14 pr-40 focus:ring-4 focus:ring-blue-500/10 outline-none text-slate-700 transition-all text-lg font-medium"
                       placeholder="Nhập tên bản đồ, báo cáo, mã dự án...">
                
                <div class="absolute inset-y-2 right-2 flex items-center">
                    <button type="submit" class="bg-slate-900 hover:bg-blue-700 text-white h-full px-8 rounded-full font-bold transition-all shadow-lg active:scale-95 text-sm uppercase tracking-widest">
                        Tìm dữ liệu
                    </button>
                </div>
            </form>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            {{-- MAIN LISTING --}}
            <div class="flex-grow">
                
                {{-- Result Bar --}}
                @if(request('keyword'))
                    <div class="mb-8 flex items-center justify-between bg-blue-50/50 px-6 py-3 rounded-2xl border border-blue-100/50">
                        <span class="text-sm text-slate-600 font-medium">
                            Kết quả cho: <strong class="text-blue-700">"{{ request('keyword') }}"</strong>
                        </span>
                        <span class="text-xs font-bold text-blue-600 bg-white px-3 py-1 rounded-full shadow-sm">
                            {{ $products->total() }} sản phẩm
                        </span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($products as $product)
                    <div class="group bg-white rounded-[2rem] p-5 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 border border-slate-100 flex flex-col relative overflow-hidden">
                        
                        {{-- Icon định dạng file nổi lên trên --}}
                        <div class="absolute top-8 right-8 z-10">
                            @if($product->file_extension)
                                <span class="bg-white/90 backdrop-blur-md border border-slate-100 px-3 py-1 rounded-full text-[9px] font-black text-blue-600 uppercase tracking-widest shadow-sm">
                                    .{{ $product->file_extension }}
                                </span>
                            @endif
                        </div>

                        {{-- Hình ảnh minh họa --}}
                        <div class="h-44 rounded-2xl overflow-hidden mb-6 bg-slate-100">
                            <img src="{{ $product->thumbnail_url }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                                 alt="{{ $product->name }}">
                        </div>

                        {{-- Nội dung sản phẩm --}}
                        <div class="flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[9px] font-black bg-slate-900 text-white px-2 py-0.5 rounded uppercase tracking-tighter">
                                    {{ $product->project->code_number ?? 'Project' }}
                                </span>
                                <span class="text-[10px] font-bold text-slate-400 truncate uppercase tracking-widest">
                                    {{ Str::limit($product->project->name ?? 'Dữ liệu chuyên ngành', 30) }}
                                </span>
                            </div>

                            <h3 class="text-lg font-black text-slate-800 mb-3 leading-tight group-hover:text-blue-700 transition-colors line-clamp-2">
                                {{ $product->name }}
                            </h3>

                            <p class="text-slate-500 text-sm line-clamp-2 mb-6 font-medium italic leading-relaxed">
                                {{ $product->description ?? 'Dữ liệu kết quả điều tra chi tiết đã được số hóa và lưu trữ trên hệ thống VODIC.' }}
                            </p>

                            <div class="mt-auto pt-5 border-t border-slate-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xs">
                                        <i class="fa-solid fa-calendar-day"></i>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Cập nhật: {{ $product->created_at->format('d/m/Y') }}</span>
                                </div>
                                
                                @if($product->file_path)
                                    <a href="{{ asset($product->file_path) }}" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center hover:bg-blue-600 transition-all shadow-lg active:scale-90">
                                        <i class="fa-solid fa-download text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="md:col-span-2 py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fa-solid fa-magnifying-glass text-3xl text-slate-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Không tìm thấy dữ liệu</h3>
                            <p class="text-slate-400 text-sm max-w-sm mx-auto italic">
                                Hãy thử tìm kiếm bằng từ khóa khác hoặc liên hệ quản trị viên để được hỗ trợ.
                            </p>
                            @if(request('keyword'))
                                <a href="{{ route('client.products.index') }}" class="inline-block mt-6 text-blue-600 font-bold text-xs uppercase tracking-widest border-b-2 border-blue-600 pb-1 hover:text-blue-800 transition-colors">
                                    Xem tất cả sản phẩm
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-12 flex justify-center">
                    {{ $products->appends(['keyword' => request('keyword')])->links() }}
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }
</style>
@endsection