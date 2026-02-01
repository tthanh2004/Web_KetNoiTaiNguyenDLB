@extends('client.layout')

@section('content')

<section class="py-16 md:py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none" 
         style="background-image: radial-gradient(#005a8d 1px, transparent 1px); background-size: 24px 24px;"></div>
    
    <div class="container mx-auto px-6 max-w-5xl text-center relative z-10">
        <h1 class="text-4xl md:text-6xl font-serif text-slate-900 mb-6 tracking-tight leading-tight">
            Trang chủ
        </h1>
        <div class="w-24 h-1.5 bg-blue-800 mx-auto mb-10 rounded-full opacity-80"></div>
        
        <div class="prose prose-lg mx-auto text-slate-600 font-light leading-relaxed text-justify md:text-center">
            <p>
                Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia là đơn vị sự nghiệp công lập trực thuộc Cục Biển và Hải đảo Việt Nam, có chức năng xây dựng, quản lý hệ thống thông tin, cơ sở dữ liệu tài nguyên, môi trường biển và hải đảo quốc gia; tiếp nhận, lưu trữ, cập nhật, khai thác, sử dụng và tích hợp, trao đổi, chia sẻ dữ liệu tài nguyên, môi trường biển và hải đảo; thực hiện các hoạt động tư vấn, dịch vụ trong lĩnh vực thông tin, dữ liệu biển và hải đảo theo quy định của pháp luật.
            </p>
        </div>
    </div>
</section>

<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="container mx-auto px-6">
        
        <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-10 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 uppercase tracking-wide border-l-[6px] border-blue-800 pl-4 leading-none">
                    Các dự án công khai
                </h2>
            </div>
            <a href="#" class="text-blue-700 hover:text-blue-900 font-semibold group flex items-center transition-colors">
                Xem tất cả <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <div class="project-card group bg-white rounded-2xl shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden cursor-pointer relative flex flex-col h-full"
                 data-url="{{ route('client.project.detail', $project->id) }}">
                
                <div class="h-48 bg-gradient-to-br from-slate-50 to-blue-50 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                    <i class="fa-solid fa-folder-open text-9xl text-white absolute -bottom-6 -right-6 opacity-60"></i>
                    <i class="fa-solid fa-folder-open text-5xl text-blue-200 group-hover:text-blue-600 group-hover:scale-110 transition-all duration-500 relative z-10 filter drop-shadow-sm"></i>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <div class="flex justify-between items-start mb-3">
                        <span class="bg-blue-50 text-blue-700 border border-blue-100 text-[10px] font-bold px-2.5 py-1 rounded uppercase tracking-wider">
                            {{ $project->code_number ?? 'DA-MỚI' }}
                        </span>
                        <span class="text-xs text-slate-400 flex items-center">
                            <i class="fa-regular fa-calendar mr-1.5"></i> {{ date('d/m/Y', strtotime($project->start_date)) }}
                        </span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900 mb-3 leading-snug group-hover:text-blue-700 transition-colors line-clamp-2" title="{{ $project->name }}">
                        {{ $project->name }}
                    </h3>
                    
                    <p class="text-slate-500 text-sm mb-6 font-light line-clamp-3 leading-relaxed">
                        {{ $project->content ?? 'Đang cập nhật nội dung tóm tắt cho dự án này...' }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-dashed border-slate-100 flex items-center justify-between">
                        <div class="flex items-center text-xs text-slate-500 font-medium truncate max-w-[75%]">
                            <i class="fa-solid fa-building-columns mr-2 text-slate-400"></i> 
                            <span class="truncate">{{ $project->implementing_unit->name ?? 'Bộ TN&MT' }}</span>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-0 left-0 h-1.5 bg-blue-600 w-0 transition-all duration-[1500ms] ease-linear group-hover:w-full z-20"></div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.project-card');
        let hoverTimer;

        cards.forEach(card => {
            // Mouse Enter
            card.addEventListener('mouseenter', function() {
                const url = this.getAttribute('data-url');
                hoverTimer = setTimeout(() => {
                    window.location.href = url; 
                }, 1500); 
            });

            // Mouse Leave
            card.addEventListener('mouseleave', function() {
                clearTimeout(hoverTimer);
            });

            // Click
            card.addEventListener('click', function() {
                window.location.href = this.getAttribute('data-url');
            });
        });
    });
</script>

@endsection