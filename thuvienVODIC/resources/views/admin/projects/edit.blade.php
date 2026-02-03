@extends('admin.layout.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Cập nhật Dự án: {{ $project->name }}</h2>
        <a href="{{ route('admin.projects.index') }}" class="text-gray-600 hover:text-blue-600">
            <i class="fa-solid fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded shadow-lg mb-8">
        @csrf
        @method('PUT')
        
        <h3 class="text-lg font-bold text-blue-800 mb-4 border-b pb-2">1. Phân loại & Thông tin chung</h3>
        
        {{-- LOGIC DỰ ÁN CHA / CON --}}
        <div class="bg-blue-50 p-4 rounded border border-blue-100 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- 1. Chọn cấp dự án --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Thuộc Dự án lớn (Dự án Cha)</label>
                    <select name="parent_id" id="parentSelect" onchange="toggleOwnerFields()" class="w-full border-blue-300 rounded p-2 bg-white border focus:ring-blue-500"
                        {{-- Nếu đang có dự án con thì không cho sửa field này (để tránh lỗi logic) --}}
                        {{ $project->children->count() > 0 ? 'disabled' : '' }}>
                        
                        <option value="">-- Không (Đây là Dự án Lớn / Cấp Bộ) --</option>
                        @foreach($parents as $p)
                            <option value="{{ $p->id }}" {{ old('parent_id', $project->parent_id) == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->code_number }})
                            </option>
                        @endforeach
                    </select>

                    {{-- Nếu disabled select ở trên thì cần gửi input hidden để controller nhận được giá trị cũ --}}
                    @if($project->children->count() > 0)
                        <input type="hidden" name="parent_id" value="">
                        <p class="text-xs text-red-500 mt-1 italic">* Dự án này đang có dự án thành phần, không thể chuyển thành dự án con.</p>
                    @else
                        <p class="text-xs text-gray-500 mt-1 italic">Chọn "Không" nếu đây là dự án cấp Bộ chủ trì.</p>
                    @endif
                </div>

                {{-- 2. Chọn Nhóm --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nhóm Dự án <span class="text-red-500">*</span></label>
                    <select name="project_group_id" required class="w-full border-gray-300 rounded p-2 bg-white border">
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}" {{ old('project_group_id', $project->project_group_id) == $group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- CÁC TRƯỜNG CƠ BẢN --}}
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-6">
            <div class="md:col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-2">Ảnh đại diện</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-2 text-center relative h-40 flex items-center justify-center hover:bg-gray-50 transition-colors">
                    <input type="file" name="thumbnail" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                    <div id="imgPreview" class="w-full h-full flex items-center justify-center overflow-hidden">
                        @if($project->thumbnail)
                            <img src="{{ $project->thumbnail_url }}" class="w-full h-full object-contain rounded">
                        @else
                            <div class="text-gray-400 flex flex-col items-center">
                                <i class="fa-regular fa-image text-3xl mb-1"></i>
                                <span class="text-xs">Chưa có ảnh</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-9 grid grid-cols-2 gap-4">
                 <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-1">Tên Dự án <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $project->name) }}" required class="w-full border-gray-300 rounded p-2.5 border">
                 </div>
                 <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mã phê duyệt</label>
                    <input type="text" name="code_number" value="{{ old('code_number', $project->code_number) }}" class="w-full border-gray-300 rounded p-2 border">
                 </div>
            </div>
        </div>

        {{-- PHẦN 2: ĐƠN VỊ QUẢN LÝ (DYNAMIC) --}}
        <h3 class="text-lg font-bold text-blue-800 mb-4 border-b pb-2 mt-6">2. Đơn vị quản lý</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            {{-- CASE A: BỘ CHỦ TRÌ (Hiện khi parent_id Rỗng) --}}
            <div id="ministryWrapper">
                <label class="block text-sm font-bold text-blue-900 mb-1">
                    <i class="fa-solid fa-landmark mr-1"></i> Bộ / Ngành chủ trì <span class="text-red-500">*</span>
                </label>
                <select name="ministry_id" id="ministrySelect" class="w-full border-blue-300 rounded p-2 bg-blue-50 border">
                    <option value="">-- Chọn Bộ ngành --</option>
                    @foreach($ministries as $min)
                        <option value="{{ $min->id }}" {{ old('ministry_id', $project->ministry_id) == $min->id ? 'selected' : '' }}>
                            {{ $min->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-blue-600 mt-1">Dành cho Dự án Lớn (Cấp Chính phủ/Bộ)</p>
            </div>

            {{-- CASE B: ĐƠN VỊ THỰC HIỆN (Hiện khi parent_id Có giá trị) --}}
            <div id="unitWrapper" class="hidden">
                <label class="block text-sm font-bold text-green-900 mb-1">
                    <i class="fa-solid fa-building-user mr-1"></i> Đơn vị thực hiện <span class="text-red-500">*</span>
                </label>
                <select name="implementing_unit_id" id="unitSelect" class="w-full border-green-300 rounded p-2 bg-green-50 border" disabled>
                    <option value="">-- Chọn Đơn vị thực hiện --</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('implementing_unit_id', $project->implementing_unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-green-600 mt-1">Dành cho Dự án Thành phần</p>
            </div>
        </div>

        {{-- PHẦN 3: THÔNG TIN CHI TIẾT (Giữ nguyên) --}}
        <h3 class="text-lg font-bold text-blue-800 mb-4 border-b pb-2 mt-8">3. Thông tin chi tiết</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Năm bắt đầu</label><input type="number" name="start_year" value="{{ old('start_year', $project->start_year) }}" class="w-full border-gray-300 rounded p-2 border"></div>
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Năm kết thúc</label><input type="number" name="end_year" value="{{ old('end_year', $project->end_year) }}" class="w-full border-gray-300 rounded p-2 border"></div>
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Kinh phí (VNĐ)</label><input type="number" name="budget" value="{{ old('budget', $project->budget) }}" class="w-full border-gray-300 rounded p-2 border"></div>
             <div><label class="block text-sm font-bold text-green-700 mb-1">Giá bán số liệu</label><input type="number" name="price" value="{{ old('price', $project->price) }}" class="w-full border-green-300 rounded p-2 border bg-green-50"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Mã thư viện</label><input type="text" name="library_code" value="{{ old('library_code', $project->library_code) }}" class="w-full border-gray-300 rounded p-2 border font-mono"></div>
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Vị trí tủ/ngăn</label><input type="text" name="cabinet_location" value="{{ old('cabinet_location', $project->cabinet_location) }}" class="w-full border-gray-300 rounded p-2 border"></div>
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Tỉ lệ bản đồ</label><input type="text" name="scale" value="{{ old('scale', $project->scale) }}" class="w-full border-gray-300 rounded p-2 border"></div>
             <div><label class="block text-sm font-medium text-gray-700 mb-1">Người nhập liệu</label><input type="text" name="data_entry_person" value="{{ old('data_entry_person', $project->data_entry_person) }}" class="w-full border-gray-300 rounded p-2 border bg-gray-50" readonly></div>
        </div>

        <div class="mb-6"><label class="block text-sm font-medium text-gray-700 mb-1">Nội dung tóm tắt</label><textarea name="content" rows="4" class="w-full border-gray-300 rounded p-2 border">{{ old('content', $project->content) }}</textarea></div>
        <div class="mb-6"><label class="block text-sm font-medium text-gray-700 mb-1">Ghi chú thêm</label><textarea name="note" rows="2" class="w-full border-gray-300 rounded p-2 border">{{ old('note', $project->note) }}</textarea></div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-8 rounded shadow transition-colors">
                <i class="fa-solid fa-save mr-2"></i> Lưu thay đổi
            </button>
        </div>
    </form>

    {{-- KHU VỰC QUẢN LÝ DỰ ÁN CON --}}
    <div class="bg-white p-8 rounded shadow-lg border-t-4 border-yellow-500">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">
                <i class="fa-solid fa-sitemap mr-2"></i> Các Dự án Thành phần (Con)
            </h3>
            {{-- CHỖ NÀY QUAN TRỌNG: Truyền parent_id sang trang Create --}}
            <a href="{{ route('admin.projects.create', ['parent_id' => $project->id]) }}" class="text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded hover:bg-yellow-200 transition-colors">
                <i class="fa-solid fa-plus mr-1"></i> Thêm dự án con
            </a>
        </div>

        @if($project->children->count() > 0)
            <div class="overflow-x-auto border rounded-lg">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Tên dự án con</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Mã số</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Thời gian</th>
                            <th class="px-4 py-3 text-right font-medium text-gray-500">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($project->children as $child)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $child->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $child->code_number ?? '---' }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $child->start_year }} - {{ $child->end_year }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.projects.edit', $child->id) }}" class="text-blue-600 hover:underline font-bold">Sửa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-6 bg-slate-50 border border-dashed border-gray-300 rounded text-gray-500">
                <p>Dự án này chưa có dự án thành phần nào.</p>
            </div>
        @endif
    </div>
</div>

<script>
    // Preview Ảnh
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-contain rounded">`;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Logic Ẩn/Hiện Form Bộ & Đơn vị (Quan trọng: Thêm .disabled để không gửi dữ liệu rác)
    function toggleOwnerFields() {
        const parentId = document.getElementById('parentSelect').value;
        const ministryWrapper = document.getElementById('ministryWrapper');
        const unitWrapper = document.getElementById('unitWrapper');
        const ministrySelect = document.getElementById('ministrySelect');
        const unitSelect = document.getElementById('unitSelect');

        if (parentId) {
            // LÀ DỰ ÁN CON: Hiện Đơn vị, Ẩn Bộ
            ministryWrapper.classList.add('hidden');
            ministrySelect.disabled = true; 
            ministrySelect.required = false;

            unitWrapper.classList.remove('hidden');
            unitSelect.disabled = false;
            unitSelect.required = true;
        } else {
            // LÀ DỰ ÁN CHA: Hiện Bộ, Ẩn Đơn vị
            ministryWrapper.classList.remove('hidden');
            ministrySelect.disabled = false;
            ministrySelect.required = true;

            unitWrapper.classList.add('hidden');
            unitSelect.disabled = true;
            unitSelect.required = false;
        }
    }

    // Chạy khi load trang
    document.addEventListener('DOMContentLoaded', toggleOwnerFields);
</script>
@endsection