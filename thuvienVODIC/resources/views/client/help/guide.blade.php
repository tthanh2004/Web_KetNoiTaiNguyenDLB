@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="mb-10 text-center max-w-3xl mx-auto">
            <span class="text-blue-600 font-bold uppercase tracking-widest text-xs mb-2 block">Hỗ trợ người dùng</span>
            <h1 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                Hướng dẫn Tra cứu & Khai thác dữ liệu
            </h1>
            <p class="text-slate-500">Quy trình 4 bước đơn giản để tìm kiếm và tiếp cận nguồn dữ liệu tài nguyên, môi trường biển quốc gia.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-blue-200 transition-colors">
                    <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-bl-2xl text-xl">01</div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-none group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-magnifying-glass text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3">Tìm kiếm & Tra cứu</h3>
                            <p class="text-slate-600 mb-4 leading-relaxed">
                                Truy cập vào trang <strong>Tra cứu</strong> trên thanh menu. Bạn có thể tìm kiếm dữ liệu theo 3 cách:
                            </p>
                            <ul class="space-y-2 text-sm text-slate-500">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Nhập từ khóa (Tên dự án, mã số, địa danh...).</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Lọc theo Nhóm dự án hoặc Đề án 47.</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-green-500"></i> Sắp xếp theo thời gian hoặc tên A-Z.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-blue-200 transition-colors">
                    <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-bl-2xl text-xl">02</div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-none group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-eye text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3">Xem chi tiết thông tin</h3>
                            <p class="text-slate-600 mb-4 leading-relaxed">
                                Nhấn vào tên dự án hoặc nút <strong>"Xem chi tiết"</strong> để truy cập trang thông tin đầy đủ. Tại đây hệ thống cung cấp:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-slate-500">
                                <div class="bg-slate-50 p-2 rounded border border-slate-100"><i class="fa-solid fa-circle-info text-blue-400 mr-2"></i> Thông tin chung</div>
                                <div class="bg-slate-50 p-2 rounded border border-slate-100"><i class="fa-solid fa-building text-blue-400 mr-2"></i> Đơn vị thực hiện</div>
                                <div class="bg-slate-50 p-2 rounded border border-slate-100"><i class="fa-solid fa-layer-group text-blue-400 mr-2"></i> Sản phẩm dự án</div>
                                <div class="bg-slate-50 p-2 rounded border border-slate-100"><i class="fa-solid fa-paperclip text-blue-400 mr-2"></i> Tài liệu đính kèm</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-blue-200 transition-colors">
                    <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-bl-2xl text-xl">03</div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-none group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-download text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3">Tải về tài liệu công khai</h3>
                            <p class="text-slate-600 leading-relaxed">
                                Đối với các tài liệu được phép công khai (Quyết định phê duyệt, Báo cáo tóm tắt...), bạn có thể nhấn nút <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 px-2 py-0.5 rounded text-xs font-bold"><i class="fa-solid fa-download"></i> Tải về</span> để lưu trữ về máy tính.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 relative overflow-hidden group hover:border-blue-200 transition-colors">
                    <div class="absolute top-0 right-0 bg-blue-50 text-blue-600 font-bold px-4 py-2 rounded-bl-2xl text-xl">04</div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 flex-none group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i class="fa-regular fa-paper-plane text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3">Gửi yêu cầu dữ liệu chuyên sâu</h3>
                            <p class="text-slate-600 mb-4 leading-relaxed">
                                Đối với các dữ liệu chuyên ngành, bản đồ gốc hoặc số liệu chi tiết. Vui lòng sử dụng chức năng <strong>"Gửi yêu cầu dữ liệu"</strong>.
                            </p>
                            <a href="{{ route('client.request.create') }}" class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg shadow-md transition-all">
                                Đi tới form yêu cầu
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-4 space-y-6">
                
                <div class="bg-blue-900 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                    <h3 class="text-lg font-bold mb-3 relative z-10">Liên hệ trực tiếp</h3>
                    <p class="text-blue-100 text-sm mb-6 leading-relaxed relative z-10">
                        Nếu bạn gặp khó khăn trong quá trình tra cứu, vui lòng liên hệ bộ phận kỹ thuật.
                    </p>
                    <ul class="space-y-3 relative z-10 text-sm">
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center text-yellow-400"><i class="fa-solid fa-phone"></i></div>
                            <span class="font-bold">(84-24) 376 18159</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-white/10 flex items-center justify-center text-yellow-400"><i class="fa-solid fa-envelope"></i></div>
                            <span>hoanglong@vodic.vn</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h3 class="font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">Câu hỏi thường gặp</h3>
                    <div class="space-y-4">
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-slate-700 hover:text-blue-600">
                                <span>Tôi có cần tài khoản không?</span>
                                <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-xs"></i></span>
                            </summary>
                            <div class="text-slate-500 text-sm mt-2 leading-relaxed pl-2 border-l-2 border-slate-200">
                                Không. Bạn có thể tra cứu thông tin công khai mà không cần đăng nhập.
                            </div>
                        </details>
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-slate-700 hover:text-blue-600">
                                <span>Phí khai thác dữ liệu là bao nhiêu?</span>
                                <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-xs"></i></span>
                            </summary>
                            <div class="text-slate-500 text-sm mt-2 leading-relaxed pl-2 border-l-2 border-slate-200">
                                Tùy thuộc vào loại dữ liệu và mục đích sử dụng. Vui lòng xem <a href="{{ route('client.services.fees') }}" class="text-blue-600 underline">Biểu mức thu phí</a>.
                            </div>
                        </details>
                        <details class="group">
                            <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-slate-700 hover:text-blue-600">
                                <span>Thời gian xử lý yêu cầu?</span>
                                <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-xs"></i></span>
                            </summary>
                            <div class="text-slate-500 text-sm mt-2 leading-relaxed pl-2 border-l-2 border-slate-200">
                                Thông thường từ 3-5 ngày làm việc sau khi nhận được yêu cầu hợp lệ.
                            </div>
                        </details>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection