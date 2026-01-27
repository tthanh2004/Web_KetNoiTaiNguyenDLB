@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Cập nhật Tiến độ Dự án</h1>

<form action="{{ route('admin.projects.update', $project->id) }}" method="POST" class="bg-white p-6 rounded shadow max-w-4xl">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="col-span-2">
            <label class="block text-sm font-medium text-gray-700">Tên dự án</label>
            <input type="text" name="name" value="{{ $project->name }}" class="w-full border-gray-300 rounded p-2 border bg-gray-50" readonly>
            <p class="text-xs text-gray-500 mt-1">Thông tin cơ bản không sửa ở đây (để tránh sai lệch)</p>
        </div>
        
        <input type="hidden" name="project_group_id" value="{{ $project->project_group_id }}">
        <input type="hidden" name="implementing_unit_id" value="{{ $project->implementing_unit_id }}">

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Trạng thái hiện tại</label>
            <select name="status" id="statusSelect" onchange="toggleCompletedDate()" class="w-full border-gray-300 rounded p-2 border focus:ring-blue-500">
                <option value="new" {{ $project->status == 'new' ? 'selected' : '' }}>Mới khởi tạo</option>
                <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>🔵 Đang thực hiện</option>
                <option value="paused" {{ $project->status == 'paused' ? 'selected' : '' }}>🟠 Tạm dừng</option>
                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>🟢 Đã hoàn thành</option>
            </select>
        </div>

        <div id="completedDateWrapper" class="{{ $project->status == 'completed' ? '' : 'hidden' }}">
            <label class="block text-sm font-bold text-green-700 mb-1">Ngày nghiệm thu / Hoàn thành</label>
            <input type="date" name="completed_at" 
                   value="{{ $project->completed_at ? $project->completed_at->format('Y-m-d') : '' }}" 
                   class="w-full border-green-300 rounded p-2 border bg-green-50">
        </div>

        <div class="col-span-2 bg-slate-50 p-4 rounded border border-slate-200 mt-2">
            <label class="block text-sm font-bold text-gray-700 mb-2">
                Tiến độ thực hiện: <span id="progressValue" class="text-blue-600 text-lg">{{ $project->progress }}</span>%
            </label>
            <input type="range" name="progress" id="progressInput" 
                   min="0" max="100" step="1" value="{{ $project->progress }}" 
                   class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                   oninput="updateProgressDisplay(this.value)">
            
            <div class="flex justify-between text-xs text-gray-400 mt-1">
                <span>0% (Mới)</span>
                <span>50%</span>
                <span>100% (Xong)</span>
            </div>
        </div>

    </div>

    <div class="mt-6 flex justify-end gap-3">
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded">Hủy bỏ</a>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 shadow font-bold">
            <i class="fa-solid fa-save mr-1"></i> Lưu Tiến Độ
        </button>
    </div>
</form>

<script>
    // Hàm hiển thị số % khi kéo thanh trượt
    function updateProgressDisplay(val) {
        document.getElementById('progressValue').innerText = val;
        
        // Tự động đổi trạng thái nếu kéo max 100 hoặc min 0
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
        } else {
            dateWrapper.classList.add('hidden');
        }
    }
</script>
@endsection