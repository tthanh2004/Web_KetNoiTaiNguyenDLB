@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- CỘT TRÁI: DANH MỤC NHÓM (Sidebar) --}}
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden sticky top-24">
                    <div class="bg-emerald-600 text-white px-5 py-4 font-bold uppercase tracking-wider text-sm flex items-center justify-between">
                        <span>Danh mục nhóm</span>
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <nav class="flex flex-col max-h-[500px] overflow-y-auto custom-scrollbar">
                        {{-- Link "Tất cả dự án" --}}
                        <a href="{{ route('client.projects.index') }}" 
                           class="px-5 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors flex justify-between items-center group {{ !request('group_id') ? 'bg-emerald-50 border-l-4 border-l-emerald-500' : '' }}">
                            <span class="{{ !request('group_id') ? 'font-bold text-emerald-700' : 'text-slate-600 group-hover:text-emerald-700' }}">
                                Tất cả dự án
                            </span>
                            @if(!request('group_id'))
                                <i class="fa-solid fa-check text-emerald-600 text-xs"></i>
                            @endif
                        </a>

                        {{-- Loop danh sách nhóm --}}
                        @if(isset($groups) && $groups->count() > 0)
                            @foreach($groups as $group)
                            <a href="{{ route('client.projects.index', ['group_id' => $group->id]) }}" 
                               class="px-5 py-3 border-b border-slate-100 hover:bg-slate-50 transition-colors flex justify-between items-center group {{ request('group_id') == $group->id ? 'bg-emerald-50 border-l-4 border-l-emerald-500' : '' }}">
                                <span class="{{ request('group_id') == $group->id ? 'font-bold text-emerald-700' : 'text-slate-600 group-hover:text-emerald-700' }}">
                                    {{ $group->name }}
                                </span>
                                <span class="text-[10px] px-2 py-0.5 rounded-full font-bold {{ request('group_id') == $group->id ? 'bg-emerald-200 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $group->projects_count }}
                                </span>
                            </a>
                            @endforeach
                        @else
                            <div class="p-4 text-center text-slate-400 text-xs">Đang cập nhật nhóm...</div>
                        @endif
                    </nav>
                </div>

                {{-- Box hỗ trợ mobile --}}
                <div class="lg:hidden bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                    <p class="text-sm text-blue-800 font-medium">Cần hỗ trợ tra cứu?</p>
                    <p class="text-xs text-blue-600">Liên hệ: <span class="font-bold">024.3773.xxxx</span></p>
                </div>
            </div>

            {{-- CỘT PHẢI: NỘI DUNG DỰ ÁN --}}
            <div class="lg:col-span-9 space-y-6">
                
                {{-- Header thông tin Nhóm đang chọn --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        @if(isset($currentGroup) && $currentGroup)
                            <div class="flex items-center gap-2 mb-1 text-emerald-600 font-bold text-xs uppercase tracking-wider">
                                <i class="fa-solid fa-folder-open"></i> Đang xem nhóm
                            </div>
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
                                {{ $currentGroup->name }}
                            </h1>
                            <p class="text-slate-500 text-sm mt-2 max-w-2xl">
                                {{ $currentGroup->description ?? 'Danh sách các hồ sơ, dự án thuộc nhóm ' . $currentGroup->name }}
                            </p>
                        @else
                            <h1 class="text-2xl md:text-3xl font-bold text-blue-900 mb-2">Tra cứu Cơ sở dữ liệu</h1>
                            <p class="text-slate-500 text-sm">Hệ thống lưu trữ toàn bộ các dự án điều tra cơ bản tài nguyên môi trường biển.</p>
                        @endif
                    </div>
                    
                    <div class="w-full md:w-auto min-w-[300px]">
                        <form action="{{ route('client.projects.index') }}" method="GET" class="relative">
                            @if(request('group_id'))
                                <input type="hidden" name="group_id" value="{{ request('group_id') }}">
                            @endif
                            
                            <input type="text" name="keyword" value="{{ request('keyword') }}" 
                                   class="w-full pl-10 pr-12 py-3 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none shadow-sm transition-all"
                                   placeholder="Tìm tên dự án, mã số...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                            </div>
                            <button type="submit" class="absolute inset-y-1 right-1 bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 rounded-md text-xs font-bold transition-colors">
                                Tìm
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Danh sách dự án --}}
                <div class="space-y-4">
                    @forelse($projects as $project)
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md hover:border-emerald-400 transition-all duration-300 group">
                        <div class="flex flex-col md:flex-row">
                            {{-- Thumbnail --}}
                            <div class="md:w-48 h-40 md:h-auto bg-slate-100 relative overflow-hidden flex-shrink-0">
                                <a href="{{ route('client.project.detail', $project->id) }}" class="block w-full h-full">
                                    @if($project->thumbnail)
                                        <img src="{{ $project->thumbnail_url }}" alt="{{ $project->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                            <i class="fa-solid fa-image text-3xl"></i>
                                        </div>
                                    @endif
                                    @if($project->start_year)
                                    <div class="absolute top-2 left-2 bg-black/60 text-white text-[10px] font-bold px-2 py-1 rounded backdrop-blur-sm">
                                        {{ $project->start_year }}
                                    </div>
                                    @endif
                                </a>
                            </div>

                            {{-- Content --}}
                            <div class="p-5 flex flex-col justify-between flex-grow">
                                <div>
                                    <div class="flex flex-wrap items-center gap-2 mb-2">
                                        @if($project->code_number)
                                            <span class="bg-blue-50 text-blue-700 text-[10px] font-bold px-2 py-0.5 rounded border border-blue-100">
                                                {{ $project->code_number }}
                                            </span>
                                        @endif
                                        <span class="text-xs text-slate-500 flex items-center gap-1 truncate max-w-[250px]" title="{{ $project->owner_name }}">
                                            <i class="fa-solid fa-building-columns text-slate-400 text-[10px]"></i> {{ Str::limit($project->owner_name, 35) }}
                                        </span>
                                    </div>

                                    <h3 class="font-bold text-lg text-slate-800 mb-2 leading-snug group-hover:text-emerald-700 transition-colors">
                                        <a href="{{ route('client.project.detail', $project->id) }}">
                                            {{ $project->name }}
                                        </a>
                                    </h3>

                                    <p class="text-sm text-slate-600 line-clamp-2 mb-3">
                                        {{ $project->content ?? 'Chưa có nội dung tóm tắt.' }}
                                    </p>
                                </div>

                                {{-- Footer của Card: Hiển thị Lĩnh vực, Mã kho và SỐ LƯỢNG DỰ ÁN CON --}}
                                <div class="flex items-center justify-between pt-3 border-t border-slate-50 mt-2">
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-xs text-slate-500 font-medium">
                                        @if($project->field)
                                            <span class="flex items-center gap-1">
                                                <span class="w-2 h-2 rounded-full" style="background-color: {{ $project->field->color ?? '#cbd5e1' }}"></span>
                                                {{ $project->field->name }}
                                            </span>
                                        @endif
                                        
                                        <span><i class="fa-solid fa-box-archive mr-1 text-slate-400"></i> Kho: {{ $project->library_code ?? '---' }}</span>
                                        @if($project->children_count > 0)
                                            <span class="flex items-center gap-1.5 text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100 shadow-sm">
                                                <i class="fa-solid fa-sitemap text-[10px]"></i> 
                                                Dự án thành phần: <strong class="font-black">{{ $project->children_count }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <a href="{{ route('client.project.detail', $project->id) }}" class="text-sm font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1 transition-colors flex-none">
                                        Chi tiết <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="bg-white p-12 text-center rounded-xl border border-dashed border-slate-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 text-slate-400 mb-4">
                            <i class="fa-solid fa-magnifying-glass text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700">Không tìm thấy dự án</h3>
                        <p class="text-slate-500 text-sm mt-1">Chưa có dữ liệu nào hoặc từ khóa không khớp.</p>
                        <a href="{{ route('client.projects.index') }}" class="inline-block mt-4 text-sm font-bold text-emerald-600 hover:underline">
                            Xem tất cả dự án
                        </a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection