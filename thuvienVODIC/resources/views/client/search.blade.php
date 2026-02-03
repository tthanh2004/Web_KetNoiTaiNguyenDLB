@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">

        <div class="bg-white p-6 rounded-xl shadow-md border border-slate-200 mb-8">
            <h1 class="text-2xl font-bold text-blue-900 mb-6 border-l-4 border-yellow-500 pl-3 uppercase">
                Tra cứu dữ liệu tổng hợp
            </h1>
            
            <form action="{{ route('client.search') }}" method="GET">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Loại dữ liệu:</label>
                        <select name="type" onchange="this.form.submit()" class="w-full border border-slate-300 rounded-lg p-3 font-bold text-blue-900 bg-slate-50">
                            <option value="all" {{ $type == 'all' ? 'selected' : '' }}>-- Tất cả --</option>
                            <option value="project" {{ $type == 'project' ? 'selected' : '' }}>📂 Dự án</option>
                            <option value="product" {{ $type == 'product' ? 'selected' : '' }}>📦 Sản phẩm</option>
                            <option value="fee" {{ $type == 'fee' ? 'selected' : '' }}>💰 Biểu phí</option>
                        </select>
                    </div>

                    <div class="md:col-span-5 relative">
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Từ khóa:</label>
                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="w-full border border-slate-300 rounded-lg pl-10 pr-4 py-3" placeholder="Nhập từ khóa...">
                        <div class="absolute top-[34px] left-3 text-slate-400"><i class="fa-solid fa-magnifying-glass"></i></div>
                    </div>

                    {{-- CÁC BỘ LỌC ĐỘNG --}}
                    @if($type == 'project' || $type == 'product')
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Đơn vị:</label>
                            <select name="unit_id" class="w-full border border-slate-300 rounded-lg p-3 text-sm">
                                <option value="">-- Tất cả --</option>
                                @foreach($units as $u) <option value="{{ $u->id }}" {{ $unit_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option> @endforeach
                            </select>
                        </div>
                    @endif

                    @if($type == 'fee')
                        <div class="md:col-span-3">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Nhóm phí:</label>
                            <select name="category_id" class="w-full border border-slate-300 rounded-lg p-3 text-sm">
                                <option value="">-- Tất cả --</option>
                                @foreach($feeCategories as $c) <option value="{{ $c->id }}" {{ $category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option> @endforeach
                            </select>
                        </div>
                    @endif
                    
                    <div class="md:col-span-2 mt-2 pt-4">
                        <button type="submit" class="w-full bg-blue-900 hover:bg-cyan-700 text-white py-3 rounded-lg font-bold shadow-md">Lọc</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="space-y-10">

            {{-- ================= TRƯỜNG HỢP 1: HIỂN THỊ TẤT CẢ (ALL) ================= --}}
            @if($type == 'all')
                
                {{-- 1. KẾT QUẢ DỰ ÁN --}}
                @if($dataAll['projects']->count() > 0)
                <div>
                    <h3 class="flex items-center justify-between font-bold text-lg text-slate-800 mb-4 border-b pb-2">
                        <span><i class="fa-solid fa-folder-open text-blue-500 mr-2"></i> Dự án liên quan</span>
                        <a href="{{ route('client.search', ['type' => 'project', 'keyword' => request('keyword')]) }}" class="text-sm text-blue-600 hover:underline">Xem tất cả <i class="fa-solid fa-arrow-right"></i></a>
                    </h3>
                    <div class="space-y-3">
                        @foreach($dataAll['projects'] as $item)
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-slate-200 flex gap-4 hover:border-blue-300 transition-all">
                                <div class="flex-none text-3xl text-blue-200"><i class="fa-solid fa-folder"></i></div>
                                <div>
                                    <h4 class="font-bold text-slate-800"><a href="{{ route('client.project.detail', $item->id) }}">{{ $item->name }}</a></h4>
                                    <div class="text-xs text-slate-500 mt-1">Mã: {{ $item->code_number }} | Đơn vị: {{ $item->implementing_unit->name ?? '---' }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- 2. KẾT QUẢ PHÍ (HIỂN THỊ THEO NHÓM) --}}
                @if($dataAll['fees']->count() > 0)
                <div>
                    <h3 class="flex items-center justify-between font-bold text-lg text-slate-800 mb-4 border-b pb-2">
                        <span><i class="fa-solid fa-receipt text-blue-500 mr-2"></i> Biểu mức thu phí</span>
                        <a href="{{ route('client.search', ['type' => 'fee', 'keyword' => request('keyword')]) }}" class="text-sm text-blue-600 hover:underline">Xem chi tiết <i class="fa-solid fa-arrow-right"></i></a>
                    </h3>
                    
                    <div class="space-y-6">
                        @foreach($dataAll['fees'] as $groupName => $items)
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                            <div class="bg-slate-100 px-4 py-2 font-bold text-blue-900 text-sm border-b border-slate-200">
                                {{ $groupName ?? 'Nhóm phí khác' }}
                            </div>
                            <table class="w-full text-left text-sm">
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($items as $item)
                                    <tr class="hover:bg-blue-50">
                                        <td class="px-4 py-2 text-slate-700">{{ $item->name }}</td>
                                        <td class="px-4 py-2 text-slate-500 w-24">{{ $item->unit }}</td>
                                        <td class="px-4 py-2 text-right font-bold text-blue-700 w-32">{{ number_format($item->price) }} đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            {{-- ================= TRƯỜNG HỢP 2: HIỂN THỊ RIÊNG LẺ ================= --}}
            @else
                
                @if($type == 'project')
                    @foreach($results as $item)
                        <div class="bg-white p-4 mb-3 rounded shadow-sm border">
                            <h4 class="font-bold"><a href="{{ route('client.project.detail', $item->id) }}">{{ $item->name }}</a></h4>
                        </div>
                    @endforeach
                    <div class="mt-4">{{ $results->appends(request()->query())->links() }}</div>

                @elseif($type == 'fee')
                    <div class="space-y-6">
                        @forelse($results as $groupName => $items)
                        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                            <div class="bg-blue-900 text-white px-6 py-3 font-bold uppercase text-sm">
                                {{ $groupName ?? 'Nhóm phí khác' }}
                            </div>
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold">
                                    <tr>
                                        <th class="px-6 py-3">Nội dung thu</th>
                                        <th class="px-6 py-3">Đơn vị tính</th>
                                        <th class="px-6 py-3 text-right">Mức thu</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($items as $item)
                                    <tr class="hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-3 font-medium text-slate-700">{{ $item->name }}</td>
                                        <td class="px-6 py-3 text-slate-500">{{ $item->unit }}</td>
                                        <td class="px-6 py-3 text-right text-blue-700 font-bold">{{ number_format($item->price) }} đ</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @empty
                            <div class="text-center py-10">Không tìm thấy phí nào.</div>
                        @endforelse
                    </div>
                @endif

            @endif

        </div>
    </div>
</div>
@endsection