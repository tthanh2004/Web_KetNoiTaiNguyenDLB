@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-5xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl text-blue-900 font-bold mb-4">Thống kê theo Đơn vị thực hiện</h1>
            <p class="text-slate-500">Xếp hạng các đơn vị dựa trên tổng số lượng dự án điều tra cơ bản đã hoàn thành và lưu trữ.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-700 uppercase tracking-wide text-sm">Bảng tổng hợp đơn vị</h3>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Top 20 Đơn vị</span>
            </div>

            <div class="p-6 md:p-8">
                @if($units->count() > 0)
                    @php $maxProjects = $units->first()->projects_count; @endphp
                    <div class="space-y-6">
                        @foreach($units as $index => $unit)
                        <div class="relative group">
                            <div class="flex justify-between items-center mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm 
                                        {{ $index < 3 ? 'bg-blue-600 text-white shadow-sm' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $index + 1 }}
                                    </div>
                                    <a href="{{ route('client.projects.index', ['unit_id' => $unit->id]) }}" class="font-bold text-slate-700 hover:text-blue-700 transition-colors">
                                        {{ $unit->name }}
                                    </a>
                                </div>
                                <span class="text-sm font-bold text-blue-700 whitespace-nowrap ml-4">
                                    {{ number_format($unit->projects_count) }} dự án
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full transition-all duration-1000" 
                                     style="width: {{ $maxProjects > 0 ? ($unit->projects_count / $maxProjects) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10 text-slate-400">Chưa có dữ liệu.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection