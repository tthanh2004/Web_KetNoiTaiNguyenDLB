@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Sửa thông tin Dự án</h1>

<form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-4xl">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">Tên dự án <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $project->name) }}" class="w-full border-gray-300 rounded p-2 border" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Mã số</label>
            <input type="text" name="code_number" value="{{ old('code_number', $project->code_number) }}" class="w-full border-gray-300 rounded p-2 border">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Đơn vị thực hiện</label>
            <select name="implementing_unit_id" class="w-full border-gray-300 rounded p-2 border">
                <option value="">-- Chọn đơn vị --</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $project->implementing_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">Nội dung tóm tắt</label>
            <textarea name="content" rows="5" class="w-full border-gray-300 rounded p-2 border">{{ old('content', $project->content) }}</textarea>
        </div>
    </div>

    <div class="mt-6">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
        <a href="{{ route('admin.projects.index') }}" class="ml-3 text-gray-600">Hủy</a>
    </div>
</form>
@endsection