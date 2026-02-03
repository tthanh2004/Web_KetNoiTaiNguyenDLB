@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-2xl shadow-lg text-white p-8 md:p-12 mb-10 relative overflow-hidden">
            <i class="fa-solid fa-anchor absolute bottom-0 right-0 text-9xl opacity-10 transform translate-x-10 translate-y-10"></i>
            <div class="relative z-10">
                <span class="inline-block py-1 px-3 rounded bg-yellow-500 text-blue-900 text-xs font-bold uppercase tracking-wider mb-4">
                    Quyết định số 47/2006/QĐ-TTg
                </span>
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Đề án 47</h1>
                <p class="text-blue-100 text-lg max-w-3xl mb-8">
                    Danh sách các dự án thành phần đã được triển khai và hoàn thành trong khuôn khổ đề án tổng thể về điều tra cơ bản tài nguyên – môi trường biển.
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 divide-x divide-blue-700 border-t border-blue-700 pt-6">
                    <div class="px-4">
                        <div class="text-4xl font-bold">{{ $total47 ?? 0 }}</div>
                        <div class="text-xs text-blue-300 uppercase tracking-widest mt-1">Tổng số dự án thành phần</div>
                    </div>
                    <div class="px-4">
                        <div class="text-4xl font-bold">28</div> 
                        <div class="text-xs text-blue-300 uppercase tracking-widest mt-1">Tỉnh/Thành ven biển tham gia</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <h2 class="text-2xl font-bold text-slate-800 border-l-4 border-blue-600 pl-4">Danh mục dự án thành phần</h2>
            
            @if(isset($listProjects) && $listProjects->count() > 0)
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-slate-500 bg-slate-50 border-b text-xs uppercase font-bold">
                            <tr>
                                <th class="px-6 py-4">Mã số</th>
                                <th class="px-6 py-4">Tên dự án điều tra</th>
                                <th class="px-6 py-4">Đơn vị chủ trì thực hiện</th>
                                <th class="px-6 py-4 text-center">Năm Bắt đầu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($listProjects as $p)
                            <tr class="hover:bg-blue-50/50 transition-colors">
                                <td class="px-6 py-4 font-mono text-xs text-blue-600 font-bold">
                                    {{ $p->code_number ?? '---' }}
                                </td>
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    <a href="{{ route('client.project.detail', $p->id) }}" class="hover:text-blue-700 transition-colors">
                                        {{ $p->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-slate-600 uppercase text-xs font-semibold">
                                    {{ $p->implementing_unit->name ?? '---' }}
                                </td>
                                <td class="px-6 py-4 text-center text-slate-500 font-bold">
                                    {{ $p->start_year ?? ($p->start_date ? \Carbon\Carbon::parse($p->start_date)->year : '---') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
                <div class="p-12 text-center bg-white rounded-xl border border-dashed">
                    <p class="text-slate-500 italic">Chưa có dữ liệu dự án cho đề án này.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection