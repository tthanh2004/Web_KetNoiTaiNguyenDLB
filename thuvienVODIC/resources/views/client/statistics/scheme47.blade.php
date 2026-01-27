@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6 max-w-6xl">
        
        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden mb-10">
            <div class="bg-blue-900 p-8 md:p-12 text-center text-white relative">
                <i class="fa-solid fa-anchor absolute top-4 left-4 text-blue-800 text-9xl opacity-20 transform -rotate-12"></i>
                <i class="fa-solid fa-map absolute bottom-4 right-4 text-blue-800 text-9xl opacity-20"></i>
                
                <span class="inline-block py-1 px-3 rounded bg-yellow-500 text-blue-900 text-xs font-bold uppercase tracking-wider mb-4">
                    Quyết định số 47/2006/QĐ-TTg
                </span>
                <h1 class="text-3xl md:text-5xl font-serif font-bold mb-4 leading-tight">
                    Đề án 47
                </h1>
                <p class="text-blue-100 text-lg max-w-3xl mx-auto font-light">
                    "Đề án tổng thể về điều tra cơ bản và quản lý tài nguyên - môi trường biển đến năm 2010, tầm nhìn đến năm 2020".
                </p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-slate-100 border-b border-slate-100">
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-blue-900 mb-1">158</div>
                    <div class="text-xs text-slate-500 uppercase font-semibold">Tổng dự án</div>
                </div>
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-green-600 mb-1">92%</div>
                    <div class="text-xs text-slate-500 uppercase font-semibold">Tỷ lệ hoàn thành</div>
                </div>
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-blue-900 mb-1">63</div>
                    <div class="text-xs text-slate-500 uppercase font-semibold">Tỉnh/Thành ven biển</div>
                </div>
                <div class="p-6 text-center">
                    <div class="text-3xl font-bold text-yellow-500 mb-1">20+</div>
                    <div class="text-xs text-slate-500 uppercase font-semibold">Năm thực hiện</div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-3 mb-4">
                    <span class="w-8 h-8 rounded bg-blue-100 text-blue-600 flex items-center justify-center text-sm">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    Các hạng mục & Dự án thành phần
                </h2>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-blue-500 group-hover:w-2 transition-all"></div>
                    <div class="flex gap-4">
                        <div class="flex-none pt-1">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                                <i class="fa-solid fa-map-location-dot"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Đo vẽ bản đồ địa hình đáy biển tỷ lệ 1:50.000</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-3">
                                <span class="font-semibold">Khu vực:</span> Vịnh Bắc Bộ phục vụ nhiệm vụ quản lý biển của các Bộ, ngành, địa phương liên quan.
                            </p>
                            <div class="flex flex-wrap gap-2 text-xs">
                                <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded border border-slate-200">9 mảnh bản đồ</span>
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded border border-green-200">Hoàn thành 2023</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-purple-500 group-hover:w-2 transition-all"></div>
                    <div class="flex gap-4">
                        <div class="flex-none pt-1">
                            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                                <i class="fa-solid fa-satellite"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Giám sát vùng Biển, đảo trọng điểm bằng Viễn thám</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-3">
                                Sử dụng công nghệ viễn thám phục vụ phát triển kinh tế xã hội và bảo đảm an ninh quốc phòng.
                            </p>
                            <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-bold border border-purple-200">Công nghệ cao</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-cyan-500 group-hover:w-2 transition-all"></div>
                    <div class="flex gap-4">
                        <div class="flex-none pt-1">
                            <div class="w-10 h-10 rounded-full bg-cyan-50 flex items-center justify-center text-cyan-600">
                                <i class="fa-solid fa-database"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Dự án thành phần 8: Cập nhật dữ liệu & HTTT</h3>
                            <p class="text-slate-600 text-sm leading-relaxed mb-3">
                                Xây dựng hệ thống thông tin tài nguyên – môi trường một số hải đảo, cụm đảo lớn quan trọng phục vụ quy hoạch phát triển kinh tế biển và bảo vệ chủ quyền.
                            </p>
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <i class="fa-solid fa-link"></i> Liên kết dữ liệu quốc gia
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-orange-500 group-hover:w-2 transition-all"></div>
                    <div class="flex gap-4">
                        <div class="flex-none pt-1">
                            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Thành phần 9: Điều phối & Báo cáo tổng kết</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Tổng hợp kết quả các dự án thành phần, đề xuất giải pháp sử dụng hợp lý tài nguyên và bảo vệ môi trường nhằm phát triển bền vững.
                            </p>
                        </div>
                    </div>
                </div>

                 <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-1 h-full bg-teal-500 group-hover:w-2 transition-all"></div>
                    <div class="flex gap-4">
                        <div class="flex-none pt-1">
                            <div class="w-10 h-10 rounded-full bg-teal-50 flex items-center justify-center text-teal-600">
                                <i class="fa-solid fa-flask"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Nghiên cứu khoáng định (Hydrate)</h3>
                            <p class="text-slate-600 text-sm leading-relaxed">
                                Nghiên cứu, điều tra, đánh giá khoanh định các cấu trúc địa chất có tiềm năng và triển vọng khí hydrate ở các vùng biển Việt Nam.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-slate-100 rounded-xl p-6 border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-4 border-b border-slate-200 pb-2">Mục tiêu chính</h3>
                    <ul class="space-y-4 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Hoàn thiện hệ thống pháp luật, chính sách quản lý TN&MT biển.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Xây dựng cơ sở dữ liệu quốc gia về tài nguyên môi trường biển.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-check text-green-500 mt-1"></i>
                            <span>Bảo đảm an ninh quốc phòng, khẳng định chủ quyền lãnh hải.</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-xl p-6 border border-slate-200 shadow-sm">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center justify-between">
                        Tài liệu đính kèm
                        <i class="fa-solid fa-paperclip text-slate-400"></i>
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block p-3 rounded bg-blue-50 hover:bg-blue-100 transition-colors">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-pdf text-red-500 text-xl"></i>
                                <div>
                                    <div class="text-sm font-bold text-blue-900">Quyết định 47/2006/QĐ-TTg</div>
                                    <div class="text-[10px] text-slate-500">PDF • 2.4 MB</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="block p-3 rounded bg-blue-50 hover:bg-blue-100 transition-colors">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-file-word text-blue-500 text-xl"></i>
                                <div>
                                    <div class="text-sm font-bold text-blue-900">Báo cáo tổng kết GĐ 1</div>
                                    <div class="text-[10px] text-slate-500">DOCX • 5.1 MB</div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
