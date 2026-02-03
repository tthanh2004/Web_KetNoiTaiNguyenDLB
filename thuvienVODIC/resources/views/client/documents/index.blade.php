@extends('client.layout')
@section('content')
<div class="bg-slate-50 py-12 min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl text-blue-900 mb-6 font-bold text-center">Kho Tài liệu số Quốc gia</h1>
        
        <div class="max-w-2xl mx-auto mb-10">
            <form action="{{ route('client.documents.index') }}" method="GET" class="relative">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm kiếm tài liệu..." class="w-full border p-3 rounded-full pl-5 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm">
                <button type="submit" class="absolute right-2 top-2 bg-blue-900 text-white rounded-full p-1.5 w-8 h-8 flex items-center justify-center hover:bg-blue-800 transition-colors">
                    <i class="fa-solid fa-search text-sm"></i>
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($documents as $doc)
            <div class="group bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col">
                
                <a href="{{ route('client.documents.detail', $doc->id) }}" class="relative block bg-slate-100 aspect-[3/4] overflow-hidden border-b border-slate-100">
                    @if(strtolower($doc->type) == 'pdf')
                        <object data="{{ asset('storage/' . $doc->file_path) }}#page=1&toolbar=0&navpanes=0&view=FitH" type="application/pdf" class="w-full h-full pointer-events-none scale-105 group-hover:scale-110 transition-transform duration-500">
                            <div class="flex flex-col items-center justify-center h-full text-slate-400 p-4">
                                <i class="fa-regular fa-file-pdf text-5xl mb-2"></i>
                                <span class="text-[10px] font-bold uppercase">Xem trước PDF</span>
                            </div>
                        </object>
                    @elseif(in_array(strtolower($doc->type), ['jpg', 'jpeg', 'png', 'webp']))
                        <img src="{{ asset('storage/' . $doc->file_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="flex flex-col items-center justify-center h-full bg-gradient-to-br from-slate-50 to-slate-100 text-slate-300">
                            <i class="fa-regular fa-file-lines text-6xl group-hover:scale-110 transition-transform duration-300"></i>
                            <span class="mt-2 text-[10px] font-black uppercase tracking-widest text-slate-400">{{ $doc->type }}</span>
                        </div>
                    @endif

                    <div class="absolute inset-0 bg-blue-900/10 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="bg-white text-blue-900 px-4 py-2 rounded-full text-xs font-bold shadow-xl transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            Xem chi tiết
                        </span>
                    </div>
                </a>

                <div class="p-5 flex-1 flex flex-col">
                    <a href="{{ route('client.documents.detail', $doc->id) }}" class="block mb-2">
                        <h3 class="font-bold text-slate-800 line-clamp-2 text-sm leading-snug group-hover:text-blue-700 transition-colors" title="{{ $doc->title }}">
                            {{ $doc->title }}
                        </h3>
                    </a>
                    
                    <div class="mt-auto pt-4 flex flex-col gap-2">
                        <p class="text-[10px] text-slate-500 flex items-center gap-1.5">
                            <i class="fa-solid fa-building text-blue-500"></i> 
                            <span class="truncate font-medium">{{ $doc->project->owner_name ?? 'VODIC' }}</span>
                        </p>
                        
                        <div class="flex justify-between items-center border-t border-slate-50 pt-3">
                            <span class="text-[9px] font-black bg-slate-100 text-slate-500 px-2 py-0.5 rounded uppercase tracking-tighter">
                                {{ $doc->type }} | {{ $doc->size >= 1024 ? number_format($doc->size/1024, 1).'MB' : number_format($doc->size, 0).'KB' }}
                            </span>
                            <a href="{{ route('client.documents.download', $doc->id) }}" class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center gap-1">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Tải về
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $documents->links() }}
        </div>
    </div>
</div>
@endsection