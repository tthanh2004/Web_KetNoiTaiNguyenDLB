@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Nhóm Dự án</h1>
    <a href="{{ route('admin.project-groups.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        <i class="fa-solid fa-plus mr-2"></i> Thêm mới
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Nhóm / Chương trình</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số lượng dự án</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($groups as $group)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-500">#{{ $group->id }}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $group->name }}</div>
                    @if($group->description)
                        <div class="text-xs text-gray-500 mt-1">{{ Str::limit($group->description, 50) }}</div>
                    @endif
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">
                        {{ $group->projects_count }} dự án
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.project-groups.edit', $group->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('admin.project-groups.destroy', $group->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Xóa nhóm này?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $groups->links() }}
    </div>
</div>
@endsection