@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h1 class="text-3xl text-blue-900 font-bold mb-2">Thống kê Tài liệu số hóa</h1>
                <p class="text-slate-500 max-w-2xl">Kho lưu trữ số hóa các báo cáo khoa học, số liệu điều tra cơ bản và bản đồ biển đảo.</p>
            </div>
            <div class="w-full md:w-auto">
                <button class="bg-blue-900 hover:bg-cyan-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Xuất báo cáo tổng hợp
                </button>
            </div>
        </div>

        {{-- KHỐI THỐNG KÊ (ĐÃ SỬA THÀNH LINK) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            
            {{-- 1. TỔNG TÀI LIỆU (Reset lọc) --}}
            <a href="{{ route('client.documents.index') }}" class="block bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity"><i class="fa-solid fa-server text-6xl text-blue-900"></i></div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Tổng tài liệu</div>
                <div class="text-3xl font-bold text-blue-900">{{ number_format($totalDocs) }}</div>
                <div class="text-xs text-green-600 mt-2 font-bold flex items-center gap-1"><i class="fa-solid fa-arrow-trend-up"></i> Cập nhật liên tục</div>
            </a>

            {{-- 2. BẢN ĐỒ (Lọc type=map) --}}
            <a href="{{ route('client.documents.index', ['type' => 'map']) }}" class="block bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity"><i class="fa-solid fa-map text-6xl text-green-700"></i></div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Bản đồ số hóa</div>
                <div class="text-3xl font-bold text-green-700">{{ number_format($mapDocs) }}</div>
                <div class="text-xs text-slate-400 mt-2">Chiếm {{ $totalDocs > 0 ? round(($mapDocs/$totalDocs)*100, 1) : 0 }}% kho dữ liệu</div>
            </a>

            {{-- 3. BÁO CÁO (Lọc type=report) --}}
            <a href="{{ route('client.documents.index', ['type' => 'report']) }}" class="block bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity"><i class="fa-solid fa-file-contract text-6xl text-orange-600"></i></div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Báo cáo khoa học</div>
                <div class="text-3xl font-bold text-orange-600">{{ number_format($reportDocs) }}</div>
                <div class="text-xs text-slate-400 mt-2">Các đề tài, dự án, báo cáo</div>
            </a>

            {{-- 4. DỮ LIỆU (Lọc type=data) --}}
            <a href="{{ route('client.documents.index', ['type' => 'data']) }}" class="block bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group hover:shadow-md hover:-translate-y-1 transition-all">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity"><i class="fa-solid fa-flask text-6xl text-purple-600"></i></div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Dữ liệu quan trắc</div>
                <div class="text-3xl font-bold text-purple-600">{{ number_format($dataDocs) }}</div>
                <div class="text-xs text-slate-400 mt-2">Hóa học, Sinh học, Thủy văn</div>
            </a>
        </div>

        {{-- DANH SÁCH TÀI LIỆU --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i class="fa-solid fa-list"></i> 
                    @if(request('type') == 'map') Danh sách Bản đồ
                    @elseif(request('type') == 'report') Danh sách Báo cáo
                    @elseif(request('type') == 'data') Danh sách Dữ liệu quan trắc
                    @else Danh sách tài liệu mới cập nhật
                    @endif
                </h3>
                
                @if(request('type'))
                    <a href="{{ route('client.documents.index') }}" class="text-xs font-bold text-red-500 hover:underline">
                        <i class="fa-solid fa-times"></i> Xóa bộ lọc
                    </a>
                @endif
            </div>
            
            <div class="overflow-x-auto">
                @if($recentDocs->count() > 0)
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-3">Tên tài liệu</th>
                            <th class="px-6 py-3">Loại hình</th>
                            <th class="px-6 py-3">Đơn vị / Nguồn</th>
                            <th class="px-6 py-3 text-center">Thời gian</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentDocs as $doc)
                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700 line-clamp-2">{{ $doc->title }}</div>
                                <div class="text-xs text-slate-400 mt-1">Mã số: {{ $doc->code_number ?? '---' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if(str_contains(mb_strtolower($doc->title), 'bản đồ') || request('type') == 'map')
                                    <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold border border-green-200">Bản đồ</span>
                                @elseif(str_contains(mb_strtolower($doc->title), 'số liệu') || request('type') == 'data')
                                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-bold border border-blue-200">Số liệu</span>
                                @else
                                    <span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-bold border border-purple-200">Báo cáo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $doc->project->implementing_unit->name ?? 'VODIC' }}
                            </td>
                            <td class="px-6 py-4 text-center text-xs text-slate-500">
                                {{ $doc->created_at->format('d/m/Y') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                @if(method_exists($recentDocs, 'links'))
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $recentDocs->appends(request()->query())->links() }}
                    </div>
                @endif

                @else
                <div class="py-12 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-300 mb-4">
                        <i class="fa-solid fa-folder-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700 mb-1">Chưa có tài liệu</h3>
                    <p class="text-slate-500 text-sm">Không tìm thấy tài liệu phù hợp với bộ lọc.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection