@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-10">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl text-blue-900 font-bold mb-2">
                Tra cứu Dự án & Đề án
            </h1>
            <p class="text-slate-500">Hệ thống cơ sở dữ liệu các dự án điều tra cơ bản tài nguyên, môi trường biển.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                    <form action="{{ route('client.projects.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="col-span-1 md:col-span-2 relative">
                            <input type="text" name="keyword" value="{{ request('keyword') }}" 
                                   class="w-full border border-slate-300 rounded-lg pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none text-slate-700"
                                   placeholder="Nhập tên dự án, mã số hoặc nội dung tóm tắt...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                            </div>
                        </div>

                        @if(isset($projectGroups))
                        <div>
                            <select name="group_id" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-100 outline-none text-slate-600 bg-white">
                                <option value="">-- Tất cả Nhóm dự án --</option>
                                @foreach($projectGroups as $group)
                                    <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div>
                            <select name="sort" class="w-full border border-slate-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-blue-100 outline-none text-slate-600 bg-white">
                                <option value="newest">Mới nhất trước</option>
                                <option value="oldest">Cũ nhất trước</option>
                                <option value="name_asc">Tên A-Z</option>
                            </select>
                        </div>

                        <div class="col-span-1 md:col-span-2 text-right">
                            <button type="submit" class="bg-blue-900 hover:bg-cyan-700 text-white px-6 py-2.5 rounded-lg font-bold transition-colors shadow-md inline-flex items-center gap-2">
                                <i class="fa-solid fa-filter"></i> Lọc kết quả
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    @forelse($projects as $project)
                    <div class="group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-slate-200 overflow-hidden flex flex-col md:flex-row">
                        
                        <div class="md:w-24 bg-blue-50 flex items-center justify-center flex-none min-h-[100px] md:min-h-auto border-b md:border-b-0 md:border-r border-slate-100">
                            <i class="fa-solid fa-folder-open text-3xl text-blue-300 group-hover:text-blue-500 transition-colors"></i>
                        </div>

                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wide">
                                        {{ $project->code_number ?? 'MÃ: ---' }}
                                    </span>
                                    <span class="text-xs text-slate-500 font-medium">
                                        <i class="fa-solid fa-building-columns mr-1 text-slate-400"></i>
                                        {{ $project->implementing_unit->name ?? 'Đơn vị chưa xác định' }}
                                    </span>
                                </div>

                                <h3 class="text-lg md:text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-700 transition-colors line-clamp-2">
                                    <a href="{{ route('client.project.detail', $project->id) }}">
                                        {{ $project->name }}
                                    </a>
                                </h3>

                                <p class="text-slate-600 text-sm line-clamp-2 mb-4 leading-relaxed">
                                    {{ $project->content ?? 'Chưa có mô tả chi tiết cho dự án này.' }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between pt-4 border-t border-slate-50 mt-auto">
                                <div class="text-xs text-slate-400 font-medium">
                                    <i class="fa-regular fa-calendar mr-1"></i> Bắt đầu: 
                                    <span class="text-slate-600">{{ $project->start_date ? date('d/m/Y', strtotime($project->start_date)) : '---' }}</span>
                                </div>
                                <a href="{{ route('client.project.detail', $project->id) }}" class="text-sm font-bold text-blue-600 hover:text-cyan-600 flex items-center gap-1 transition-colors">
                                    Xem chi tiết <i class="fa-solid fa-arrow-right text-xs mt-0.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16 bg-white rounded-xl border border-dashed border-slate-300">
                        <div class="inline-block p-4 bg-slate-50 rounded-full mb-3">
                            <i class="fa-solid fa-magnifying-glass text-3xl text-slate-400"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-700">Không tìm thấy dự án nào</h3>
                        <p class="text-slate-500 text-sm mt-1">Vui lòng thử lại với từ khóa khác.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                
                <div class="bg-blue-900 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                    <h3 class="text-lg font-bold mb-3 relative z-10">Bạn cần hỗ trợ?</h3>
                    <p class="text-blue-100 text-sm mb-4 leading-relaxed relative z-10">
                        Nếu bạn không tìm thấy thông tin dự án mong muốn, hãy liên hệ với bộ phận lưu trữ của chúng tôi.
                    </p>
                    <div class="flex items-center gap-3 text-sm font-bold text-yellow-400 relative z-10">
                        <i class="fa-solid fa-phone"></i> 84-24-376 18159
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 sticky top-24">
                    <h3 class="text-lg font-bold text-slate-800 mb-1 border-l-4 border-yellow-500 pl-3">
                        Gửi yêu cầu dữ liệu
                    </h3>
                    <p class="text-xs text-slate-500 mb-6 pl-4">Điền thông tin để nhận tư vấn chi tiết.</p>
                    
                    <form action="{{ route('client.request.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Họ và tên <span class="text-red-500">*</span></label>
                            <input type="text" name="fullname" required 
                                   class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                                   placeholder="Nguyễn Văn A">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email liên hệ <span class="text-red-500">*</span></label>
                            <input type="email" name="email" required 
                                   class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                                   placeholder="email@example.com">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nội dung yêu cầu <span class="text-red-500">*</span></label>
                            <textarea name="content" rows="4" required 
                                      class="w-full border border-slate-300 rounded-lg p-2.5 text-sm focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all"
                                      placeholder="Tôi muốn xin dữ liệu về..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-3 rounded-lg shadow-md hover:shadow-lg transition-all transform active:scale-95">
                            <i class="fa-regular fa-paper-plane mr-2"></i> Gửi ngay
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection