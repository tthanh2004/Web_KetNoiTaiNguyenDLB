@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Chỉnh sửa Bộ ngành</h1>

<div class="bg-white p-6 rounded shadow max-w-lg">
    <form action="{{ route('admin.ministries.update', $ministry->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mã viết tắt <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old('code', $ministry->code) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border uppercase" required>
                @error('code')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tên Bộ / Ngành <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $ministry->name) }}"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.ministries.index') }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Hủy bỏ</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 shadow">
                <i class="fa-solid fa-save mr-1"></i> Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection