@extends('admin.layout.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Thêm Dự án mới</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-4">
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Mã dự án (Số hiệu)</label>
                <input type="text" name="code_number" value="{{ old('code_number') }}" class="w-full border-gray-300 rounded p-2 border" placeholder="VD: DA-47-01">
            </div>
            <div class="col-span-3">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tên Dự án <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded p-2 border" placeholder="Nhập tên đầy đủ của dự án...">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Thuộc Nhóm Dự án <span class="text-red-500">*</span></label>
                <select name="project_group_id" required class="w-full border-gray-300 rounded p-2 bg-white border">
                    <option value="">-- Chọn nhóm --</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ old('project_group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Đơn vị chủ trì <span class="text-red-500">*</span></label>
                <select name="implementing_unit_id" required class="w-full border-gray-300 rounded p-2 bg-white border">
                    <option value="">-- Chọn đơn vị --</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('implementing_unit_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="my-6 border-gray-200">

        <h3 class="text-lg font-bold text-blue-800 mb-4"><i class="fa-solid fa-clock-rotate-left mr-2"></i> Thiết lập Trạng thái & Tiến độ</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4 bg-blue-50 p-4 rounded-lg border border-blue-100">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Trạng thái hiện tại</label>
                <select name="status" id="statusSelect" onchange="toggleCompletedDate()" class="w-full border-gray-300 rounded p-2 bg-white border">
                    <option value="new" {{ old('status') == 'new' ? 'selected' : '' }}>✨ Mới khởi tạo</option>
                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>🔵 Đang thực hiện</option>
                    <option value="paused" {{ old('status') == 'paused' ? 'selected' : '' }}>🟠 Tạm dừng</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>🟢 Đã hoàn thành</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ngày bắt đầu</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border-gray-300 rounded p-2 border bg-white">
            </div>

            <div id="completedDateWrapper" class="hidden transition-all duration-300">
                <label class="block text-sm font-bold text-green-700 mb-1">Ngày hoàn thành</label>
                <input type="date" name="completed_at" value="{{ old('completed_at') }}" class="w-full border-green-500 rounded p-2 border bg-white">
            </div>
        </div>

        <div class="mb-6 px-1">
            <label class="block text-sm font-medium text-gray-700 mb-2 flex justify-between">
                <span>Tiến độ thực hiện (%)</span>
                <span id="progressLabel" class="font-bold text-blue-600">{{ old('progress', 0) }}%</span>
            </label>
            <input type="range" name="progress" id="progressInput" min="0" max="100" value="{{ old('progress', 0) }}" 
                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                   oninput="updateProgress(this.value)">
            <div class="flex justify-between text-xs text-gray-400 mt-1">
                <span>0%</span>
                <span>50%</span>
                <span>100%</span>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung tóm tắt</label>
            <textarea name="content" rows="4" class="w-full border-gray-300 rounded p-2 border">{{ old('content') }}</textarea>
        </div>

        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.projects.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2 px-4 rounded border">Hủy bỏ</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow">
                <i class="fa-solid fa-save mr-1"></i> Lưu Dự Án
            </button>
        </div>
    </form>
</div>

<script>
    // Hàm cập nhật số % khi kéo thanh trượt
    function updateProgress(val) {
        document.getElementById('progressLabel').innerText = val + '%';
        
        // Tự động đổi trạng thái gợi ý
        const statusSelect = document.getElementById('statusSelect');
        if (val == 100) {
            statusSelect.value = 'completed';
        } else if (val > 0 && val < 100 && statusSelect.value == 'new') {
            statusSelect.value = 'ongoing';
        }
        toggleCompletedDate();
    }

    // Hàm ẩn hiện ô ngày hoàn thành
    function toggleCompletedDate() {
        const status = document.getElementById('statusSelect').value;
        const dateWrapper = document.getElementById('completedDateWrapper');
        
        if (status === 'completed') {
            dateWrapper.classList.remove('hidden');
            // Animation nhẹ
            dateWrapper.style.opacity = 0;
            setTimeout(() => dateWrapper.style.opacity = 1, 50);
        } else {
            dateWrapper.classList.add('hidden');
        }
    }

    // Chạy khi load trang (để giữ trạng thái nếu validate lỗi)
    document.addEventListener('DOMContentLoaded', function() {
        toggleCompletedDate();
    });
</script>
@endsection