@extends('admin.layout.app')

@section('content')
<div class="space-y-8 animate-fade-in">

    {{-- BENTO GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4">
        
        {{-- Widget chính: Tổng dự án (Chiếm 2 cột) --}}
        <div class="md:col-span-2 lg:col-span-2 bg-blue-600 rounded-[2rem] p-8 text-white flex flex-col justify-between shadow-2xl shadow-blue-200 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:bg-white/20 transition-all"></div>
            <div class="relative z-10">
                <i class="fa-solid fa-folder-tree text-3xl mb-10"></i>
                <p class="text-blue-100 text-sm font-bold uppercase tracking-wider">Cơ sở dữ liệu</p>
                <h3 class="text-5xl font-black mt-2">{{ number_format($stats['total_projects']) }}</h3>
                <p class="text-blue-200 text-xs mt-1 font-medium italic">Hồ sơ dự án gốc</p>
            </div>
        </div>

        {{-- Widget Tài liệu --}}
        <div class="md:col-span-2 lg:col-span-2 bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm flex flex-col justify-between hover:border-emerald-200 transition-all">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-file-shield"></i>
                </div>
                <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-full">+12% tháng này</span>
            </div>
            <div>
                <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Tài liệu số hóa</p>
                <h3 class="text-4xl font-black text-slate-800 mt-1">{{ number_format($stats['total_documents']) }}</h3>
            </div>
        </div>

        {{-- Widget Yêu cầu mới (Nhỏ - Dọc) --}}
        <div class="md:col-span-1 lg:col-span-2 bg-rose-500 rounded-[2rem] p-8 text-white flex flex-col justify-between shadow-xl shadow-rose-100 group">
            <div class="flex justify-between items-center">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center animate-pulse">
                    <i class="fa-solid fa-bell"></i>
                </div>
                <i class="fa-solid fa-arrow-up-right-from-square text-white/40 text-xs"></i>
            </div>
            <div class="mt-8">
                <h3 class="text-4xl font-black">{{ $stats['new_requests'] }}</h3>
                <p class="text-rose-100 text-[10px] font-bold uppercase tracking-wider mt-1">Đề nghị mới chờ duyệt</p>
            </div>
        </div>

        {{-- Widget Tương tác --}}
        <div class="md:col-span-2 lg:col-span-3 bg-slate-900 rounded-[2rem] p-8 text-white flex items-center gap-6 shadow-2xl">
            <div class="w-20 h-20 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-3xl flex items-center justify-center text-3xl shadow-lg shadow-indigo-500/30">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div>
                <p class="text-slate-400 text-xs font-bold uppercase tracking-[0.2em] mb-1">Lượt tương tác</p>
                <h3 class="text-4xl font-black tracking-tighter">{{ number_format($stats['total_requests']) }}</h3>
                <p class="text-indigo-400 text-[10px] font-bold mt-1 uppercase">Dữ liệu thời gian thực</p>
            </div>
        </div>

        {{-- Widget Link nhanh (Thao tác) --}}
        <div class="md:col-span-2 lg:col-span-3 bg-white rounded-[2rem] p-4 border border-slate-100 shadow-sm flex items-center">
            <div class="grid grid-cols-3 w-full gap-2">
                <a href="{{ route('admin.projects.create') }}" class="flex flex-col items-center justify-center p-4 hover:bg-blue-50 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-600 uppercase">Dự án</span>
                </a>
                <a href="{{ route('admin.documents.index') }}" class="flex flex-col items-center justify-center p-4 hover:bg-emerald-50 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-upload"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-600 uppercase">File</span>
                </a>
                <a href="#" class="flex flex-col items-center justify-center p-4 hover:bg-amber-50 rounded-2xl transition-all group">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                    <span class="text-[10px] font-bold text-slate-600 uppercase">Cài đặt</span>
                </a>
            </div>
        </div>
    </div>

    {{-- KHỐI DƯỚI: TRẠNG THÁI & TIN NHẮN --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-8 bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm">
            <h3 class="font-black text-slate-800 uppercase text-xs tracking-[0.2em] mb-8 flex items-center gap-3">
                <i class="fa-solid fa-list-check text-blue-600"></i> Nhiệm vụ cần xử lý
            </h3>
            <div class="space-y-4">
                {{-- Dòng task mẫu 1 --}}
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors cursor-pointer group">
                    <div class="flex items-center gap-4 font-medium text-slate-700">
                        <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                        Có {{ $stats['new_requests'] }} yêu cầu dữ liệu mới chưa phản hồi
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-slate-600 transition-all"></i>
                </div>
                {{-- Dòng task mẫu 2 --}}
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-colors cursor-pointer group">
                    <div class="flex items-center gap-4 font-medium text-slate-700">
                        <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                        Kiểm tra định dạng file của các dự án mới nhập
                    </div>
                    <i class="fa-solid fa-chevron-right text-slate-300 group-hover:text-slate-600 transition-all"></i>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 bg-gradient-to-br from-slate-800 to-black rounded-[2rem] p-8 text-white flex flex-col justify-center items-center text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 20px 20px;"></div>
            <div class="w-20 h-20 bg-white/10 rounded-3xl flex items-center justify-center text-4xl mb-6 relative z-10 backdrop-blur-md border border-white/10">
                <i class="fa-solid fa-shield-halved text-cyan-400"></i>
            </div>
            <h4 class="text-xl font-bold relative z-10 mb-2">Hệ thống VODIC</h4>
            <p class="text-slate-400 text-sm relative z-10 italic mb-8 px-4 leading-relaxed">Dữ liệu của bạn được bảo mật theo tiêu chuẩn quốc gia.</p>
            <div class="px-6 py-2 bg-cyan-500 rounded-full text-black font-black text-[10px] uppercase tracking-widest relative z-10 shadow-lg shadow-cyan-500/50 cursor-pointer hover:scale-105 transition-transform">
                Kiểm tra an ninh
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-out forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection