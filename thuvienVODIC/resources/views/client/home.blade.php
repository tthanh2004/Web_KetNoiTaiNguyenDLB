@extends('client.layout')

@section('content')

{{-- HERO SECTION MỚI (Bổ sung khối giới thiệu ấn tượng) --}}
<section class="relative h-[550px] flex items-center overflow-hidden bg-slate-900">
    {{-- Ảnh nền biển --}}
    <img src="https://images.unsplash.com/photo-1439405326854-014607f694d7?auto=format&fit=crop&w=1920&q=80" 
         class="absolute inset-0 w-full h-full object-cover opacity-40 grayscale-[20%]" alt="Sea Background">
    <div class="absolute inset-0 bg-gradient-to-r from-blue-950/95 via-blue-900/60 to-transparent"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-block py-1.5 px-4 rounded-full bg-cyan-500/20 border border-cyan-400/30 text-cyan-300 text-xs font-bold uppercase tracking-[0.2em] mb-8">
                Cổng dữ liệu biển quốc gia
            </span>
            <h1 class="text-4xl md:text-7xl font-black text-white mb-8 leading-[1.1] tracking-tighter">
                Số hóa dữ liệu<br><span class="text-cyan-400">Tài nguyên Biển</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-300 mb-10 leading-relaxed font-medium max-w-2xl">
                Truy cập hệ thống quản lý dữ liệu tập trung về môi trường, hải đảo phục vụ công tác nghiên cứu khoa học và phát triển bền vững.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('client.projects.index') }}" class="bg-blue-600 hover:bg-cyan-600 text-white px-8 py-4 rounded-full font-bold shadow-xl shadow-blue-900/40 transition-all transform hover:-translate-y-1">
                    Khám phá dự án <i class="fa-solid fa-arrow-right-long ml-2"></i>
                </a>
                <a href="{{ route('client.request.create') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-md text-white border border-white/30 px-8 py-4 rounded-full font-bold transition-all transform hover:-translate-y-1">
                    Gửi đề nghị dữ liệu
                </a>
            </div>
        </div>
    </div>
</section>

{{-- QUICK STATS SECTION (Các con số ấn tượng) --}}
<section class="py-12 bg-white relative z-20">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 -mt-24">
            @php
                $stats = [
                    ['icon' => 'fa-folder-tree', 'count' => '1.200+', 'label' => 'Dự án', 'color' => 'blue'],
                    ['icon' => 'fa-file-shield', 'count' => '45.000+', 'label' => 'Tài liệu số', 'color' => 'cyan'],
                    ['icon' => 'fa-map-location-dot', 'count' => '3.500+', 'label' => 'Bản đồ số', 'color' => 'emerald'],
                    ['icon' => 'fa-building-columns', 'count' => '120+', 'label' => 'Đơn vị thực hiện', 'color' => 'indigo'],
                ];
            @endphp
            @foreach($stats as $stat)
                <div class="bg-white p-8 rounded-[32px] shadow-2xl shadow-blue-900/5 border border-slate-50 flex flex-col items-center text-center group hover:-translate-y-2 transition-all duration-300">
                    <div class="w-14 h-14 rounded-2xl bg-{{ $stat['color'] }}-50 text-{{ $stat['color'] }}-600 flex items-center justify-center text-2xl mb-4 group-hover:bg-{{ $stat['color'] }}-600 group-hover:text-white transition-all">
                        <i class="fa-solid {{ $stat['icon'] }}"></i>
                    </div>
                    <div class="text-3xl font-black text-slate-800 mb-1 leading-none">{{ $stat['count'] }}</div>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- GIỚI THIỆU CHI TIẾT (Thay đổi giao diện giới thiệu cũ) --}}
<section class="py-24 bg-white">
    <div class="container mx-auto px-6 max-w-5xl">
        <div class="flex flex-col items-center text-center">
            <div class="inline-block p-3 bg-blue-50 rounded-2xl text-blue-700 font-bold text-xs uppercase tracking-widest mb-8">
                Giới thiệu đơn vị
            </div>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-10 leading-tight tracking-tight">
                Về Trung tâm VODIC
            </h2>
            <div class="w-20 h-1.5 bg-blue-700 mb-12 rounded-full opacity-30"></div>
            <p class="text-lg text-slate-600 font-medium leading-[1.8] max-w-4xl italic text-justify md:text-center px-4">
                Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia là đơn vị sự nghiệp công lập trực thuộc Cục Biển và Hải đảo Việt Nam. Chúng tôi đóng vai trò nòng cốt trong việc xây dựng, quản lý và vận hành hệ thống cơ sở dữ liệu biển quốc gia, đồng thời là đầu mối tích hợp, chia sẻ thông tin phục vụ phát triển kinh tế biển bền vững.
            </p>
        </div>
    </div>
</section>

{{-- DỰ ÁN CÔNG KHAI (Sửa Card dự án cho đẹp hơn) --}}
<section class="py-24 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-16 gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-900 uppercase tracking-tight mb-3">
                    Dự án tiêu biểu
                </h2>
                <div class="w-16 h-1 bg-blue-700 rounded-full"></div>
            </div>
            <a href="{{ route('client.projects.index') }}" class="group text-blue-700 hover:text-blue-900 font-bold flex items-center transition-colors px-6 py-3 bg-white rounded-full shadow-sm border border-slate-200">
                Tất cả dự án <i class="fa-solid fa-arrow-right ml-3 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($projects as $project)
            <div class="project-card group bg-white rounded-[40px] shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-slate-100 overflow-hidden cursor-pointer flex flex-col h-full relative"
                 onclick="window.location.href='{{ route('client.project.detail', $project->id) }}'">
                
                {{-- Ảnh dự án --}}
                <div class="h-60 bg-slate-100 relative overflow-hidden flex-shrink-0">
                    @if($project->thumbnail)
                        <img src="{{ $project->thumbnail_url }}" 
                             alt="{{ $project->name }}" 
                             class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-cyan-700"></div>
                        <i class="fa-solid fa-folder-tree text-6xl text-white/20 absolute bottom-4 right-4 group-hover:scale-125 transition-transform duration-500"></i>
                        <div class="relative h-full flex items-center justify-center">
                            <i class="fa-solid fa-folder-open text-5xl text-white/80 filter drop-shadow-lg"></i>
                        </div>
                    @endif
                    
                    {{-- Badge năm --}}
                    <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-md text-blue-950 text-[11px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                        {{ $project->start_year ?? '2024' }}
                    </div>
                </div>

                {{-- Nội dung Card --}}
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-blue-50 text-blue-700 text-[10px] font-black px-3 py-1 rounded-lg uppercase tracking-[0.1em] border border-blue-100">
                            {{ $project->code_number ?? 'DA-NM' }}
                        </span>
                        <div class="h-px bg-slate-100 flex-grow"></div>
                    </div>

                    <h3 class="text-xl font-bold text-slate-900 mb-4 leading-snug group-hover:text-blue-700 transition-colors line-clamp-2 min-h-[56px]">
                        {{ $project->name }}
                    </h3>
                    
                    <p class="text-slate-500 text-sm mb-8 font-medium line-clamp-3 leading-relaxed opacity-90">
                        {{ $project->content ?? 'Hồ sơ tài liệu và kết quả điều tra chi tiết đang được cập nhật trên hệ thống lưu trữ.' }}
                    </p>

                    <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                        <div class="flex items-center text-[11px] text-blue-800 font-bold uppercase tracking-wider max-w-[80%] italic opacity-80">
                            <i class="fa-solid fa-building-columns mr-2 text-blue-500 opacity-60"></i> 
                            <span class="truncate">{{ $project->owner_name }}</span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white group-hover:rotate-[-45deg] transition-all duration-500 shadow-sm border border-slate-100">
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>

                {{-- Thanh Progress Bar dưới cùng khi Hover --}}
                <div class="absolute bottom-0 left-0 h-1.5 bg-gradient-to-r from-blue-600 to-cyan-500 w-0 transition-all duration-[1500ms] group-hover:w-full"></div>
            </div>
            @endforeach
        </div>

    </div>
</section>

@endsection