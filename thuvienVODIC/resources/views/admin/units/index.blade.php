@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Đơn vị thực hiện</h1>
    <a href="{{ route('admin.units.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">
        <i class="fa-solid fa-plus mr-2"></i> Thêm mới
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên đơn vị</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trực thuộc Bộ</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($units as $unit)
            <tr>
                <td class="px-6 py-4 text-sm text-gray-500">#{{ $unit->id }}</td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $unit->name }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    {{ $unit->ministry->name ?? '---' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.units.edit', $unit->id) }}" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('admin.units.destroy', $unit->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Xóa đơn vị này?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $units->links() }}
    </div>
</div>
@endsection