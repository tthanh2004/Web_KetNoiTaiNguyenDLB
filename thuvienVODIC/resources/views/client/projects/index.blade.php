@extends('client.layout')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 border-b-2 border-primary pb-2">
            <i class="fa-solid fa-folder-open mr-2"></i>Dự án / Đề án công khai
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($projects as $project)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition duration-300 overflow-hidden border border-gray-200 flex flex-col">
                <div class="p-5 flex-grow">
                    <div class="text-xs font-bold text-primary uppercase mb-2">
                        {{ $project->implementing_unit->name ?? 'Đơn vị chưa xác định' }}
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                        {{ $project->name }}
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                        {{ $project->content }}
                    </p>
                    <div class="text-xs text-gray-500">
                        <i class="fa-regular fa-calendar mr-1"></i> Bắt đầu: {{ $project->start_date ?? 'N/A' }}
                    </div>
                </div>
                <div class="bg-gray-50 p-4 border-t border-gray-100">
                    <a href="{{ route('client.project.detail', $project->id) }}" class="block text-center text-primary font-semibold hover:text-blue-800">
                        Xem chi tiết & Tài liệu <i class="fa-solid fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $projects->links() }} 
        </div>
    </div>

    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-yellow-500 sticky top-4">
            <h3 class="text-xl font-bold text-gray-800 mb-4">
                <i class="fa-solid fa-paper-plane mr-2"></i>Gửi yêu cầu dữ liệu
            </h3>
            <p class="text-sm text-gray-600 mb-4">Bạn không tìm thấy dữ liệu cần thiết? Hãy gửi yêu cầu trực tiếp cho chúng tôi.</p>
            
            <form action="{{ route('client.data_requests.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Họ và tên <span class="text-red-500">*</span></label>
                    <input type="text" name="fullname" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Số điện thoại</label>
                    <input type="text" name="phone" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nội dung yêu cầu <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary focus:border-primary"></textarea>
                </div>
                <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                    Gửi yêu cầu
                </button>
            </form>
        </div>
    </div>
</div>
@endsection