@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
            <div>
                <h1 class="text-3xl font-serif text-blue-900 font-bold mb-2">Thống kê Tài liệu số hóa</h1>
                <p class="text-slate-500 max-w-2xl">Kho lưu trữ số hóa các báo cáo khoa học, số liệu điều tra cơ bản và bản đồ biển đảo.</p>
            </div>
            <div class="w-full md:w-auto">
                <button class="bg-blue-900 hover:bg-cyan-700 text-white px-6 py-2.5 rounded-lg font-bold shadow-md transition-all flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Xuất báo cáo tổng hợp
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-server text-6xl text-blue-900"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Tổng tài liệu</div>
                <div class="text-3xl font-bold text-blue-900">1,258</div>
                <div class="text-xs text-green-600 mt-2 font-bold flex items-center gap-1">
                    <i class="fa-solid fa-arrow-trend-up"></i> +45 tháng này
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-map text-6xl text-green-700"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Bản đồ số hóa</div>
                <div class="text-3xl font-bold text-green-700">342</div>
                <div class="text-xs text-slate-400 mt-2">Tỷ lệ 1:50.000 - 1:200.000</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-file-contract text-6xl text-orange-600"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Báo cáo khoa học</div>
                <div class="text-3xl font-bold text-orange-600">685</div>
                <div class="text-xs text-slate-400 mt-2">Đề án 47, KC-09, 48B...</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i class="fa-solid fa-flask text-6xl text-purple-600"></i>
                </div>
                <div class="text-sm font-bold text-slate-500 uppercase tracking-wider mb-1">Dữ liệu quan trắc</div>
                <div class="text-3xl font-bold text-purple-600">231</div>
                <div class="text-xs text-slate-400 mt-2">Hóa học, Sinh học, Thủy văn</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-chart-pie text-blue-500"></i> Phân bố tài liệu theo lĩnh vực
                </h3>
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-700">Địa chất & Khoáng sản biển</span>
                            <span class="font-bold text-blue-600">35%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 35%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-700">Môi trường & Sinh thái (Đầm phá, Rạn san hô)</span>
                            <span class="font-bold text-green-500">28%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 28%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-700">Nguồn lợi thủy hải sản (Cá đáy, Cá ngừ...)</span>
                            <span class="font-bold text-orange-500">20%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-orange-500 h-2.5 rounded-full" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="font-medium text-slate-700">Khí tượng thủy văn & Hải văn</span>
                            <span class="font-bold text-purple-500">17%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5">
                            <div class="bg-purple-500 h-2.5 rounded-full" style="width: 17%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-crown text-yellow-500"></i> Chương trình trọng điểm
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-center gap-3 pb-3 border-b border-slate-50 last:border-0">
                        <span class="w-8 h-8 rounded bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">1</span>
                        <div class="flex-1">
                            <div class="font-bold text-slate-700 text-sm">Chương trình biển KC-09</div>
                            <div class="text-xs text-slate-400">120 tài liệu</div>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 pb-3 border-b border-slate-50 last:border-0">
                        <span class="w-8 h-8 rounded bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">2</span>
                        <div class="flex-1">
                            <div class="font-bold text-slate-700 text-sm">Đề án 47</div>
                            <div class="text-xs text-slate-400">98 tài liệu</div>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 pb-3 border-b border-slate-50 last:border-0">
                        <span class="w-8 h-8 rounded bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">3</span>
                        <div class="flex-1">
                            <div class="font-bold text-slate-700 text-sm">Chương trình 48B (1986-1990)</div>
                            <div class="text-xs text-slate-400">65 tài liệu</div>
                        </div>
                    </li>
                    <li class="flex items-center gap-3 pb-3 border-b border-slate-50 last:border-0">
                        <span class="w-8 h-8 rounded bg-blue-50 text-blue-600 font-bold flex items-center justify-center text-sm">4</span>
                        <div class="flex-1">
                            <div class="font-bold text-slate-700 text-sm">Điều tra Vịnh Bắc Bộ</div>
                            <div class="text-xs text-slate-400">42 tài liệu</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800"><i class="fa-solid fa-list mr-2"></i> Danh sách tài liệu mới cập nhật</h3>
                <div class="relative">
                    <input type="text" placeholder="Tìm nhanh..." class="pl-8 pr-3 py-1 text-xs border border-slate-300 rounded-full focus:outline-none focus:border-blue-500">
                    <i class="fa-solid fa-search absolute left-3 top-1.5 text-slate-400 text-xs"></i>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                        <tr>
                            <th class="px-6 py-3">Tên tài liệu</th>
                            <th class="px-6 py-3">Loại hình</th>
                            <th class="px-6 py-3">Đơn vị / Nguồn</th>
                            <th class="px-6 py-3 text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        
                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Đánh giá tiềm năng và biến động tài nguyên hệ thống đầm phá Tam Giang – Cầu Hai</div>
                                <div class="text-xs text-slate-400 mt-1">Mã số: TG-CH-2023</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-bold border border-purple-200">Báo cáo KH</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Viện TN&MT Biển</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Báo cáo tổng kết chuyên đề nghiên cứu hệ thống bản đồ Vịnh Diễn Châu tỷ lệ 1:200.000</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-green-100 text-green-700 text-xs font-bold border border-green-200">Bản đồ</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Cục Địa chất & Khoáng sản VN</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Đặc điểm phân bố và biến động các yếu tố hóa học – môi trường nước biển vịnh Bắc Bộ</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-bold border border-blue-200">Số liệu</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Trung tâm Động lực & MT Biển</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Đánh giá nguồn lợi cá đáy và gần đáy vùng biển quần đảo Trường Sa</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-orange-100 text-orange-700 text-xs font-bold border border-orange-200">Nguồn lợi</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Viện Nghiên cứu Hải sản</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                        <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Báo cáo chuyên đề xác định tầm nhìn chiến lược cho quản lý tổng hợp vùng bờ vịnh Hạ Long – Quảng Ninh</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-slate-100 text-slate-700 text-xs font-bold border border-slate-200">Quy hoạch</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Viện Kinh tế & Quy hoạch Thủy sản</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                         <tr class="hover:bg-blue-50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-blue-700">Đặc điểm địa hình, địa mạo đáy biển vịnh Bắc Bộ Việt Nam</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded bg-purple-100 text-purple-700 text-xs font-bold border border-purple-200">Báo cáo KH</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Cục Địa chất & Khoáng sản VN</td>
                            <td class="px-6 py-4 text-center"><i class="fa-solid fa-circle-check text-green-500"></i></td>
                        </tr>

                    </tbody>
                </table>
            </div>
            
            <div class="bg-slate-50 px-6 py-4 border-t border-slate-200 flex justify-center">
                <div class="flex gap-2">
                    <button class="w-8 h-8 rounded border border-slate-300 bg-white text-slate-500 hover:bg-blue-50 hover:text-blue-600"><i class="fa-solid fa-chevron-left"></i></button>
                    <button class="w-8 h-8 rounded border border-blue-500 bg-blue-500 text-white font-bold">1</button>
                    <button class="w-8 h-8 rounded border border-slate-300 bg-white text-slate-500 hover:bg-blue-50 hover:text-blue-600">2</button>
                    <button class="w-8 h-8 rounded border border-slate-300 bg-white text-slate-500 hover:bg-blue-50 hover:text-blue-600">3</button>
                    <span class="w-8 h-8 flex items-center justify-center text-slate-400">...</span>
                    <button class="w-8 h-8 rounded border border-slate-300 bg-white text-slate-500 hover:bg-blue-50 hover:text-blue-600"><i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection