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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($ministries as $index => $min)
                    @php
                        // Logic màu sắc và phần trăm thanh tiến độ
                        $colors = ['blue', 'red', 'green', 'purple', 'orange', 'teal'];
                        $color = $colors[$index % count($colors)];
                        
                        $max = $ministries->first()->projects_count ?? 1;
                        $percent = $max > 0 ? ($min->projects_count / $max) * 100 : 0;
                    @endphp

                    {{-- === THAY ĐỔI TẠI ĐÂY === --}}
                    {{-- 1. Chuyển thẻ div thành thẻ a --}}
                    {{-- 2. Thêm href trỏ về trang danh sách dự án kèm tham số ministry_id --}}
                    <a href="{{ route('client.projects.index', ['ministry_id' => $min->id]) }}" 
                       class="block bg-white rounded-xl shadow-sm border border-{{$color}}-200 p-6 relative overflow-hidden group hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        
                        <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                            <i class="fa-solid fa-building-columns text-6xl text-{{$color}}-900"></i>
                        </div>

                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 rounded-full bg-{{$color}}-100 flex items-center justify-center text-{{$color}}-700 text-xl font-bold">
                                {{ $min->code ?? substr($min->name, 0, 1) }}
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg line-clamp-2 h-14 group-hover:text-{{$color}}-700 transition-colors" title="{{ $min->name }}">
                                {{ $min->name }}
                            </h3>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-500">Số lượng dự án</span>
                                <span class="font-bold text-{{$color}}-700">{{ $min->projects_count }}</span>
                            </div>
                            
                            <div class="w-full bg-slate-100 rounded-full h-2">
                                <div class="bg-{{$color}}-600 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                            
                            <div class="flex justify-between items-end mt-2">
                                <p class="text-xs text-slate-400">
                                    {{ $min->implementing_units_count }} đơn vị trực thuộc.
                                </p>
                                
                                {{-- Thêm icon mũi tên nhỏ để người dùng biết là click được --}}
                                <span class="text-xs font-bold text-{{$color}}-600 opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                    Xem chi tiết <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-xl border border-slate-200 shadow-sm">
                <div class="inline-block p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                    <i class="fa-solid fa-building-columns text-4xl"></i>
                </div>
                <p class="text-slate-500">Chưa có dữ liệu Bộ ngành.</p>
            </div>
        @endif
    </div>
</div>
@endsection