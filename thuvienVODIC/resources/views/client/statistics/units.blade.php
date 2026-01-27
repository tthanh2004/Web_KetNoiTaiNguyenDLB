@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-5xl">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-serif text-blue-900 font-bold mb-4">Thống kê theo Đơn vị thực hiện</h1>
            <p class="text-slate-500">Top các đơn vị có đóng góp nhiều nhất trong công tác điều tra cơ bản.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-700 uppercase tracking-wide text-sm">Bảng xếp hạng</h3>
                <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">Top 20</span>
            </div>

            <div class="p-6 md:p-8">
                @if($units->count() > 0)
                    @php 
                        $maxProjects = $units->first()->projects_count; 
                    @endphp

                    <div class="space-y-6">
                        @foreach($units as $index => $unit)
                        <div class="relative group">
                            <div class="flex justify-between items-end mb-2 relative z-10">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center font-bold text-sm 
                                        {{ $index == 0 ? 'bg-yellow-100 text-yellow-700' : 
                                          ($index == 1 ? 'bg-gray-200 text-slate-700' : 
                                          ($index == 2 ? 'bg-orange-100 text-orange-700' : 'bg-slate-100 text-slate-500')) }}">
                                        {{ $index + 1 }}
                                    </div>
                                    
                                    <span class="font-bold text-slate-700 group-hover:text-blue-700 transition-colors">
                                        {{ $unit->name }}
                                    </span>
                                </div>
                                <span class="text-sm font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                    {{ $unit->projects_count }} dự án
                                </span>
                            </div>

                            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-1000 ease-out 
                                    {{ $index == 0 ? 'bg-gradient-to-r from-yellow-400 to-yellow-600' : 
                                      ($index == 1 ? 'bg-gradient-to-r from-slate-400 to-slate-600' : 
                                      ($index == 2 ? 'bg-gradient-to-r from-orange-400 to-orange-600' : 'bg-gradient-to-r from-blue-400 to-blue-600')) }}" 
                                    style="width: {{ $maxProjects > 0 ? ($unit->projects_count / $maxProjects) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <div class="inline-block p-4 bg-slate-50 rounded-full mb-3 text-slate-300">
                            <i class="fa-solid fa-chart-bar text-4xl"></i>
                        </div>
                        <p class="text-slate-500">Chưa có dữ liệu thống kê đơn vị.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection