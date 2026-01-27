@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Bộ & Cơ quan ngang Bộ</h1>
    <a href="{{ route('admin.ministries.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
        <i class="fa-solid fa-plus mr-2"></i> Thêm mới
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-20">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Mã Bộ</th> <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên Bộ / Ngành</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số đơn vị trực thuộc</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Hành động</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($ministries as $item)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-500">#{{ $item->id }}</td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-800 text-xs font-mono font-bold px-2 py-1 rounded border border-gray-300">
                        {{ $item->code ?? '---' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm font-bold text-gray-900">{{ $item->name }}</div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded">
                        {{ $item->implementing_units_count ?? $item->implementing_units()->count() }} đơn vị
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.ministries.edit', $item->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('admin.ministries.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn chắc chắn muốn xóa?');">
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
        {{ $ministries->links() }}
    </div>
</div>
@endsection