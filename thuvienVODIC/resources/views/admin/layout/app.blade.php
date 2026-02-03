<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Hệ thống VODIC</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logovodic.jpg') }}">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* Custom scrollbar cho đẹp */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #1e293b; }
        ::-webkit-scrollbar-thumb { background: #475569; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    
    <div class="flex h-screen overflow-hidden">
        
        <aside :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
               class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transition-transform duration-300 md:relative md:translate-x-0 flex flex-col shadow-xl">
            
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-900 gap-3">
                <img src="{{ asset('img/logovodic.jpg') }}" 
                    alt="VODIC Admin Logo"
                    class="h-10 w-auto object-contain rounded bg-white p-0.5">
                    
                <span class="font-bold text-lg tracking-wide text-white">VODIC Admin</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-gauge w-6"></i> 
                    <span class="font-medium">Tổng quan</span>
                </a>

                <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Quản lý Dữ liệu</p>
                <a href="{{ route('admin.project-groups.index') }}" 
                    class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.project-groups.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-layer-group w-6"></i> 
                    <span>Nhóm Dự án</span>
                </a>
                
                <a href="{{ route('admin.projects.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.projects.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-folder-tree w-6"></i> 
                    <span>Dự án</span>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-folder-tree w-6"></i> Quản lý Sản phẩm
                </a>

                <a href="{{ route('admin.ministries.index') }}" 
                    class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.ministries.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-landmark w-6"></i> 
                    <span>Bộ & Ngành</span>
                </a>

                <a href="{{ route('admin.units.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.units.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-building-columns w-6"></i> 
                    <span>Đơn vị thực hiện</span>
                </a>

                <a href="{{ route('admin.documents.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.documents.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-file-contract w-6"></i> 
                    <span>Tài liệu số hóa</span>
                </a>

                <p class="px-4 text-xs font-bold text-slate-500 uppercase tracking-wider mt-6 mb-2">Dịch vụ Công</p>

                <a href="{{ route('admin.fee-categories.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.fee-categories.*') || request()->routeIs('admin.fee-items.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-money-check-dollar w-6"></i> 
                    <span>Biểu mức thu phí</span>
                </a>

                <a href="{{ route('admin.requests.index') }}" 
                   class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('admin.requests.*') ? 'bg-blue-700 text-white shadow-lg' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                    <i class="fa-solid fa-envelope-open-text w-6"></i> 
                    <span class="flex-1">Yêu cầu dữ liệu</span>
                    @php $newReq = \App\Models\DataRequest::where('status', 'new')->count(); @endphp
                    @if($newReq > 0)
                        <span class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $newReq }}</span>
                    @endif
                </a>

            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-900">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-red-400 hover:bg-slate-800 hover:text-red-300 rounded transition">
                        <i class="fa-solid fa-right-from-bracket w-6"></i>
                        <span class="font-medium">Đăng xuất</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden bg-gray-50">
            
            <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 z-20">
                <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>

                <div class="hidden md:block text-gray-400 text-sm font-medium">
                    Trang thông tin Thư viện - Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="text-sm text-blue-600 hover:underline hidden sm:block">
                        <i class="fa-solid fa-globe mr-1"></i> Xem trang chủ
                    </a>
                    <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold border border-blue-200">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-gray-700 font-medium text-sm">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6 scroll-smooth">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded shadow-sm mb-6 flex justify-between items-center animate-fade-in-down">
                        <div class="flex items-center">
                            <i class="fa-solid fa-circle-check text-xl mr-3"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                        <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800"><i class="fa-solid fa-times"></i></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded shadow-sm mb-6 flex items-center">
                         <i class="fa-solid fa-triangle-exclamation text-xl mr-3"></i>
                         <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity md:hidden"></div>
    </div>

</body>
</html>