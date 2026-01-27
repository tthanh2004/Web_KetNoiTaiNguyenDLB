@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-serif text-blue-900 font-bold mb-4">Thống kê theo Bộ ngành</h1>
            <p class="text-slate-500 max-w-2xl mx-auto">
                Phân loại các nhiệm vụ, dự án điều tra cơ bản tài nguyên môi trường biển theo cơ quan chủ quản và phối hợp thực hiện.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-earth-asia text-6xl text-blue-900"></i>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 text-xl font-bold">
                        MT
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Bộ Tài nguyên và Môi trường</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Số lượng dự án</span>
                        <span class="font-bold text-blue-700">85</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Đơn vị chủ trì chính các nhiệm vụ điều tra cơ bản.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-shield-halved text-6xl text-red-900"></i>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 text-xl font-bold">
                        QP
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Bộ Quốc phòng</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Số lượng dự án</span>
                        <span class="font-bold text-red-700">32</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-red-600 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Các nhiệm vụ liên quan đến hải quân và biên giới biển.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-wheat-awn text-6xl text-green-900"></i>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-700 text-xl font-bold">
                        NN
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Bộ Nông nghiệp & PTNT</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Số lượng dự án</span>
                        <span class="font-bold text-green-700">24</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Lĩnh vực thủy sản và bảo tồn biển.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-microscope text-6xl text-purple-900"></i>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-700 text-xl font-bold">
                        HL
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Viện Hàn lâm KH&CN VN</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Số lượng dự án</span>
                        <span class="font-bold text-purple-700">15</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-purple-600 h-2 rounded-full" style="width: 20%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Nghiên cứu khoa học chuyên sâu về biển.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-layer-group text-6xl text-gray-900"></i>
                </div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-700 text-xl font-bold">
                        KH
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Các Bộ, Ngành khác</h3>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm">
                        <span class="text-slate-500">Số lượng dự án</span>
                        <span class="font-bold text-gray-700">12</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-gray-500 h-2 rounded-full" style="width: 15%"></div>
                    </div>
                    <p class="text-xs text-slate-400 mt-2">Giao thông, Công thương, và các địa phương.</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection