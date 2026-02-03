@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Sản phẩm</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition-colors">
        <i class="fa-solid fa-plus mr-1"></i> Thêm Sản phẩm
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
            <tr class="border-b border-gray-200 hover:bg-gray-50 transition-colors">
                <td class="px-5 py-3">
                    {{-- SỬA: Dùng thumbnail_url để tự động fix đường dẫn --}}
                    <div class="w-16 h-12 bg-gray-50 border rounded flex items-center justify-center overflow-hidden">
                        <img src="{{ $product->thumbnail_url }}" class="w-full h-full object-contain" alt="Thumbnail">
                    </div>
                </td>
                
                <td class="px-5 py-3">
                    <div class="font-semibold text-gray-700">{{ $product->name }}</div>
                    <div class="text-xs text-gray-400 mt-1">ID: {{ $product->id }}</div>
                </td>
                
                <td class="px-5 py-3 text-sm text-blue-600">
                    {{-- Thêm ?? '---' để tránh lỗi nếu dự án bị xóa --}}
                    {{ Str::limit($product->project->name ?? '---', 50) }}
                </td>
                
                <td class="px-5 py-3 text-center">
                    <div class="flex items-center justify-center space-x-3">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700" title="Sửa">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                        </a>
                        
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700" title="Xóa">
                                <i class="fa-solid fa-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{-- Phân trang --}}
    @if($products->hasPages())
        <div class="p-4 border-t">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection