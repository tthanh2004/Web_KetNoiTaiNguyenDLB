@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Danh sách Dự án</h1>
        <p class="text-sm text-gray-500">Quản lý tiến độ và trạng thái các nhiệm vụ</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition-colors">
        <i class="fa-solid fa-plus mr-1"></i> Thêm mới
    </a>
</div>

<div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-1/4">Dự án / Mã số</th>
                    <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Đơn vị & Nhóm</th>
                    <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Trạng thái</th>
                    <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-1/6">Tiến độ</th>
                    <th class="px-5 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($projects as $project)
                <tr class="hover:bg-gray-50 transition-colors">
                    
                    <td class="px-5 py-4 bg-white text-sm">
                        <div class="flex items-center">
                            <div>
                                <p class="text-gray-900 font-bold line-clamp-2" title="{{ $project->name }}">
                                    {{ $project->name }}
                                </p>
                                <p class="text-gray-500 text-xs mt-1 font-mono bg-gray-100 inline-block px-1 rounded">
                                    {{ $project->code_number ?? 'Chưa có mã' }}
                                </p>
                            </div>
                        </div>
                    </td>

                    <td class="px-5 py-4 bg-white text-sm">
                        <p class="text-gray-700 font-medium mb-1">
                            <i class="fa-solid fa-building-columns text-gray-400 mr-1"></i>
                            {{ $project->implementing_unit->name ?? '---' }}
                        </p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            {{ $project->project_group->name ?? '---' }}
                        </span>
                    </td>

                    <td class="px-5 py-4 bg-white text-sm">
                        @php
                            $statusClasses = [
                                'new' => 'bg-gray-100 text-gray-600 border-gray-200',
                                'ongoing' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'paused' => 'bg-orange-100 text-orange-700 border-orange-200',
                                'completed' => 'bg-green-100 text-green-700 border-green-200',
                            ];
                            $statusLabels = [
                                'new' => 'Mới khởi tạo',
                                'ongoing' => 'Đang thực hiện',
                                'paused' => 'Tạm dừng',
                                'completed' => 'Hoàn thành',
                            ];
                            $currentStatus = $project->status ?? 'new';
                        @endphp
                        
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full border {{ $statusClasses[$currentStatus] }}">
                            {{ $statusLabels[$currentStatus] }}
                        </span>

                        @if($project->status == 'completed' && $project->completed_at)
                            <div class="text-xs text-gray-400 mt-1">
                                <i class="fa-regular fa-clock"></i> {{ $project->completed_at->format('d/m/Y') }}
                            </div>
                        @endif
                    </td>

                    <td class="px-5 py-4 bg-white text-sm align-middle">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-semibold text-gray-600">{{ $project->progress }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $project->progress == 100 ? 'bg-green-500' : ($project->progress > 50 ? 'bg-blue-500' : 'bg-blue-400') }}" 
                                 style="width: {{ $project->progress }}%"></div>
                        </div>
                    </td>

                    <td class="px-5 py-4 bg-white text-sm text-center whitespace-nowrap">
                        <div class="flex justify-center items-center gap-2">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Sửa tiến độ">
                                <i class="fa-solid fa-pen-to-square text-lg"></i>
                            </a>
                            
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="inline-block" onsubmit="return confirm('CẢNH BÁO: Xóa dự án này sẽ xóa toàn bộ tài liệu liên quan!\nBạn có chắc chắn không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition-colors" title="Xóa dự án">
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