@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-8">
    <div class="container mx-auto px-4 md:px-6">
        
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8 border border-slate-200">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                
                <div class="lg:col-span-4 bg-slate-100 relative min-h-[300px] lg:min-h-full group">
                    @if($project->thumbnail)
                        <img src="{{ asset($project->thumbnail) }}" alt="{{ $project->name }}" class="w-full h-full object-cover absolute inset-0 transition-transform duration-700 group-hover:scale-105">
                    @else
                        <div class="flex flex-col items-center justify-center h-full text-slate-400">
                            <i class="fa-regular fa-image text-6xl mb-3"></i>
                            <span class="text-sm font-medium">Chưa có ảnh mô tả</span>
                        </div>
                    @endif
                    
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-600/90 backdrop-blur text-white text-xs font-bold px-3 py-1.5 rounded shadow uppercase tracking-wider">
                            {{ $project->project_group->name ?? 'Dự án' }}
                        </span>
                    </div>
                </div>

                <div class="lg:col-span-8 p-6 lg:p-8 flex flex-col justify-center">
                    
                    @if($project->parent)
                    <div class="mb-3 text-sm text-slate-500 flex items-center gap-2">
                        <span class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-2 py-0.5 rounded border border-yellow-200">
                            DỰ ÁN THÀNH PHẦN
                        </span>
                        <span>Thuộc:</span> 
                        <a href="{{ route('client.project.detail', $project->parent_id) }}" class="text-blue-600 font-bold hover:underline">
                             {{ $project->parent->name }}
                        </a>
                    </div>
                    @endif

                    <h1 class="text-2xl lg:text-3xl font-bold text-slate-800 mb-4 leading-tight">
                        {{ $project->name }}
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm text-slate-700 mb-8 bg-slate-50 p-5 rounded-lg border border-slate-100">
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-none">
                                <i class="fa-solid fa-landmark"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Đơn vị chủ trì:</span>
                                <span class="text-slate-700 font-medium">
                                    {{ $project->owner_name }}
                                </span>
                                @if($project->implementing_unit && $project->ministry)
                                    <div class="text-xs text-slate-400 mt-0.5 italic">
                                        (Trực thuộc {{ $project->ministry->name }})
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 flex-none">
                                <i class="fa-solid fa-barcode"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Mã thư viện:</span>
                                <span class="font-mono bg-white border border-slate-200 px-2 py-0.5 rounded text-xs text-slate-800 font-bold">
                                    {{ $project->library_code ?? '---' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 flex-none">
                                <i class="fa-solid fa-box-archive"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Vị trí lưu trữ:</span>
                                <span class="text-red-600 font-bold">{{ $project->cabinet_location ?? 'Liên hệ kho' }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 flex-none">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            <div>
                                <span class="font-bold text-slate-900 block">Giá khai thác:</span>
                                @if($project->price && $project->price > 0)
                                    <span class="text-green-700 font-bold text-lg">{{ number_format($project->price, 0, ',', '.') }} đ</span>
                                @else
                                    <span class="text-slate-500 italic">Liên hệ báo giá</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3 mt-auto">
                        <a href="#documents" class="bg-blue-900 hover:bg-cyan-700 text-white px-6 py-3 rounded-lg font-bold shadow-md transition-all flex items-center gap-2">
                            <i class="fa-solid fa-download"></i> Tải tài liệu
                        </a>
                        <button class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 px-6 py-3 rounded-lg font-bold shadow-sm transition-all flex items-center gap-2">
                            <i class="fa-regular fa-star"></i> Lưu quan tâm
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-8 space-y-8">
                
                <div class="bg-white shadow-sm rounded-xl p-6 border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800 mb-6 border-l-4 border-yellow-500 pl-3">
                        Thông tin chi tiết hồ sơ
                    </h3>
                    <div class="overflow-hidden rounded-lg border border-slate-200">
                        <table class="min-w-full divide-y divide-slate-200 text-sm">
                            <tbody class="divide-y divide-slate-200">
                                <tr class="bg-slate-50">
                                    <td class="px-6 py-4 font-bold text-slate-700 w-1/3">Tên đầy đủ dự án</td>
                                    <td class="px-6 py-4 text-slate-900 font-medium">{{ $project->name }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-700">Mã số phê duyệt</td>
                                    <td class="px-6 py-4 text-slate-900 font-mono">{{ $project->code_number ?? '---' }}</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="px-6 py-4 font-bold text-slate-700">Thuộc dự án Chính Phủ</td>
                                    <td class="px-6 py-4 text-slate-900">
                                        @if($project->parent)
                                            <a href="{{ route('client.project.detail', $project->parent_id) }}" class="text-blue-600 hover:underline font-bold">
                                                {{ $project->parent->name }}
                                            </a>
                                        @else
                                            <span class="text-slate-500 italic">Không (Dự án độc lập)</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-700">Thời gian thực hiện</td>
                                    <td class="px-6 py-4 text-slate-900">
                                        {{ $project->start_year ?? '?' }} - {{ $project->end_year ?? '?' }}
                                    </td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="px-6 py-4 font-bold text-slate-700">Kinh phí dự án</td>
                                    <td class="px-6 py-4 text-slate-900 font-medium text-red-600">
                                        {{ $project->budget ? number_format($project->budget) . ' VNĐ' : '---' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-700">Thời gian giao nộp</td>
                                    <td class="px-6 py-4 text-slate-900">{{ $project->handover_time ?? '---' }}</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="px-6 py-4 font-bold text-slate-700">Tỉ lệ dữ liệu</td>
                                    <td class="px-6 py-4 text-slate-900">{{ $project->scale ?? '---' }}</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-slate-700">Người nhập số liệu</td>
                                    <td class="px-6 py-4 text-slate-900">{{ $project->data_entry_person ?? 'Admin' }}</td>
                                </tr>
                                <tr class="bg-slate-50">
                                    <td class="px-6 py-4 font-bold text-slate-700">Thông tin thêm</td>
                                    <td class="px-6 py-4 text-slate-900">{{ $project->note ?? 'Không có ghi chú' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white shadow-sm rounded-xl p-6 border border-slate-200">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 border-l-4 border-blue-500 pl-3">
                        Nội dung tóm tắt
                    </h3>
                    <div class="prose max-w-none text-slate-600 leading-relaxed text-justify">
                        <p class="whitespace-pre-line">{{ $project->content ?? 'Đang cập nhật nội dung...' }}</p>
                    </div>
                </div>

                <div id="documents" class="bg-white shadow-sm rounded-xl p-6 border border-slate-200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-800 border-l-4 border-green-500 pl-3">
                            Tài liệu đính kèm
                        </h3>
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-1 rounded-full">
                            {{ $project->documents->count() }} files
                        </span>
                    </div>

                    @if($project->documents->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left">
                                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                                    <tr>
                                        <th class="px-4 py-3 rounded-tl-lg">Tên tài liệu</th>
                                        <th class="px-4 py-3">Tác giả</th>
                                        <th class="px-4 py-3 text-right rounded-tr-lg">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($project->documents as $doc)
                                        @php
                                            // Lấy phần mở rộng của file để hiển thị icon phù hợp
                                            $extension = strtolower(pathinfo($doc->file_path, PATHINFO_EXTENSION));
                                            $fileIcons = [
                                                'pdf'  => ['icon' => 'fa-file-pdf', 'color' => 'text-red-500', 'bg' => 'bg-red-50'],
                                                'doc'  => ['icon' => 'fa-file-word', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                                'docx' => ['icon' => 'fa-file-word', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                                'xls'  => ['icon' => 'fa-file-excel', 'color' => 'text-green-600', 'bg' => 'bg-green-50'],
                                                'xlsx' => ['icon' => 'fa-file-excel', 'color' => 'text-green-600', 'bg' => 'bg-green-50'],
                                                'zip'  => ['icon' => 'fa-file-zipper', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50'],
                                                'rar'  => ['icon' => 'fa-file-zipper', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50'],
                                            ];
                                            $style = $fileIcons[$extension] ?? ['icon' => 'fa-file-lines', 'color' => 'text-slate-500', 'bg' => 'bg-slate-50'];
                                        @endphp

                                        <tr class="hover:bg-blue-50/50 transition-colors">
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 {{ $style['bg'] }} {{ $style['color'] }} rounded-lg flex items-center justify-center flex-none shadow-sm border border-white">
                                                        <i class="fa-regular {{ $style['icon'] }} text-xl"></i>
                                                    </div>
                                                    <div>
                                                        <div class="font-bold text-slate-800 line-clamp-1">{{ $doc->title }}</div>
                                                        <div class="text-[10px] uppercase font-bold text-slate-400 flex items-center gap-2">
                                                            <span class="px-1.5 py-0.5 rounded border border-slate-200 bg-white">{{ $extension ?: 'FILE' }}</span>
                                                            <span>{{ $doc->file_size ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4 text-slate-500 italic text-sm">
                                                {{ $doc->author_org ?? 'Đang cập nhật' }}
                                            </td>
                                            <td class="px-4 py-4 text-right">
                                                <a href="{{ route('client.documents.download', $doc->id) }}" 
                                                class="inline-flex items-center gap-2 bg-slate-800 hover:bg-blue-700 text-white text-xs font-bold px-4 py-2 rounded-lg transition-all shadow-sm hover:shadow-md">
                                                    <i class="fa-solid fa-download"></i> Tải tài liệu
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 bg-slate-50 rounded-lg border border-dashed border-slate-300 text-slate-400">
                            <i class="fa-regular fa-folder-open text-4xl mb-2"></i>
                            <p>Chưa có tài liệu nào được công khai.</p>
                        </div>
                    @endif
                </div>

            </div>

            <div class="lg:col-span-4 space-y-6">
                
                @if($project->children->count() > 0)
                <div class="bg-white shadow-sm rounded-xl p-5 border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2 border-b pb-2">
                        <i class="fa-solid fa-sitemap text-blue-500"></i> Các dự án thành phần
                    </h3>
                    <div class="space-y-3">
                        @foreach($project->children as $child)
                        <a href="{{ route('client.project.detail', $child->id) }}" class="block p-3 bg-slate-50 hover:bg-blue-50 rounded-lg border border-slate-100 hover:border-blue-300 transition-all group">
                            <h4 class="font-bold text-sm text-slate-700 group-hover:text-blue-700 mb-1 line-clamp-2">
                                {{ $child->name }}
                            </h4>
                            <div class="flex justify-between text-xs text-slate-500">
                                <span class="bg-white px-1.5 rounded border">{{ $child->code_number ?? '---' }}</span>
                                <span>{{ $child->start_year }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($project->parent)
                <div class="bg-gradient-to-br from-blue-900 to-cyan-800 shadow-lg rounded-xl p-5 text-white">
                    <div class="text-[10px] uppercase font-bold text-blue-200 mb-2 tracking-wider">Thuộc dự án lớn</div>
                    <h3 class="font-bold text-md mb-3 leading-snug">
                        {{ $project->parent->name }}
                    </h3>
                    <a href="{{ route('client.project.detail', $project->parent_id) }}" class="inline-flex items-center text-xs bg-white/20 hover:bg-white/30 px-3 py-2 rounded transition-colors font-bold">
                        Xem dự án tổng thể <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
                @endif

                <div class="bg-white shadow-sm rounded-xl p-5 border border-slate-200">
                    <h3 class="font-bold text-slate-800 mb-3">Liên hệ hỗ trợ</h3>
                    <p class="text-xs text-slate-500 mb-4">Bạn cần cung cấp thêm dữ liệu về dự án này? Hãy gọi điện trực tiếp.</p>
                    <div class="flex items-center gap-3 text-blue-900 font-bold text-lg bg-blue-50 p-3 rounded-lg border border-blue-100">
                        <i class="fa-solid fa-phone-volume"></i> 024.3773.xxxx
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('client.projects.index') }}" class="inline-flex items-center text-slate-500 hover:text-blue-700 transition-colors font-medium">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Quay lại danh sách
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection