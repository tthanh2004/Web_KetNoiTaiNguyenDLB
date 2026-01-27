@extends('admin.layout.app')
@section('content')
<h1 class="font-bold text-2xl mb-6">Sửa Nhóm Phí</h1>
<form action="{{ route('admin.fee-categories.update', $feeCategory->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-md">
    @csrf @method('PUT')
    <label class="block mb-2 font-bold">Tên nhóm</label>
    <input name="name" value="{{ $feeCategory->name }}" class="w-full border p-2 rounded mb-4" required>
    
    <label class="block mb-2 font-bold">Thứ tự</label>
    <input type="number" name="order" value="{{ $feeCategory->order }}" class="w-full border p-2 rounded mb-4">
    
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Cập nhật</button>
</form>
@endsection