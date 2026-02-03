@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
        <i class="fa-solid fa-plus"></i> Thêm Sản phẩm
    </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                <th class="px-5 py-3 text-left">Hình ảnh</th>
                <th class="px-5 py-3 text-left">Tên sản phẩm</th>
                <th class="px-5 py-3 text-left">Thuộc Dự án</th>
                <th class="px-5 py-3 text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="px-5 py-3">
                    @if($product->thumbnail)
                        <img src="{{ asset($product->thumbnail) }}" class="w-16 h-10 object-cover rounded border">
                    @else
                        <div class="w-16 h-10 bg-gray-200 rounded flex items-center justify-center text-gray-400"><i class="fa-solid fa-image"></i></div>
                    @endif
                </td>
                <td class="px-5 py-3 font-semibold text-gray-700">{{ $product->name }}</td>
                <td class="px-5 py-3 text-sm text-blue-600">{{ Str::limit($product->project->name, 40) }}</td>
                <td class="px-5 py-3 text-center">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700 mr-4"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:text-red-700"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $products->links() }}</div>
</div>
@endsection