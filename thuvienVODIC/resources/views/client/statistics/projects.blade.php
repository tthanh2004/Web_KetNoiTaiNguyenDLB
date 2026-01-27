@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-serif text-blue-900 font-bold">Tổng quan Dự án Điều tra Cơ bản</h1>
            <p class="text-slate-500">Thống kê toàn bộ dữ liệu dự án tài nguyên môi trường biển qua các thời kỳ.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-600 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Tổng số dự án</div>
                    <div class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($total) }}</div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Đã hoàn thành</div>
                    <div class="text-3xl font-bold text-green-600 mt-1">{{ number_format($completed) }}</div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-yellow-500 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 text-xl">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Đang thực hiện</div>
                    <div class="text-3xl font-bold text-yellow-600 mt-1">{{ number_format($ongoing) }}</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 font-bold text-slate-700">
                    <i class="fa-solid fa-list-ol mr-2"></i> Số lượng dự án theo năm
                </div>
                <div class="p-6">
                    @if(count($projectsByYear) > 0)
                        <div class="space-y-4">
                            @foreach($projectsByYear as $item)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="font-bold text-slate-600">Năm {{ $item->year }}</span>
                                    <span class="text-blue-600 font-bold">{{ $item->count }} dự án</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5">
                                    @php 
                                        $max = $projectsByYear->max('count');
                                        $percent = $max > 0 ? ($item->count / $max) * 100 : 0; 
                                    @endphp
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-slate-400 py-4">Chưa có dữ liệu thống kê theo năm.</div>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 font-bold text-slate-700">
                    <i class="fa-solid fa-chart-pie mr-2"></i> Phân bố lĩnh vực
                </div>
                <div class="p-6">
                    @if(array_sum($fields) > 0)
                        <div class="space-y-4">
                            @foreach($fields as $name => $count)
                            <div>
                                <div class="flex justify-between mb-1 text-sm">
                                    <span class="font-bold text-slate-700">{{ $name }}</span>
                                    <span class="font-bold text-slate-500">{{ $count }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    @php $percent = $total > 0 ? ($count / $total) * 100 : 0; @endphp
                                    <div class="bg-teal-500 h-2 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center text-slate-400 py-4">Chưa có dữ liệu phân loại.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection