@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Sửa Đơn vị</h1>

<form action="{{ route('admin.units.update', $unit->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-1">Tên đơn vị</label>
        <input type="text" name="name" value="{{ $unit->name }}" class="w-full border-gray-300 rounded p-2 border" required>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-1">Trực thuộc Bộ</label>
        <select name="ministry_id" class="w-full border-gray-300 rounded p-2 border">
            <option value="" {{ $unit->ministry_id === null ? 'selected' : '' }}>
                -- Đơn vị độc lập (Không thuộc Bộ) --
            </option>
            
            @foreach($ministries as $min)
                <option value="{{ $min->id }}" {{ $unit->ministry_id == $min->id ? 'selected' : '' }}>
                    {{ $min->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.units.index') }}" class="px-4 py-2 text-gray-600 border rounded">Hủy</a>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Lưu lại</button>
    </div>
</form>
@endsection