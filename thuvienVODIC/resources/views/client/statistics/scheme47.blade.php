@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="bg-gradient-to-r from-blue-900 to-blue-800 rounded-2xl shadow-lg text-white p-8 md:p-12 mb-10 relative overflow-hidden">
            <i class="fa-solid fa-anchor absolute bottom-0 right-0 text-9xl opacity-10 transform translate-x-10 translate-y-10"></i>
            <i class="fa-solid fa-map absolute bottom-4 right-4 text-blue-800 text-9xl opacity-20"></i>
            
            <div class="relative z-10">
                <span class="inline-block py-1 px-3 rounded bg-yellow-500 text-blue-900 text-xs font-bold uppercase tracking-wider mb-4">
                    Quyết định số 47/2006/QĐ-TTg
                </span>
                <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
                    Đề án 47
                </h1>
                <p class="text-blue-100 text-lg max-w-3xl mb-8">
                    "Đề án tổng thể về điều tra cơ bản và quản lý tài nguyên – môi trường biển đến năm 2010, tầm nhìn đến năm 2020".
                </p>
                
                <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-blue-700 border-t border-blue-700 pt-6">
                    <div class="px-4 text-center md:text-left">
                        <div class="text-3xl font-bold">{{ $total47 ?? 0 }}</div>
                        <div class="text-xs text-blue-300 uppercase">Dự án thành phần</div>
                    </div>
                    <div class="px-4 text-center md:text-left">
                        <div class="text-3xl font-bold">{{ $percentCompleted ?? 0 }}%</div>
                        <div class="text-xs text-blue-300 uppercase">Tỷ lệ hoàn thành</div>
                    </div>
                    <div class="px-4 text-center md:text-left">
                        <div class="text-3xl font-bold">28</div> 
                        <div class="text-xs text-blue-300 uppercase">Tỉnh/Thành ven biển</div>
                    </div>
                    <div class="px-4 text-center md:text-left">
                        <div class="text-3xl font-bold">20+</div>
                        <div class="text-xs text-blue-300 uppercase">Năm triển khai</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-8">
                
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 border-l-4 border-blue-600 pl-4">Các dự án thành phần trọng điểm</h2>
                    
                    @if(isset($components) && $components->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($components as $comp)
                            
                            {{-- LOGIC XỬ LÝ TRẠNG THÁI & MÀU SẮC --}}
                            @php
                                $statusConfig = [
                                    'new'       => ['label' => 'Mới khởi tạo',  'class' => 'bg-gray-100 text-gray-600'],
                                    'ongoing'   => ['label' => 'Đang thực hiện','class' => 'bg-blue-100 text-blue-700'],
                                    'paused'    => ['label' => 'Tạm dừng',      'class' => 'bg-orange-100 text-orange-700'],
                                    'completed' => ['label' => 'Đã hoàn thành', 'class' => 'bg-green-100 text-green-700'],
                                ];
                                $currentStatus = $statusConfig[$comp->status] ?? $statusConfig['new'];
                            @endphp

                            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 hover:shadow-md transition-all group">
                                <div class="flex justify-between items-start mb-4">
                                    <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                        <i class="fa-solid fa-layer-group"></i>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $currentStatus['class'] }}">
                                        {{ $currentStatus['label'] }}
                                    </span>
                                </div>
                                
                                <h3 class="font-bold text-slate-800 text-lg mb-2 line-clamp-2 h-14" title="{{ $comp->name }}">
                                    {{ $comp->name }}
                                </h3>
                                
                                <div class="flex items-center gap-3 text-sm mt-2">
                                    <div class="flex-1 bg-slate-100 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full transition-all duration-1000" style="width: {{ $comp->progress }}%"></div>
                                    </div>
                                    <span class="font-bold text-blue-600">{{ $comp->progress }}%</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 bg-slate-50 rounded-lg border border-dashed border-slate-300">
                            <p class="text-slate-500">Chưa có dữ liệu dự án trọng điểm.</p>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50 px-6 py-4 border-b border-slate-200 flex justify-between items-center">
                        <h3 class="font-bold text-slate-700">Danh sách dự án thuộc Đề án 47</h3>
                        <span class="text-xs text-slate-500">{{ isset($listProjects) ? $listProjects->count() : 0 }} kết quả</span>
                    </div>
                    
                    @if(isset($listProjects) && $listProjects->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-slate-500 bg-white border-b text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3">Mã số</th>
                                    <th class="px-6 py-3">Tên dự án</th>
                                    <th class="px-6 py-3">Đơn vị thực hiện</th>
                                    <th class="px-6 py-3 text-center">Năm BĐ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($listProjects as $p)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-xs text-slate-500">
                                        {{ $p->code_number ?? '---' }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-800">
                                        <span class="hover:text-blue-600 block line-clamp-2" title="{{ $p->name }}">{{ $p->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $p->implementing_unit->name ?? '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-slate-500">
                                        {{ $p->start_date ? \Carbon\Carbon::parse($p->start_date)->year : '' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <div class="p-8 text-center">
                            <p class="text-slate-500 italic">Chưa có dữ liệu dự án chi tiết trong hệ thống.</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-slate-100 rounded-xl p-6 border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Mục tiêu chính</h3>
                    <ul class="space-y-4 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Hoàn thiện hệ thống pháp luật, chính sách quản lý TN&MT biển.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Xây dựng cơ sở dữ liệu quốc gia về tài nguyên môi trường biển.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Bảo đảm an ninh quốc phòng, khẳng định chủ quyền lãnh hải.</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center justify-between">
                        Văn bản liên quan
                        <i class="fa-solid fa-file-lines text-slate-400"></i>
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block p-3 rounded bg-blue-50 hover:bg-blue-100 transition-colors group">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-pdf text-red-500 text-xl group-hover:scale-110 transition-transform"></i>
                                <div>
                                    <div class="text-sm font-bold text-blue-900 group-hover:underline">Quyết định 47/2006/QĐ-TTg</div>
                                    <div class="text-[10px] text-slate-500">PDF • 2.4 MB</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block p-3 rounded bg-blue-50 hover:bg-blue-100 transition-colors group">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-word text-blue-500 text-xl group-hover:scale-110 transition-transform"></i>
                                <div>
                                    <div class="text-sm font-bold text-blue-900 group-hover:underline">Báo cáo tổng kết GĐ 2006-2010</div>
                                    <div class="text-[10px] text-slate-500">DOCX • 5.1 MB</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection