@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Biểu Phí Dịch vụ</h1>
    <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="bg-green-600 text-white px-4 py-2 rounded shadow">
        <i class="fa-solid fa-folder-plus mr-2"></i> Thêm Nhóm phí mới
    </button>
</div>

<div class="space-y-8">
    @foreach($feeCategories as $cat)
    <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
        
        <div class="bg-gray-100 px-6 py-3 flex justify-between items-center border-b">
            <h3 class="font-bold text-gray-800 uppercase">{{ $cat->name }}</h3>
            <div class="flex gap-2 items-center">
                <button class="text-blue-600 text-sm hover:underline mr-2" onclick="openAddItemModal({{ $cat->id }})">
                    <i class="fa-solid fa-plus"></i> Thêm dòng phí
                </button>
                
                <a href="{{ route('admin.fee-categories.edit', $cat->id) }}" class="text-yellow-600 hover:underline text-sm mr-2">
                    <i class="fa-solid fa-pen-to-square"></i> Sửa nhóm
                </a>

                <form action="{{ route('admin.fee-categories.destroy', $cat->id) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-500 text-sm hover:underline" onclick="return confirm('CẢNH BÁO: Xóa nhóm này sẽ xóa tất cả các phí bên trong. Bạn có chắc không?')">
                        <i class="fa-solid fa-trash"></i> Xóa nhóm
                    </button>
                </form>
            </div>
        </div>

        <table class="w-full text-sm text-left">
            <thead class="text-gray-500 bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-2">Tên loại phí</th>
                    <th class="px-6 py-2 w-32">Đơn vị tính</th>
                    <th class="px-6 py-2 w-40 text-right">Giá (VNĐ)</th>
                    <th class="px-6 py-2 w-24 text-right">Hành động</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($cat->feeItems as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-2">{{ $item->name }}</td>
                    <td class="px-6 py-2">{{ $item->unit }}</td>
                    <td class="px-6 py-2 text-right font-bold">{{ number_format($item->price) }}</td>
                    <td class="px-6 py-2 text-right">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.fee-items.edit', $item->id) }}" class="text-blue-500 hover:text-blue-700" title="Sửa phí">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('admin.fee-items.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600" title="Xóa phí" onclick="return confirm('Xóa loại phí này?')">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach
</div>

<div id="addItemModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h3 class="font-bold mb-4">Thêm phí vào nhóm</h3>
        <form action="{{ route('admin.fee-items.store') }}" method="POST">
            @csrf
            <input type="hidden" name="fee_category_id" id="modal_cat_id">
            <div class="mb-3">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tên loại phí</label>
                <input type="text" name="name" class="w-full border p-2 rounded focus:outline-blue-500" required>
            </div>
            <div class="flex gap-3 mb-3">
                <div class="w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Đơn vị tính</label>
                    <input type="text" name="unit" placeholder="tờ, mảnh..." class="w-full border p-2 rounded focus:outline-blue-500" required>
                </div>
                <div class="w-1/2">
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Giá tiền</label>
                    <input type="number" name="price" placeholder="VNĐ" class="w-full border p-2 rounded focus:outline-blue-500" required>
                </div>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('addItemModal').classList.add('hidden')" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Hủy</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lưu</button>
            </div>
        </form>
    </div>
</div>

<div id="addCategoryModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
        <div class="flex justify-between items-center mb-4 border-b pb-2">
            <h3 class="font-bold text-lg text-gray-800">Thêm Nhóm Phí Mới</h3>
            <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.fee-categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tên nhóm phí <span class="text-red-500">*</span></label>
                <input type="text" name="name" class="w-full border border-gray-300 p-2.5 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none" required>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Thứ tự hiển thị</label>
                <input type="number" name="order" value="0" class="w-full border border-gray-300 p-2.5 rounded-md focus:ring-blue-500 focus:border-blue-500 outline-none">
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="px-4 py-2 text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-md">Hủy bỏ</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 shadow-md">Lưu nhóm</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddItemModal(catId) {
        document.getElementById('modal_cat_id').value = catId;
        document.getElementById('addItemModal').classList.remove('hidden');
    }
</script>
@endsection