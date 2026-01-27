<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thư viện VODIC - Cổng thông tin dữ liệu biển</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300&family=Inter:wght@300;400;500;600&display=swap');
        
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Merriweather', serif; }
        
        /* Dropdown Animation */
        .group:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-menu { opacity: 0; visibility: hidden; transform: translateY(10px); transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen">

    <header class="bg-white/95 backdrop-blur-md border-b border-blue-100 sticky top-0 z-50 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-4 sm:px-6 py-3">
            <div class="flex items-center">
                
                <a href="{{ route('home') }}" class="flex items-center gap-3 group flex-none">
                    <div class="w-10 h-10 bg-blue-900 text-white flex items-center justify-center rounded-lg shadow-lg group-hover:bg-cyan-700 transition-colors">
                        <i class="fa-solid fa-anchor text-xl"></i>
                    </div>
                    <div class="hidden sm:block leading-tight">
                        <div class="font-bold text-lg uppercase text-blue-900 tracking-wide">Thư viện VODIC</div>
                        <div class="text-[10px] text-blue-500 uppercase tracking-widest font-semibold">Dữ liệu biển & hải đảo</div>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center space-x-1 text-sm font-bold text-blue-900 ml-auto mr-4">
                    
                    <a href="{{ route('home') }}" class="hover:text-cyan-600 hover:bg-blue-50 px-4 py-2 rounded-full transition-all flex items-center gap-1.5 {{ request()->routeIs('home') ? 'text-cyan-700 bg-blue-50' : '' }}">
                        <i class="fa-solid fa-house-chimney"></i> Trang chủ
                    </a>

                    <div class="relative group px-3 py-2 cursor-pointer rounded-full hover:bg-blue-50 transition-all">
                        <span class="flex items-center gap-1.5 group-hover:text-cyan-600">
                            <i class="fa-solid fa-magnifying-glass"></i> Tra cứu 
                            <i class="fa-solid fa-caret-down text-[10px] opacity-60 group-hover:rotate-180 transition-transform duration-300"></i>
                        </span>
                        <div class="dropdown-menu absolute left-0 top-full pt-3 w-56 -ml-2">
                            <div class="bg-white border border-blue-100 shadow-xl rounded-xl overflow-hidden">
                                <a href="{{ route('client.projects.index') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-folder-open mr-2 text-blue-400"></i> Theo Dự án
                                </a>
                                <a href="{{ route('client.products.index') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium">
                                    <i class="fa-solid fa-cube mr-2 text-blue-400"></i> Theo Sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('client.documents.index') }}" class="hover:text-cyan-600 hover:bg-blue-50 px-4 py-2 rounded-full transition-all flex items-center gap-1.5 {{ request()->routeIs('client.documents.*') ? 'text-cyan-700 bg-blue-50' : '' }}">
                        <i class="fa-solid fa-database"></i> Tài liệu số
                    </a>

                    <div class="relative group px-3 py-2 cursor-pointer rounded-full hover:bg-blue-50 transition-all">
                        <span class="flex items-center gap-1.5 group-hover:text-cyan-600">
                            <i class="fa-solid fa-hand-holding-heart"></i> Dịch vụ 
                            <i class="fa-solid fa-caret-down text-[10px] opacity-60 group-hover:rotate-180 transition-transform duration-300"></i>
                        </span>
                        <div class="dropdown-menu absolute left-0 top-full pt-3 w-64 -ml-4">
                            <div class="bg-white border border-blue-100 shadow-xl rounded-xl overflow-hidden">
                                <a href="{{ route('client.services.fees') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors border-b border-blue-50 text-slate-600 font-medium">
                                    <i class="fa-solid fa-receipt mr-2 text-blue-400"></i> Biểu mức thu phí
                                </a>
                                <a href="{{ route('client.request.create') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors border-b border-blue-50 text-slate-600 font-medium">
                                    <i class="fa-regular fa-paper-plane mr-2 text-blue-400"></i> Đề nghị cung cấp dữ liệu
                                </a>
                                <a href="{{ route('client.services.other') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium">
                                    <i class="fa-solid fa-ellipsis mr-2 text-blue-400"></i> Dịch vụ khác
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="relative group px-3 py-2 cursor-pointer rounded-full hover:bg-blue-50 transition-all">
                        <span class="flex items-center gap-1.5 group-hover:text-cyan-600 {{ request()->routeIs('client.statistics.*') ? 'text-cyan-700 bg-blue-50' : '' }}">
                            <i class="fa-solid fa-chart-simple"></i> Thống kê 
                            <i class="fa-solid fa-caret-down text-[10px] opacity-60 group-hover:rotate-180 transition-transform duration-300"></i>
                        </span>
                        <div class="dropdown-menu absolute right-0 top-full pt-3 w-64">
                            <div class="bg-white border border-blue-100 shadow-xl rounded-xl overflow-hidden">
                                <a href="{{ route('client.statistics.projects') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-chart-pie mr-2 text-blue-400"></i> Theo Dự án / Đề án
                                </a>
                                <a href="{{ route('client.statistics.scheme47') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-file-contract mr-2 text-blue-400"></i> Theo Đề án 47
                                </a>
                                <a href="{{ route('client.statistics.units') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-building-columns mr-2 text-blue-400"></i> Theo đơn vị thực hiện
                                </a>
                                <a href="{{ route('client.statistics.ministries') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-landmark mr-2 text-blue-400"></i> Theo Bộ ngành
                                </a>
                                <a href="{{ route('client.statistics.documents') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium">
                                    <i class="fa-solid fa-server mr-2 text-blue-400"></i> Tài liệu số hóa
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="relative group px-3 py-2 cursor-pointer rounded-full hover:bg-blue-50 transition-all">
                        <span class="flex items-center gap-1.5 group-hover:text-cyan-600 {{ request()->routeIs('client.help.*') ? 'text-cyan-700 bg-blue-50' : '' }}">
                            <i class="fa-solid fa-life-ring"></i> Trợ giúp 
                            <i class="fa-solid fa-caret-down text-[10px] opacity-60 group-hover:rotate-180 transition-transform duration-300"></i>
                        </span>
                        <div class="dropdown-menu absolute right-0 top-full pt-3 w-64">
                            <div class="bg-white border border-blue-100 shadow-xl rounded-xl overflow-hidden">
                                <a href="{{ route('client.request.create') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors border-b border-blue-50 text-slate-600 font-medium">
                                    <i class="fa-regular fa-envelope-open mr-2 text-blue-400"></i> Gửi yêu cầu dữ liệu
                                </a>
                                <a href="{{ route('client.help.guide') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium border-b border-slate-50">
                                    <i class="fa-solid fa-book-open mr-2 text-blue-400"></i> Hướng dẫn sử dụng
                                </a>
                                <a href="{{ route('client.help.contact') }}" class="block px-4 py-3 hover:bg-blue-50 hover:text-cyan-700 transition-colors text-slate-600 font-medium">
                                    <i class="fa-solid fa-headset mr-2 text-blue-400"></i> Liên hệ
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="flex items-center gap-3 flex-none">
                    @if (Route::has('login'))
                        @auth
                            <div class="relative group hidden lg:block">
                                <button class="flex items-center gap-2 bg-blue-50 text-blue-800 px-4 py-2 rounded-full font-bold text-xs border border-blue-200 hover:bg-blue-100 transition-colors shadow-sm">
                                    <div class="w-6 h-6 rounded-full bg-blue-200 flex items-center justify-center text-blue-800"><i class="fa-solid fa-user text-[10px]"></i></div>
                                    <span class="truncate max-w-[100px]">{{ Auth::user()->name }}</span>
                                    <i class="fa-solid fa-caret-down opacity-50 group-hover:rotate-180 transition-transform"></i>
                                </button>
                                <div class="dropdown-menu absolute right-0 top-full pt-2 w-56">
                                    <div class="bg-white border border-blue-100 shadow-lg rounded-xl overflow-hidden">
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-700 font-medium border-b border-slate-50">
                                            <i class="fa-solid fa-gauge-high mr-2 text-blue-400"></i> Trang quản trị
                                        </a>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-medium">
                                                <i class="fa-solid fa-right-from-bracket mr-2"></i> Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="hidden lg:flex items-center gap-2 bg-blue-900 text-white px-6 py-2.5 rounded-full font-bold text-xs shadow-md hover:bg-cyan-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
                            </a>
                        @endauth
                    @endif

                    <button id="mobile-menu-btn" class="lg:hidden text-blue-900 text-2xl p-1 focus:outline-none hover:text-cyan-600 transition-colors">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-blue-100 shadow-inner absolute w-full left-0 top-full z-40">
            <nav class="flex flex-col p-4 space-y-2 text-sm font-medium text-slate-700 max-h-[80vh] overflow-y-auto">
                <a href="{{ route('home') }}" class="block p-3 hover:bg-blue-50 rounded-lg {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : '' }}">
                    <i class="fa-solid fa-house-chimney w-6 text-center"></i> Trang chủ
                </a>
                
                <div class="block p-3 hover:bg-blue-50 rounded-lg">
                    <div class="font-bold text-blue-900 mb-2 flex items-center gap-2"><i class="fa-solid fa-magnifying-glass"></i> Tra cứu</div>
                    <div class="pl-8 space-y-2 text-slate-500 text-xs">
                        <a href="{{ route('client.projects.index') }}" class="block">• Theo Dự án</a>
                        <a href="{{ route('client.products.index') }}" class="block">• Theo Sản phẩm</a>
                    </div>
                </div>

                <a href="{{ route('client.documents.index') }}" class="block p-3 hover:bg-blue-50 rounded-lg">
                    <i class="fa-solid fa-database w-6 text-center"></i> Tài liệu số
                </a>

                <div class="block p-3 hover:bg-blue-50 rounded-lg">
                    <div class="font-bold text-blue-900 mb-2 flex items-center gap-2"><i class="fa-solid fa-hand-holding-heart"></i> Dịch vụ</div>
                    <div class="pl-8 space-y-2 text-slate-500 text-xs">
                        <a href="{{ route('client.services.fees') }}" class="block">• Biểu mức thu phí</a>
                        <a href="{{ route('client.request.create') }}" class="block">• Đề nghị cung cấp dữ liệu</a>
                    </div>
                </div>

                <div class="block p-3 hover:bg-blue-50 rounded-lg">
                    <div class="font-bold text-blue-900 mb-2 flex items-center gap-2"><i class="fa-solid fa-chart-simple"></i> Thống kê</div>
                    <div class="pl-8 space-y-2 text-slate-500 text-xs">
                        <a href="{{ route('client.statistics.projects') }}" class="block">• Theo Dự án / Đề án</a>
                        <a href="{{ route('client.statistics.scheme47') }}" class="block">• Theo Đề án 47</a>
                        <a href="{{ route('client.statistics.units') }}" class="block">• Theo đơn vị thực hiện</a>
                        <a href="{{ route('client.statistics.ministries') }}" class="block">• Theo Bộ ngành</a>
                        <a href="{{ route('client.statistics.documents') }}" class="block">• Tài liệu số hóa</a>
                    </div>
                </div>

                <a href="{{ route('client.request.create') }}" class="block p-3 hover:bg-blue-50 rounded-lg text-blue-700 bg-blue-50/50">
                    <i class="fa-solid fa-life-ring w-6 text-center"></i> Gửi yêu cầu dữ liệu
                </a>
                
                <div class="border-t border-blue-100 my-2 pt-2">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="block p-3 text-slate-600 hover:text-blue-700">Vào trang quản trị</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left p-3 text-red-600">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block p-3 text-center bg-blue-900 text-white rounded-lg mt-2">Đăng nhập</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    @if(session('success'))
        <div class="container mx-auto px-4 mt-6">
            <div class="bg-cyan-50 border border-cyan-200 text-cyan-800 px-4 py-3 rounded-lg flex items-center shadow-sm animate-fade-in-down">
                <i class="fa-solid fa-circle-check text-xl mr-3"></i> 
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-white border-t border-blue-100 pt-16 pb-8 text-sm mt-auto">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-10">
                <div class="col-span-1">
                    <div class="flex items-center gap-2 mb-4 text-blue-900 font-bold uppercase tracking-widest">
                        <i class="fa-solid fa-anchor"></i> Thư viện VODIC
                    </div>
                    <p class="text-slate-500 leading-relaxed mb-4 text-xs text-justify">
                        Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia. Đơn vị sự nghiệp công lập trực thuộc Cục Biển và Hải đảo Việt Nam.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="w-9 h-9 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all"><i class="fa-solid fa-globe"></i></a>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-bold text-blue-900 mb-4 uppercase text-xs tracking-wider">Về chúng tôi</h3>
                    <ul class="space-y-3 text-slate-500">
                        <li><a href="{{ route('client.help.about') }}" class="hover:text-cyan-600 transition-colors">Giới thiệu chung</a></li>
                        <li><a href="{{ route('client.help.org') }}" class="hover:text-cyan-600 transition-colors">Cơ cấu tổ chức</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 mb-4 uppercase text-xs tracking-wider">Hỗ trợ</h3>
                    <ul class="space-y-3 text-slate-500">
                        <li><a href="{{ route('client.help.guide') }}" class="hover:text-cyan-600 transition-colors">Hướng dẫn tra cứu</a></li>
                        <li><a href="{{ route('client.request.create') }}" class="hover:text-cyan-600 transition-colors">Gửi yêu cầu dữ liệu</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-blue-900 mb-4 uppercase text-xs tracking-wider">Liên hệ</h3>
                    <ul class="space-y-3 text-slate-500 text-xs">
                        <li class="flex gap-3"><i class="fa-solid fa-location-dot mt-0.5 text-blue-700"></i> 83 Nguyễn Chí Thanh, Hà Nội</li>
                        <li class="flex gap-3"><i class="fa-solid fa-phone mt-0.5 text-blue-700"></i> (024) 3773 xxxx</li>
                        <li class="flex gap-3"><i class="fa-solid fa-envelope mt-0.5 text-blue-700"></i> webmaster@vodic.vn</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-100 pt-8 text-center text-slate-400 text-xs">
                &copy; 2024 VODIC - Hệ thống quản lý dữ liệu tài nguyên biển quốc gia.
            </div>
        </div>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>