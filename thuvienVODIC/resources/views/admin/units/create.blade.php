@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Thêm Đơn vị mới</h1>

<form action="{{ route('admin.units.store') }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tên đơn vị <span class="text-red-500">*</span></label>
        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required placeholder="VD: Viện Nghiên cứu Hải sản">
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Trực thuộc Bộ / Ngành</label>
        <select name="ministry_id" class="w-full border-gray-300 rounded-md shadow-sm">
            <option value="">-- Chọn Bộ ngành (Nếu có) --</option>
            @foreach($ministries as $min)
                <option value="{{ $min->id }}">{{ $min->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.units.index') }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Hủy</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lưu lại</button>
    </div>
</form>
@endsection