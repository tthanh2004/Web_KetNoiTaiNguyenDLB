@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Quản lý Sản phẩm</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Thêm Sản phẩm
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <table class="min-w-full">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-500 text-[11px] font-bold uppercase tracking-[0.2em]">
                <th class="px-8 py-5 text-left">Sản phẩm & Hình ảnh</th>
                <th class="px-8 py-5 text-left">Dự án gốc</th>
                <th class="px-8 py-5 text-left">Định dạng</th>
                <th class="px-8 py-5 text-right">Thao tác</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($products as $product)
            <tr class="hover:bg-blue-50/30 transition-colors">
                <td class="px-8 py-5">
                    <div class="flex items-center gap-4">
                        <img src="{{ $product->thumbnail_url }}" class="w-16 h-12 object-cover rounded-lg shadow-sm border border-slate-200">
                        <div>
                            <div class="font-bold text-slate-800">{{ $product->name }}</div>
                            <div class="text-[10px] text-slate-400 font-mono">#{{ $product->id }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-8 py-5 text-sm font-medium text-slate-600">
                    {{ Str::limit($product->project->name ?? '---', 40) }}
                </td>
                <td class="px-8 py-5">
                    @if($product->file_extension)
                        <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-black rounded-full border border-amber-100 uppercase italic">
                           .{{ $product->file_extension }}
                        </span>
                    @else
                        <span class="text-slate-300 text-xs italic">Không có file</span>
                    @endif
                </td>
                <td class="px-8 py-5 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Xóa sản phẩm này?')">
                            @csrf @method('DELETE')
                            <button class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection