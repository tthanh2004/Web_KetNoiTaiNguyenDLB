<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Trị - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <aside class="w-64 bg-slate-800 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-4 border-b border-slate-700 flex items-center space-x-2">
                <i class="fa-solid fa-database text-2xl text-blue-400"></i>
                <span class="font-bold text-lg">Admin Control</span>
            </div>
            <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                <p class="text-xs text-slate-400 uppercase font-semibold mb-2">Quản lý chính</p>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded hover:bg-slate-700 transition">
                    <i class="fa-solid fa-gauge w-6"></i> Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="block py-2.5 px-4 rounded hover:bg-slate-700 {{ request()->routeIs('admin.projects.*') ? 'bg-slate-700' : '' }}">
                    <i class="fa-solid fa-folder-tree w-6"></i> Dự án / Đề án
                </a>
                <a href="{{ route('admin.documents.index') }}" class="block py-2.5 px-4 rounded hover:bg-slate-700">
                    <i class="fa-solid fa-file-contract w-6"></i> Tài liệu số
                </a>
                
                <p class="text-xs text-slate-400 uppercase font-semibold mt-6 mb-2">Tương tác</p>
                <a href="{{ route('admin.data_requests.index') }}" class="block py-2.5 px-4 rounded hover:bg-slate-700">
                    <i class="fa-solid fa-envelope w-6"></i> Yêu cầu dữ liệu
                </a>

                <p class="text-xs text-slate-400 uppercase font-semibold mt-6 mb-2">Hệ thống</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left py-2.5 px-4 rounded hover:bg-red-600 transition text-red-300 hover:text-white">
                        <i class="fa-solid fa-right-from-bracket w-6"></i> Đăng xuất
                    </button>
                </form>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h2 class="font-semibold text-gray-700">Xin chào, {{ Auth::user()->name }}</h2>
                <a href="{{ route('home') }}" target="_blank" class="text-blue-600 text-sm hover:underline">
                    Xem trang chủ <i class="fa-solid fa-external-link-alt ml-1"></i>
                </a>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200 flex items-center">
                        <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>