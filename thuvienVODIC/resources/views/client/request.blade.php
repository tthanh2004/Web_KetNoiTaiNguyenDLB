@extends('client.layout')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-blue-800 px-8 py-6 text-white">
                <h1 class="text-2xl font-serif font-bold mb-2">Gửi yêu cầu dữ liệu</h1>
                <p class="text-blue-100 text-sm font-light">Vui lòng điền thông tin chi tiết để chúng tôi hỗ trợ tốt nhất.</p>
            </div>

            <div class="p-8">
                @if(session('success'))
                    <div class="bg-green-50 text-green-700 p-4 rounded mb-6 flex items-center">
                        <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('client.request.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Họ và tên <span class="text-red-500">*</span></label>
                            <input type="text" name="fullname" required class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 border p-2.5 bg-gray-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email liên hệ <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 border p-2.5 bg-gray-50">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                        <input type="text" name="phone" class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 border p-2.5 bg-gray-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nội dung yêu cầu <span class="text-red-500">*</span></label>
                        <textarea name="content" rows="5" required class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 border p-2.5 bg-gray-50" placeholder="Mô tả chi tiết dữ liệu bạn cần..."></textarea>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700 text-sm font-medium px-4">Hủy bỏ</a>
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2.5 px-6 rounded shadow-lg transition transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-paper-plane mr-2"></i> Gửi ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection