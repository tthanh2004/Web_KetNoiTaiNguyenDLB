@extends('admin.layout.app')
@section('content')
<h1 class="font-bold text-2xl mb-6">Sửa Chi Tiết Phí</h1>
<form action="{{ route('admin.fee-items.update', $feeItem->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf @method('PUT')
    
    <div class="mb-4">
        <label class="block mb-1">Tên loại phí</label>
        <input name="name" value="{{ $feeItem->name }}" class="w-full border p-2 rounded" required>
    </div>

    <div class="flex gap-4 mb-4">
        <div class="w-1/2">
            <label class="block mb-1">Đơn vị tính</label>
            <input name="unit" value="{{ $feeItem->unit }}" class="w-full border p-2 rounded" required>
        </div>
        <div class="w-1/2">
            <label class="block mb-1">Đơn giá</label>
            <input type="number" name="price" value="{{ $feeItem->price }}" class="w-full border p-2 rounded" required>
        </div>
    </div>
    
    <button class="bg-blue-600 text-white px-4 py-2 rounded">Lưu thay đổi</button>
</form>
@endsection