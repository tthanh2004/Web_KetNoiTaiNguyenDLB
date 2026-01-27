@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-serif text-blue-900 font-bold mb-3">Thống kê Dự án & Đề án</h1>
            <p class="text-slate-500">Tổng hợp dữ liệu về các nhiệm vụ điều tra cơ bản tài nguyên môi trường biển.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xl">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Tổng số dự án</div>
                    <div class="text-2xl font-bold text-slate-800">158</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600 text-xl">
                    <i class="fa-solid fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Đã hoàn thành</div>
                    <div class="text-2xl font-bold text-slate-800">120</div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 text-xl">
                    <i class="fa-solid fa-spinner"></i>
                </div>
                <div>
                    <div class="text-sm text-slate-500 uppercase font-bold">Đang thực hiện</div>
                    <div class="text-2xl font-bold text-slate-800">38</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 font-bold text-slate-700">
                    <i class="fa-solid fa-list-ol mr-2"></i> Số lượng dự án theo năm
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @for($i = 2024; $i >= 2018; $i--)
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="font-bold text-slate-600">Năm {{ $i }}</span>
                                <span class="text-blue-600 font-bold">{{ rand(5, 20) }} dự án</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ rand(20, 90) }}%"></div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 font-bold text-slate-700">
                    <i class="fa-solid fa-chart-pie mr-2"></i> Tỷ lệ phân loại
                </div>
                <div class="p-6 flex flex-col items-center justify-center">
                    <div class="w-48 h-48 rounded-full border-[16px] border-blue-500 border-r-green-500 border-b-yellow-400 mb-6"></div>
                    <ul class="w-full text-sm space-y-3">
                        <li class="flex justify-between items-center">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full"></span> Điều tra cơ bản</span>
                            <span class="font-bold text-slate-700">65%</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-green-500 rounded-full"></span> Môi trường</span>
                            <span class="font-bold text-slate-700">25%</span>
                        </li>
                        <li class="flex justify-between items-center">
                            <span class="flex items-center gap-2"><span class="w-3 h-3 bg-yellow-400 rounded-full"></span> Khác</span>
                            <span class="font-bold text-slate-700">10%</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection