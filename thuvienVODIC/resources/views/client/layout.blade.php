<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện VODIC</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logovodic.jpg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-heading { font-family: 'Montserrat', sans-serif; }
        .glass-header { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .dropdown-menu { opacity: 0; visibility: hidden; transform: translateY(12px); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .group:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        /* Style cho trạng thái đang active */
        .nav-active { background-color: #eff6ff; color: #1d4ed8 !important; font-weight: 800; border: 1px solid #dbeafe; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen text-[15px]">

    <header class="glass-header border-b border-blue-100 sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-2 lg:px-6">
            <div class="flex items-center h-20 justify-between gap-2">
                
                {{-- LOGO AREA --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0 group">
                    <img src="{{ asset('img/logovodic.jpg') }}" alt="Logo VODIC" class="h-10 lg:h-12 w-auto object-contain transition-transform group-hover:scale-105 duration-300">
                    <div class="hidden xl:block leading-tight border-l border-slate-200 pl-3">
                        <div class="font-extrabold text-[11px] text-red-600 tracking-tight uppercase leading-4">
                            Trung tâm Thông tin, dữ liệu biển<br>và hải đảo quốc gia
                        </div>
                        <div class="text-[10px] text-blue-700 uppercase tracking-widest font-bold opacity-90">
                            Cục Biển và Hải đảo Việt Nam
                        </div>
                    </div>
                </a>

                {{-- DESKTOP NAVIGATION --}}
                <nav class="hidden lg:flex items-center justify-center flex-1 gap-x-1 font-bold text-blue-900">
                    
                    {{-- Trang chủ --}}
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-full text-[13px] transition-all hover:bg-blue-50 hover:text-cyan-700 whitespace-nowrap {{ request()->routeIs('home') ? 'nav-active' : '' }}">
                        <i class="fa-solid fa-house-chimney mr-1 text-[12px]"></i> Trang chủ
                    </a>

                    {{-- 1. Tra cứu --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-[13px] rounded-full hover:bg-blue-50 transition-all whitespace-nowrap {{ request()->routeIs('client.projects.*') || request()->routeIs('client.products.*') ? 'nav-active' : '' }}">
                            <i class="fa-solid fa-magnifying-glass mr-1 text-[12px]"></i> Tra cứu <i class="fa-solid fa-caret-down text-[10px] opacity-60"></i>
                        </button>
                        <div class="dropdown-menu absolute left-0 top-full pt-2 w-52">
                            <div class="bg-white border border-blue-50 shadow-2xl rounded-xl p-2">
                                <a href="{{ route('client.projects.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-slate-600 text-sm font-medium {{ request()->routeIs('client.projects.*') ? 'text-blue-600' : '' }}">
                                    <i class="fa-solid fa-folder-open text-blue-400"></i> Theo Dự án
                                </a>
                                <a href="{{ route('client.products.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-slate-600 text-sm font-medium {{ request()->routeIs('client.products.*') ? 'text-blue-600' : '' }}">
                                    <i class="fa-solid fa-cube text-blue-400"></i> Theo Sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Tài liệu số --}}
                    <a href="{{ route('client.documents.index') }}" class="px-3 py-2 rounded-full text-[13px] transition-all hover:bg-blue-50 hover:text-cyan-700 whitespace-nowrap {{ request()->routeIs('client.documents.*') ? 'nav-active' : '' }}">
                        <i class="fa-solid fa-database mr-1 text-[12px]"></i> Tài liệu số
                    </a>

                    {{-- 3. Dịch vụ (Đủ 3 mục) --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-[13px] rounded-full hover:bg-blue-50 transition-all whitespace-nowrap {{ request()->routeIs('client.services.*') ? 'nav-active' : '' }}">
                            <i class="fa-solid fa-hand-holding-heart mr-1 text-[12px]"></i> Dịch vụ <i class="fa-solid fa-caret-down text-[10px] opacity-60"></i>
                        </button>
                        <div class="dropdown-menu absolute left-0 top-full pt-2 w-64">
                            <div class="bg-white border border-blue-50 shadow-2xl rounded-xl p-2">
                                <a href="{{ route('client.services.fees') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50 rounded-lg text-sm text-slate-600 font-medium">
                                    <i class="fa-solid fa-receipt text-blue-400"></i> Biểu mức thu phí
                                </a>
                                <a href="{{ route('client.request.create') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50 rounded-lg text-sm text-slate-600 font-medium border-t border-slate-50">
                                    <i class="fa-regular fa-paper-plane text-blue-400"></i> Đề nghị dữ liệu
                                </a>
                                <a href="{{ route('client.services.other') }}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-blue-50 rounded-lg text-sm text-slate-600 font-medium border-t border-slate-50">
                                    <i class="fa-solid fa-ellipsis text-blue-400"></i> Dịch vụ khác
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Thống kê (Đủ 5 mục) --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-[13px] rounded-full hover:bg-blue-50 transition-all whitespace-nowrap {{ request()->routeIs('client.statistics.*') ? 'nav-active' : '' }}">
                            <i class="fa-solid fa-chart-simple mr-1 text-[12px]"></i> Thống kê <i class="fa-solid fa-caret-down text-[10px] opacity-60"></i>
                        </button>
                        <div class="dropdown-menu absolute left-0 top-full pt-2 w-64">
                            <div class="bg-white border border-blue-50 shadow-2xl rounded-xl p-2 font-medium">
                                <a href="{{ route('client.statistics.projects') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600">
                                    <i class="fa-solid fa-chart-pie text-blue-400"></i> Theo Dự án
                                </a>
                                <a href="{{ route('client.statistics.scheme47') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-file-contract text-blue-400"></i> Theo Đề án 47
                                </a>
                                <a href="{{ route('client.statistics.units') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-building-columns text-blue-400"></i> Theo đơn vị
                                </a>
                                <a href="{{ route('client.statistics.ministries') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-landmark text-blue-400"></i> Theo Bộ ngành
                                </a>
                                <a href="{{ route('client.statistics.documents') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-server text-blue-400"></i> Tài liệu số hóa
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- 5. Trợ giúp (Đủ 3 mục) --}}
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-[13px] rounded-full hover:bg-blue-50 transition-all whitespace-nowrap {{ request()->routeIs('client.help.*') ? 'nav-active' : '' }}">
                            <i class="fa-solid fa-life-ring mr-1 text-[12px]"></i> Trợ giúp <i class="fa-solid fa-caret-down text-[10px] opacity-60"></i>
                        </button>
                        <div class="dropdown-menu absolute right-0 top-full pt-2 w-64">
                            <div class="bg-white border border-blue-50 shadow-2xl rounded-xl p-2 font-medium">
                                <a href="{{ route('client.request.create') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600">
                                    <i class="fa-regular fa-envelope-open text-blue-400"></i> Gửi yêu cầu dữ liệu
                                </a>
                                <a href="{{ route('client.help.guide') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-book-open text-blue-400"></i> Hướng dẫn sử dụng
                                </a>
                                <a href="{{ route('client.help.contact') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm text-slate-600 border-t border-slate-50">
                                    <i class="fa-solid fa-headset text-blue-400"></i> Liên hệ
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                {{-- ACTION AREA --}}
                <div class="flex items-center gap-2 shrink-0 ml-auto lg:ml-0">
                    <form action="{{ route('client.search') }}" method="GET" class="hidden xl:flex items-center relative group">
                        <input type="text" name="keyword" placeholder="Tìm kiếm..." class="bg-slate-100 text-slate-600 text-xs rounded-full border border-slate-200 focus:bg-white focus:border-blue-400 w-28 focus:w-40 transition-all py-2 pl-4 pr-10 outline-none">
                        <button type="submit" class="absolute right-3 text-slate-400 group-hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-magnifying-glass text-[11px]"></i>
                        </button>
                    </form>

                    <div class="h-6 w-[1px] bg-slate-200 hidden xl:block mx-1"></div>

                    @auth
                        <div class="relative group">
                            <button class="flex items-center gap-2 bg-blue-50 text-blue-800 px-3 py-2 rounded-full font-bold text-[11px] border border-blue-100">
                                <span class="truncate max-w-[60px] xl:max-w-[90px]">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-caret-down opacity-50"></i>
                            </button>
                            <div class="dropdown-menu absolute right-0 top-full pt-2 w-48">
                                <div class="bg-white border border-blue-50 shadow-xl rounded-xl p-1 text-xs font-bold text-slate-600">
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-blue-50 rounded-lg">Quản trị</a>
                                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="w-full text-left px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg">Đăng xuất</button></form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:flex bg-blue-900 text-white px-5 py-2 rounded-full font-bold text-[11px] hover:bg-cyan-700 transition-all shadow-md active:scale-95">
                            ĐĂNG NHẬP
                        </a>
                    @endauth

                    <button id="mobile-menu-btn" class="lg:hidden text-blue-900 text-2xl p-2 hover:bg-blue-50 rounded-lg transition-colors relative z-50">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                </div>
            </div>

            {{-- MOBILE MENU CONTAINER --}}
            <div id="mobile-menu-container" class="hidden lg:hidden bg-white border-t border-slate-100 py-4 px-2 space-y-1 shadow-2xl absolute left-0 w-full z-40 animate-in slide-in-from-top duration-300">
                <a href="{{ route('home') }}" class="block p-3 font-bold rounded-xl {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-blue-900' }}">Trang chủ</a>
                <a href="{{ route('client.projects.index') }}" class="block p-3 font-semibold text-blue-800 pl-6">Tra cứu Dự án</a>
                <a href="{{ route('client.documents.index') }}" class="block p-3 font-semibold text-blue-800 pl-6">Tài liệu số</a>
                <a href="{{ route('client.services.fees') }}" class="block p-3 font-semibold text-blue-800 pl-6">Dịch vụ</a>
                <a href="{{ route('client.statistics.projects') }}" class="block p-3 font-semibold text-blue-800 pl-6">Thống kê</a>
                @guest
                    <a href="{{ route('login') }}" class="block mt-4 text-center bg-blue-900 text-white p-3 rounded-xl font-bold">Đăng nhập</a>
                @endguest
            </div>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-blue-100 pt-20 pb-10 mt-auto">
        <div class="container mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6 text-blue-900 font-extrabold tracking-widest text-lg">
                       Trang thông tin Thư viện - Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-blue-900 mb-6 uppercase text-xs tracking-widest opacity-60">Về chúng tôi</h3>
                    <ul class="space-y-4 text-slate-600 text-sm font-medium italic">
                        <li><a href="{{ route('client.help.about') }}" class="hover:text-blue-600">Giới thiệu chung</a></li>
                        <li><a href="{{ route('client.help.org') }}" class="hover:text-blue-600">Cơ cấu tổ chức</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 mb-6 uppercase text-xs tracking-widest opacity-60">Hỗ trợ khách hàng</h3>
                    <ul class="space-y-4 text-slate-600 text-sm font-medium italic">
                        <li><a href="{{ route('client.help.guide') }}" class="hover:text-blue-600">Hướng dẫn tra cứu</a></li>
                        <li><a href="{{ route('client.request.create') }}" class="hover:text-blue-600">Đề nghị cung cấp dữ liệu</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 mb-6 uppercase text-xs tracking-widest opacity-60">Liên hệ</h3>
                    <ul class="space-y-4 text-slate-500 text-xs font-bold italic">
                        <li class="flex gap-3"><i class="fa-solid fa-location-dot text-blue-600"></i>Đơn vị quản lý: Phòng Quản lý dữ liệu và thư viện</li>
                        <li class="flex gap-3"><i class="fa-solid fa-location-dot text-blue-600"></i>Địa chỉ: 83 Nguyễn Chí Thanh, Láng Hạ, Đống Đa, Hà Nội.</li>
                        <li class="flex gap-3"><i class="fa-solid fa-phone text-blue-600"></i>SĐT: (84-24) 376 18159</li>
                        <li class="flex gap-3"><i class="fa-solid fa-envelope text-blue-600"></i>Email: hoanglong@vodic.vn</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu-container');
            if (btn && menu) {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (!menu.contains(e.target) && !btn.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</body>
</html>