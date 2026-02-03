@extends('client.layout')

@section('content')
<div class="bg-slate-50 min-h-screen py-8">
    <div class="container mx-auto px-4 max-w-7xl">
        {{-- Breadcrumb chuyên nghiệp --}}
        <nav class="flex mb-6 text-sm text-slate-500 items-center gap-2 bg-white px-4 py-2 rounded-lg shadow-sm border border-slate-200">
            <a href="/" class="hover:text-blue-600 transition-colors"><i class="fa-solid fa-house"></i></a>
            <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
            <a href="{{ route('client.documents.index') }}" class="hover:text-blue-600 font-medium">Kho tài liệu số</a>
            <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
            <span class="text-slate-900 font-bold truncate">{{ Str::limit($document->title, 50) }}</span>
        </nav>

        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-slate-200">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                
                {{-- CỘT TRÁI: XEM TRƯỚC TÀI LIỆU --}}
                <div class="lg:col-span-5 bg-slate-50 p-6 lg:p-10 flex flex-col border-r border-slate-100">
                    <div class="flex-1 relative group shadow-2xl bg-white border border-slate-200 rounded-xl overflow-hidden min-h-[500px] lg:min-h-[600px]">
                        @if(strtolower($document->type) == 'pdf')
                            {{-- Nhúng PDF chuẩn --}}
                            <object 
                                data="{{ asset('storage/' . $document->file_path) }}#toolbar=0" 
                                type="application/pdf" 
                                class="w-full h-full min-h-[500px] lg:min-h-[600px]"
                            >
                                <div class="flex flex-col items-center justify-center h-full p-8 text-center">
                                    <i class="fa-regular fa-file-pdf text-6xl text-red-500 mb-4"></i>
                                    <p class="text-slate-600 font-medium">Trình duyệt không hỗ trợ xem trực tiếp.</p>
                                    <a href="{{ route('client.documents.download', $document->id) }}" class="mt-4 bg-blue-600 text-white px-6 py-2 rounded-full shadow-lg hover:bg-blue-700 transition-all">
                                        Tải về để xem ngay
                                    </a>
                                </div>
                            </object>
                            
                            {{-- Nút mở rộng --}}
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="bg-slate-900/80 text-white p-3 rounded-xl backdrop-blur-md hover:bg-blue-600">
                                    <i class="fa-solid fa-expand"></i>
                                </a>
                            </div>
                        @elseif(in_array(strtolower($document->type), ['jpg', 'jpeg', 'png', 'webp']))
                            <img src="{{ asset('storage/' . $document->file_path) }}" class="w-full h-full object-contain p-2">
                        @else
                            <div class="flex flex-col items-center justify-center h-full p-12 text-center">
                                <div class="w-24 h-24 bg-blue-50 rounded-3xl flex items-center justify-center mb-6 text-blue-500 shadow-inner">
                                    <i class="fa-regular fa-file-word text-5xl"></i>
                                </div>
                                <span class="text-lg font-bold text-slate-700 uppercase">{{ $document->type }} File</span>
                                <p class="text-sm text-slate-400 mt-2 italic">Định dạng này cần tải về để xem chi tiết</p>
                            </div>
                        @endif
                    </div>
                    <p class="mt-4 text-center text-xs text-slate-400 italic">
                        <i class="fa-solid fa-circle-info mr-1"></i> Cuộn trong khung hình để xem thêm các trang
                    </p>
                </div>

                {{-- CỘT PHẢI: THÔNG TIN CHI TIẾT --}}
                <div class="lg:col-span-7 p-8 lg:p-12 bg-white">
                    <div class="mb-8">
                        <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-4 inline-block shadow-sm">
                            Tài liệu số quốc gia
                        </span>
                        <h1 class="text-2xl lg:text-4xl font-extrabold text-slate-800 leading-[1.2]">
                            {{ $document->title }}
                        </h1>
                    </div>

                    <div class="space-y-0 border-t border-slate-100">
                        @php
                            $sizeMB = $document->size >= 1024 
                                ? number_format($document->size / 1024, 2) . ' MB' 
                                : number_format($document->size, 0) . ' KB';

                            $info = [
                                'Tên tài liệu' => $document->title,
                                'Mô tả' => $document->project->note ?? 'Đang cập nhật nội dung tóm tắt chi tiết cho tài liệu này...',
                                'Lĩnh vực' => $document->project->project_group->name ?? 'Điều kiện tự nhiên, kinh tế - xã hội',
                                'Nguồn tài liệu' => $document->project->owner_name ?? 'Viện Địa chất',
                                'Ngôn ngữ' => 'Tiếng Việt',
                                'Kích thước' => $sizeMB . ' (' . strtoupper($document->type) . ')'
                            ];
                        @endphp

                        @foreach($info as $label => $value)
                        <div class="grid grid-cols-1 sm:grid-cols-4 py-5 border-b border-slate-50 items-start gap-2 sm:gap-4 group">
                            <span class="text-slate-400 font-semibold text-sm uppercase tracking-tight">{{ $label }}</span>
                            <div class="sm:col-span-3 text-slate-800 font-medium text-sm lg:text-base leading-relaxed">
                                @if($label == 'Mô tả')
                                    <div class="text-slate-600 font-normal text-justify line-clamp-6">{{ $value }}</div>
                                @else
                                    {{ $value }}
                                @endif
                            </div>
                        </div>
                        @endforeach

                        {{-- Nút tải về --}}
                        <div class="grid grid-cols-1 sm:grid-cols-4 py-8 items-center gap-4">
                            <span class="text-slate-400 font-semibold text-sm uppercase">Xem toàn văn</span>
                            <div class="sm:col-span-3">
                                <a href="{{ route('client.documents.download', $document->id) }}" 
                                   class="inline-flex items-center gap-3 bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-xl font-bold transition-all shadow-lg shadow-blue-200 hover:translate-y-[-2px] active:scale-95 group">
                                    <i class="fa-solid fa-download animate-bounce group-hover:animate-none"></i>
                                    Tải toàn văn tài liệu ({{ strtoupper($document->type) }})
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tài liệu cùng dự án --}}
        @php
            $relatedDocs = $document->project ? $document->project->documents()->where('id', '!=', $document->id)->take(3)->get() : collect();
        @endphp

        @if($relatedDocs->count() > 0)
        <div class="mt-16">
            <div class="flex items-center justify-between mb-8 border-b border-slate-200 pb-4">
                <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                    <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                    Tài liệu cùng dự án
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedDocs as $doc)
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-2xl transition-all group relative overflow-hidden">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-12 h-12 rounded-xl {{ $doc->type == 'pdf' ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-500' }} flex items-center justify-center text-2xl flex-none">
                            <i class="fa-regular fa-file-{{ $doc->type == 'pdf' ? 'pdf' : 'lines' }}"></i>
                        </div>
                        <div class="flex-1">
                            <a href="{{ route('client.documents.detail', $doc->id) }}" class="font-bold text-slate-800 line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $doc->title }}
                            </a>
                            <p class="text-xs text-slate-400 uppercase font-bold">{{ $doc->type }} • {{ number_format($doc->size/1024, 1) }} MB</p>
                        </div>
                    </div>
                    <a href="{{ route('client.documents.detail', $doc->id) }}" class="mt-4 w-full flex items-center justify-center gap-2 bg-slate-50 py-3 rounded-xl font-bold text-slate-600 hover:bg-blue-600 hover:text-white transition-all text-sm">
                        Xem chi tiết <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection