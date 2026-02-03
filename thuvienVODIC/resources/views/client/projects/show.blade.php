@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">
        
        {{-- 1. Card Thông tin tổng quan (Banner & Key Info) --}}
        <div class="bg-white shadow-xl rounded-[2rem] overflow-hidden mb-10 border border-slate-100 transition-all duration-300">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                
                {{-- Ảnh đại diện dự án --}}
                <div class="lg:col-span-4 bg-slate-100 relative min-h-[350px] lg:min-h-full group overflow-hidden">
                    @if($project->thumbnail)
                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->name }}" 
                             class="w-full h-full object-cover absolute inset-0 transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-cyan-700 flex flex-col items-center justify-center text-white/50">
                            <i class="fa-solid fa-folder-open text-7xl mb-4 opacity-30"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Dữ liệu tài nguyên biển</span>
                        </div>
                    @endif
                    
                    {{-- Nhãn nhóm dự án --}}
                    <div class="absolute top-6 left-6">
                        <span class="bg-white/90 backdrop-blur-md text-blue-900 text-[10px] font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-lg">
                            <i class="fa-solid fa-layer-group mr-1.5"></i> {{ $project->project_group->name ?? 'Dự án' }}
                        </span>
                    </div>
                </div>

                {{-- Thông tin nhanh --}}
                <div class="lg:col-span-8 p-8 lg:p-12 flex flex-col justify-center">
                    @if($project->parent)
                        <div class="mb-4 flex items-center gap-3">
                            <span class="bg-amber-100 text-amber-700 text-[10px] font-black px-3 py-1 rounded-lg border border-amber-200 uppercase tracking-widest">
                                Dự án thành phần
                            </span>
                        </div>
                    @endif

                    <h1 class="text-3xl lg:text-4xl font-black text-slate-900 mb-6 leading-[1.2] tracking-tight">
                        {{ $project->name }}
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm mb-10">
                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-blue-50 border border-blue-100">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-blue-600 shadow-sm">
                                <i class="fa-solid fa-landmark"></i>
                            </div>
                            <div>
                                <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider block mb-1">Cơ quan chủ trì</span>
                                <span class="text-blue-900 font-bold leading-snug">{{ $project->owner_name }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-600 shadow-sm">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <div>
                                <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider block mb-1">Mã số hồ sơ</span>
                                <span class="text-slate-800 font-mono font-bold">{{ $project->code_number ?? '---' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-red-500 shadow-sm">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <div>
                                <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider block mb-1">Vị trí lưu trữ</span>
                                <span class="text-slate-800 font-bold">{{ $project->cabinet_location ?? 'Đang cập nhật' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-100">
                            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-600 shadow-sm">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <span class="text-slate-400 font-bold text-[10px] uppercase tracking-wider block mb-1">Giá khai thác</span>
                                <span class="text-emerald-700 font-black text-lg">
                                    {{ $project->price > 0 ? number_format($project->price) . ' đ' : 'Liên hệ' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-4">
                        <a href="#documents" class="bg-blue-900 hover:bg-cyan-700 text-white px-10 py-4 rounded-full font-bold shadow-xl shadow-blue-900/20 transition-all flex items-center gap-3">
                            <i class="fa-solid fa-download"></i> Khai thác hồ sơ
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Nội dung chi tiết & Sidebar --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- CỘT TRÁI: NỘI DUNG --}}
            <div class="lg:col-span-8 space-y-10">
                
                {{-- Bảng thông số chi tiết --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                    <h3 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-yellow-500 rounded-full"></span>
                        Thông số kỹ thuật hồ sơ
                    </h3>
                    <div class="overflow-hidden rounded-2xl border border-slate-100">
                        <table class="min-w-full divide-y divide-slate-100 text-sm">
                            <tbody class="divide-y divide-slate-50">
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-500 bg-slate-50/50 w-1/3">Thời gian thực hiện</td>
                                    <td class="px-6 py-4 text-slate-900 font-semibold">{{ $project->start_year }} - {{ $project->end_year ?? 'Nay' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-500 bg-slate-50/50">Lĩnh vực nghiên cứu</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-2 font-bold text-blue-700">
                                            <span class="w-2 h-2 rounded-full" style="background-color: {{ $project->field->color ?? '#3b82f6' }}"></span>
                                            {{ $project->field->name ?? 'Đang cập nhật' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-500 bg-slate-50/50">Kinh phí đầu tư</td>
                                    <td class="px-6 py-4 text-red-600 font-black italic">{{ $project->budget ? number_format($project->budget) . ' VNĐ' : 'Chưa cập nhật' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-500 bg-slate-50/50">Tỷ lệ bản đồ / Dữ liệu</td>
                                    <td class="px-6 py-4 text-slate-900 font-medium">{{ $project->scale ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-500 bg-slate-50/50">Mã định danh thư viện</td>
                                    <td class="px-6 py-4 font-mono text-blue-600 font-bold uppercase tracking-wider">{{ $project->library_code ?? '---' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Nội dung tóm tắt --}}
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                    <h3 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-1.5 h-8 bg-blue-600 rounded-full"></span>
                        Mô tả nội dung & Mục tiêu
                    </h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed text-justify">
                        {!! nl2br(e($project->content)) !!}
                    </div>
                </div>

                {{-- Danh sách File tài liệu --}}
                <div id="documents" class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-200">
                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-black text-slate-800 flex items-center gap-3">
                            <span class="w-1.5 h-8 bg-emerald-500 rounded-full"></span>
                            Tài liệu số hóa kèm theo
                        </h3>
                    </div>

                    @if($project->documents->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($project->documents as $doc)
                                <div class="group flex items-center p-4 rounded-2xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:shadow-lg hover:border-blue-200 transition-all duration-300">
                                    <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-2xl text-red-500 mr-4 group-hover:scale-110 transition-transform">
                                        <i class="fa-regular fa-file-pdf"></i>
                                    </div>
                                    <div class="flex-grow min-w-0 mr-4">
                                        <h4 class="text-sm font-bold text-slate-800 truncate mb-1" title="{{ $doc->title }}">{{ $doc->title }}</h4>
                                        <div class="flex items-center gap-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                                            <span>PDF</span>
                                            <span>•</span>
                                            <span>{{ $doc->file_size ?? 'KB' }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('client.documents.download', $doc->id) }}" class="p-3 text-blue-600 hover:text-white hover:bg-blue-600 rounded-full transition-all">
                                        <i class="fa-solid fa-download"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-slate-50 rounded-[2rem] border border-dashed border-slate-200 text-slate-400">
                            <i class="fa-regular fa-folder-open text-5xl mb-4 opacity-20"></i>
                            <p class="font-medium italic">Các tệp tài liệu số đang được kiểm duyệt và cập nhật.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- CỘT PHẢI: SIDEBAR --}}
            <div class="lg:col-span-4 space-y-8">
                
                {{-- NẾU LÀ DỰ ÁN CHA: HIỂN THỊ CÁC CON --}}
                @if($project->children->count() > 0)
                <div class="bg-white shadow-md rounded-[2rem] p-8 border border-blue-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-16 -mt-16 opacity-50 italic"></div>
                    
                    <h3 class="font-black text-slate-800 mb-6 flex items-center gap-3 relative z-10 uppercase text-sm tracking-widest">
                        <i class="fa-solid fa-sitemap text-blue-600"></i>
                        Dự án thành phần
                    </h3>

                    <div class="space-y-4 relative z-10">
                        @foreach($project->children as $child)
                        <a href="{{ route('client.project.detail', $child->id) }}" 
                           class="group block p-5 bg-slate-50 hover:bg-white hover:shadow-2xl rounded-2xl border border-slate-100 hover:border-blue-300 transition-all duration-500">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-[9px] font-black text-blue-600 uppercase tracking-[0.2em] bg-blue-100/50 px-2 py-1 rounded">
                                    {{ $child->code_number ?? 'MÃ SỐ' }}
                                </span>
                                <i class="fa-solid fa-arrow-right-long text-slate-300 group-hover:text-blue-500 group-hover:translate-x-1 transition-all"></i>
                            </div>
                            <h4 class="font-bold text-sm text-slate-700 group-hover:text-blue-900 leading-snug line-clamp-2 mb-3">
                                {{ $child->name }}
                            </h4>
                            <div class="flex items-center gap-4 text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                                <span><i class="fa-regular fa-calendar-check mr-1"></i> {{ $child->start_year }}</span>
                                <span><i class="fa-solid fa-microchip mr-1"></i> {{ $child->field->name ?? 'Lĩnh vực' }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- NẾU LÀ DỰ ÁN CON: HIỂN THỊ LINK VỀ CHA --}}
                @if($project->parent)
                <div class="bg-gradient-to-br from-blue-900 to-indigo-950 shadow-2xl rounded-[2rem] p-8 text-white group">
                    <div class="flex items-center gap-2 mb-4 text-blue-300">
                        <i class="fa-solid fa-circle-nodes animate-pulse"></i>
                        <span class="text-[10px] font-black uppercase tracking-[0.3em]">Cấu trúc dự án</span>
                    </div>
                    <h3 class="font-bold text-lg mb-6 leading-tight group-hover:text-cyan-300 transition-colors">
                        {{ $project->parent->name }}
                    </h3>
                    <a href="{{ route('client.project.detail', $project->parent_id) }}" 
                       class="flex items-center justify-center gap-3 w-full py-4 bg-white/10 hover:bg-cyan-500 border border-white/20 hover:border-cyan-400 rounded-2xl transition-all font-black text-xs uppercase tracking-widest shadow-lg">
                        <i class="fa-solid fa-turn-up rotate-90"></i> Xem dự án tổng thể
                    </a>
                </div>
                @endif

                {{-- Liên hệ hỗ trợ --}}
                <div class="bg-white shadow-sm rounded-[2rem] p-8 border border-slate-200 text-center">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mx-auto mb-6">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="font-black text-slate-800 mb-2 uppercase text-sm tracking-widest">Hỗ trợ dữ liệu</h3>
                    <p class="text-xs text-slate-500 mb-6 leading-relaxed">Để yêu cầu trích lục dữ liệu chi tiết, vui lòng liên hệ phòng nghiệp vụ.</p>
                    <div class="flex items-center justify-center gap-3 text-blue-900 font-black text-xl bg-slate-50 p-4 rounded-2xl border border-slate-100">
                        <i class="fa-solid fa-phone-volume text-blue-600"></i> +84 24 3761 8118
                    </div>
                </div>

                <div class="text-center pt-4">
                    <a href="{{ route('client.projects.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-blue-700 transition-colors font-bold uppercase text-[10px] tracking-widest">
                        <i class="fa-solid fa-arrow-left-long"></i> Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection