@extends('client.layout')

@section('content')
<div class="bg-white min-h-screen py-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-serif text-blue-900 font-bold mb-4">Các dịch vụ khác</h1>
            <p class="text-slate-500 max-w-2xl mx-auto">Ngoài việc cung cấp dữ liệu thô, chúng tôi cung cấp các dịch vụ gia tăng giá trị từ dữ liệu biển và hải đảo.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            
            <div class="bg-slate-50 rounded-xl p-8 border border-slate-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-2xl mb-6">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Biên tập và In ấn bản đồ</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">
                    Biên tập bản đồ chuyên đề, bản đồ hiện trạng theo yêu cầu riêng. Hỗ trợ in ấn khổ lớn chất lượng cao phục vụ quy hoạch và nghiên cứu.
                </p>
                <a href="{{ route('client.request.create') }}" class="text-blue-600 font-bold hover:underline">Liên hệ tư vấn <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
            </div>

            <div class="bg-slate-50 rounded-xl p-8 border border-slate-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-green-600 text-2xl mb-6">
                    <i class="fa-solid fa-hard-drive"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Số hóa dữ liệu</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">
                    Chuyển đổi tài liệu giấy, bản đồ giấy sang định dạng số (GIS, PDF, Ảnh). Chuẩn hóa dữ liệu theo quy chuẩn kỹ thuật quốc gia.
                </p>
                <a href="{{ route('client.request.create') }}" class="text-blue-600 font-bold hover:underline">Liên hệ tư vấn <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
            </div>

            <div class="bg-slate-50 rounded-xl p-8 border border-slate-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-2xl mb-6">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Phân tích & Xử lý số liệu</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">
                    Xử lý số liệu quan trắc, phân tích xu thế biến đổi, chạy mô hình toán chuyên ngành biển và hải đảo.
                </p>
                <a href="{{ route('client.request.create') }}" class="text-blue-600 font-bold hover:underline">Liên hệ tư vấn <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
            </div>

            <div class="bg-slate-50 rounded-xl p-8 border border-slate-100 hover:shadow-lg transition-shadow">
                <div class="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-2xl mb-6">
                    <i class="fa-solid fa-server"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Lưu trữ dữ liệu chuyên dụng</h3>
                <p class="text-slate-600 mb-4 leading-relaxed">
                    Dịch vụ cho thuê hạ tầng lưu trữ dữ liệu lớn (Big Data) về tài nguyên môi trường, đảm bảo an toàn và bảo mật cao.
                </p>
                <a href="{{ route('client.request.create') }}" class="text-blue-600 font-bold hover:underline">Liên hệ tư vấn <i class="fa-solid fa-arrow-right ml-1 text-xs"></i></a>
            </div>
        </div>

        <div class="bg-blue-900 rounded-2xl p-8 md:p-12 text-center text-white relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl md:text-3xl font-bold mb-4 font-serif">Bạn có yêu cầu đặc biệt?</h2>
                <p class="text-blue-100 mb-8 max-w-2xl mx-auto">Hãy gửi yêu cầu chi tiết cho chúng tôi. Đội ngũ chuyên gia sẽ liên hệ lại để tư vấn giải pháp phù hợp nhất.</p>
                <a href="{{ route('client.request.create') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 px-8 rounded-full shadow-lg transition-transform transform hover:-translate-y-1">
                    Gửi yêu cầu ngay
                </a>
            </div>
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <i class="fa-solid fa-anchor absolute -bottom-10 -right-10 text-9xl"></i>
            </div>
        </div>
    </div>
</div>
@endsection