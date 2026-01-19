<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống - VODIC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased">

    <div class="relative min-h-screen flex items-center justify-center overflow-hidden">

        <img src="{{ asset('img/login-bg.jpg') }}" 
             alt="Background" 
             class="absolute inset-0 w-full h-full object-cover animate-pulse-slow">
        
        <div class="absolute inset-0 bg-blue-900/80 backdrop-blur-sm"></div>

        <div class="relative z-10 w-full max-w-md p-6">
            
            <div class="bg-white rounded-2xl shadow-2xl border border-white/20 p-8 md:p-10 transform transition-all hover:scale-[1.01] duration-300">
                
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-900 mb-4 shadow-inner group hover:bg-blue-900 hover:text-white transition-all duration-300">
                        <i class="fa-solid fa-anchor text-3xl"></i>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Đăng nhập hệ thống</h2>
                    <p class="text-sm text-gray-500 mt-2">Thư viện dữ liệu VODIC</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Email / Tài khoản</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none bg-gray-50 focus:bg-white placeholder-gray-400"
                                placeholder="admin@vodic.vn">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 ml-1">Mật khẩu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="current-password"
                                class="w-full pl-10 pr-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none bg-gray-50 focus:bg-white placeholder-gray-400"
                                placeholder="••••••••">
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 ml-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-gray-600">Ghi nhớ tôi</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                Quên mật khẩu?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="w-full bg-blue-800 hover:bg-blue-900 text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex justify-center items-center gap-2 group">
                        <span>Đăng nhập</span>
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <div class="mt-8 text-center border-t border-gray-100 pt-6">
                    <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-blue-700 transition-colors flex items-center justify-center gap-2">
                        <i class="fa-solid fa-house"></i> Quay về Trang chủ
                    </a>
                </div>
            </div>
            
            <div class="text-center mt-6 text-blue-100/60 text-xs">
                &copy; 2024 VODIC. Hệ thống quản lý dữ liệu tài nguyên biển quốc gia.
            </div>
        </div>
    </div>

</body>
</html>