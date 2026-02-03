@extends('admin.layout.app')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Hệ thống Dự án</h1>
    <div class="flex gap-2">
        <a href="{{ route('admin.projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition flex items-center">
            <i class="fa-solid fa-plus mr-2"></i> Thêm dự án mới
        </a>
    </div>
</div>

{{-- BỘ LỌC TÌM KIẾM --}}
<div class="bg-white p-4 rounded-lg shadow mb-6 border border-gray-100">
    <form action="{{ route('admin.projects.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="md:col-span-2">
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tìm kiếm</label>
            <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tên dự án, mã phê duyệt..." class="w-full border-gray-300 rounded text-sm p-2 border focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div>
            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nhóm dự án</label>
            <select name="group_id" class="w-full border-gray-300 rounded text-sm p-2 border bg-white">
                <option value="">Tất cả nhóm</option>
                @foreach($groups as $g)
                    <option value="{{ $g->id }}" {{ request('group_id') == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-black transition w-full text-sm font-bold">
                <i class="fa-solid fa-magnifying-glass mr-2"></i> Lọc dữ liệu
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider w-16">ID</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Thông tin dự án</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lĩnh vực</th>
                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Phân loại</th>
                <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Hành động</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse($projects as $item)
            <tr class="hover:bg-blue-50/50 transition-colors">
                <td class="px-6 py-4 text-sm text-gray-400 font-mono">#{{ $item->id }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-start">
                        {{-- Icon phân biệt Cha/Con --}}
                        @if($item->parent_id)
                            <i class="fa-solid fa-turn-up rotate-90 text-gray-300 mt-1 mr-3"></i>
                        @else
                            <i class="fa-solid fa-folder text-blue-500 mt-1 mr-3"></i>
                        @endif
                        
                        <div>
                            <div class="text-sm font-bold text-gray-900 {{ $item->parent_id ? 'text-gray-600 font-medium' : 'text-blue-900' }}">
                                {{ $item->name }}
                            </div>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-[10px] font-mono bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200 text-gray-600" title="Mã phê duyệt">
                                    {{ $item->code_number ?? 'Chưa có mã' }}
                                </span>
                                <span class="text-[10px] text-gray-400">
                                    <i class="fa-regular fa-calendar-days mr-1"></i> {{ $item->start_year }} - {{ $item->end_year ?? 'Nay' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    @if($item->field)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold shadow-sm text-white" style="background-color: {{ $item->field->color }}">
                           <i class="fa-solid fa-tag mr-1.5 text-[10px]"></i> {{ $item->field->name }}
                        </span>
                    @else
                        <span class="text-gray-300 text-xs italic">Chưa chọn</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    @if($item->parent_id)
                         <span class="text-[11px] text-orange-600 font-bold bg-orange-50 px-2 py-1 rounded">Dự án con</span>
                    @else
                        <div class="flex flex-col gap-1">
                            <span class="text-[11px] text-blue-700 font-bold bg-blue-50 px-2 py-1 rounded w-max text-center">Dự án lớn</span>
                            @if($item->children_count > 0)
                                <span class="text-[10px] text-gray-500 font-medium italic">
                                    <i class="fa-solid fa-sitemap mr-1"></i> {{ $item->children_count }} thành phần
                                </span>
                            @endif
                        </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.projects.edit', $item->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Chỉnh sửa">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Xóa dự án này sẽ ảnh hưởng đến các dữ liệu liên quan. Bạn chắc chắn chứ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Xóa">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">
                    <i class="fa-solid fa-inbox text-4xl mb-2 block"></i>
                    Không tìm thấy dự án nào phù hợp.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($projects->hasPages())
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $projects->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection