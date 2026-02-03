@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl text-blue-900 font-bold mb-4">Thống kê theo Bộ ngành</h1>
            <p class="text-slate-500 max-w-2xl mx-auto">
                Phân loại các nhiệm vụ, dự án điều tra cơ bản tài nguyên môi trường biển theo cơ quan chủ quản.
            </p>
        </div>

        @if($ministries->count() > 0)
            {{-- Tính Max project count để làm chuẩn 100% cho thanh progress --}}
            @php
                $maxProjectCount = $ministries->max('projects_count') ?: 1;
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ministries as $index => $min)
                    @php
                        // Logic màu sắc ngẫu nhiên đẹp mắt
                        $colors = ['blue', 'red', 'green', 'purple', 'orange', 'teal', 'indigo', 'cyan'];
                        $color = $colors[$index % count($colors)];
                        
                        // Tính phần trăm dựa trên max
                        $percent = ($min->projects_count / $maxProjectCount) * 100;
                    @endphp

                    <a href="{{ route('client.projects.index', ['ministry_id' => $min->id]) }}" 
                       class="block bg-white rounded-xl shadow-sm border border-{{$color}}-100 p-6 relative overflow-hidden group hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        
                        {{-- Icon nền mờ --}}
                        <div class="absolute -top-4 -right-4 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
                            <i class="fa-solid fa-building-columns text-8xl text-{{$color}}-900"></i>
                        </div>

                        <div class="flex items-center gap-4 mb-4 relative z-10">
                            <div class="w-12 h-12 rounded-full bg-{{$color}}-50 flex items-center justify-center text-{{$color}}-600 text-xl font-bold border border-{{$color}}-100">
                                {{ substr($min->code ?? $min->name, 0, 1) }}
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg line-clamp-2 h-14 group-hover:text-{{$color}}-700 transition-colors flex items-center" title="{{ $min->name }}">
                                {{ $min->name }}
                            </h3>
                        </div>

                        <div class="space-y-3 relative z-10">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Số lượng dự án</span>
                                <span class="font-bold text-{{$color}}-700 text-lg">{{ $min->projects_count }}</span>
                            </div>
                            
                            {{-- Thanh Progress Bar --}}
                            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-{{$color}}-500 h-full rounded-full transition-all duration-1000 ease-out" style="width: {{ $percent }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-center mt-3 pt-3 border-t border-dashed border-slate-100">
                                <p class="text-xs text-slate-400 font-medium">
                                    <i class="fa-solid fa-sitemap mr-1"></i> {{ $min->implementing_units_count }} đơn vị trực thuộc
                                </p>
                                
                                <span class="text-xs font-bold text-{{$color}}-600 opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-10px] group-hover:translate-x-0 flex items-center gap-1">
                                    Chi tiết <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-white rounded-xl border border-dashed border-slate-300 shadow-sm max-w-2xl mx-auto">
                <div class="inline-block p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                    <i class="fa-solid fa-building-columns text-4xl"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-700">Chưa có dữ liệu</h3>
                <p class="text-slate-500 text-sm">Hiện tại chưa có thông tin thống kê về các Bộ ngành.</p>
            </div>
        @endif
    </div>
</div>
@endsection