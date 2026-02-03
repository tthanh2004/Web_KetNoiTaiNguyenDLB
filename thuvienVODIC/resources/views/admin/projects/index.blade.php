@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Danh sách Dự án</h1>
        <p class="text-sm text-gray-500">Quản lý toàn bộ hồ sơ dự án, đề án</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition-colors">
        <i class="fa-solid fa-plus mr-1"></i> Thêm mới
    </a>
</div>

<div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                    <th class="px-5 py-3 w-16">Ảnh</th>
                    <th class="px-5 py-3">Tên Dự án / Nhóm</th>
                    <th class="px-5 py-3">Mã & Thời gian</th>
                    <th class="px-5 py-3">Lưu trữ & Giá</th>
                    <th class="px-5 py-3 text-center w-32">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($projects as $project)
                <tr class="hover:bg-gray-50 transition-colors">
                    
                    <td class="px-5 py-4 align-top">
                        <div class="flex-shrink-0 w-12 h-12">
                            @if($project->thumbnail)
                                <img class="w-full h-full rounded object-cover border border-gray-200" src="{{ asset($project->thumbnail) }}" alt="">
                            @else
                                <div class="w-full h-full rounded bg-gray-100 flex items-center justify-center text-gray-400 border border-gray-200">
                                    <i class="fa-solid fa-image"></i>
                                </div>
                            @endif
                        </div>
                    </td>

                    <td class="px-5 py-4 align-top">
                        <div class="mb-1">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-gray-900 font-bold hover:text-blue-600 text-sm line-clamp-2">
                                {{ $project->name }}
                            </a>
                        </div>
                        
                        @if($project->parent)
                            <div class="text-xs text-yellow-700 bg-yellow-50 border border-yellow-200 px-2 py-0.5 rounded inline-flex items-center gap-1 mb-1">
                                <i class="fa-solid fa-turn-up rotate-90"></i> Con của: {{ Str::limit($project->parent->name, 30) }}
                            </div>
                        @endif

                        <div class="text-xs text-gray-500">
                            <span class="font-semibold text-blue-800">{{ $project->project_group->name ?? '---' }}</span>
                            <span class="mx-1">•</span>
                            <span>{{ $project->implementing_unit->name ?? '---' }}</span>
                        </div>
                    </td>

                    <td class="px-5 py-4 align-top text-sm">
                        <p class="font-mono text-gray-600 bg-gray-100 px-1 rounded inline-block text-xs mb-1">
                            {{ $project->code_number ?? 'Chưa có mã' }}
                        </p>
                        <p class="text-gray-500 text-xs">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            {{ $project->start_year ?? '?' }} - {{ $project->end_year ?? '?' }}
                        </p>
                    </td>

                    <td class="px-5 py-4 align-top text-sm">
                        <div class="mb-1 text-xs">
                            <span class="text-gray-500">Kho:</span> 
                            <span class="font-bold text-gray-700">{{ $project->library_code ?? '---' }}</span>
                        </div>
                        <div class="mb-1 text-xs text-red-600 font-medium" title="Vị trí tủ">
                            <i class="fa-solid fa-box-archive mr-1"></i> {{ $project->cabinet_location ?? '---' }}
                        </div>
                        @if($project->price)
                            <div class="text-xs text-green-700 font-bold">
                                {{ number_format($project->price) }} đ
                            </div>
                        @endif
                    </td>

                    <td class="px-5 py-4 align-middle text-center whitespace-nowrap">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Sửa">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </a>
                            
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa dự án này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition-colors" title="Xóa">
                                    <i class="fa-solid fa-trash text-lg"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if($projects->hasPages())
    <div class="px-5 py-4 bg-gray-50 border-t border-gray-200">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection