@extends('client.layout')
@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl text-blue-900 mb-6 font-bold text-center">Kho Tài liệu số Quốc gia</h1>
        
        <div class="max-w-2xl mx-auto mb-10">
            <form action="{{ route('client.documents.index') }}" method="GET" class="relative">
                <input type="text" name="keyword" value="{{ request('keyword') }}" placeholder="Tìm kiếm tài liệu..." class="w-full border p-3 rounded-full pl-5 pr-12 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="submit" class="absolute right-2 top-2 bg-blue-900 text-white rounded-full p-1.5 w-8 h-8 flex items-center justify-center"><i class="fa-solid fa-search text-sm"></i></button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($documents as $doc)
            <div class="border border-slate-200 rounded-xl p-5 hover:shadow-lg transition-shadow bg-slate-50">
                <div class="flex items-start gap-4">
                    <div class="text-red-500 text-4xl"><i class="fa-regular fa-file-pdf"></i></div>
                    <div>
                        <h3 class="font-bold text-slate-800 line-clamp-2 mb-2">{{ $doc->title }}</h3>
                        <p class="text-xs text-slate-500 mb-2"><i class="fa-solid fa-building columns mr-1"></i> {{ $doc->author_org ?? 'VODIC' }}</p>
                        @if($doc->project)
                            <a href="{{ route('client.project.detail', $doc->project_id) }}" class="text-xs text-blue-600 hover:underline bg-blue-100 px-2 py-1 rounded">Thuộc: {{ Str::limit($doc->project->name, 30) }}</a>
                        @endif
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-200 flex justify-end">
                    <a href="{{ $doc->file_url }}" target="_blank" class="text-sm font-bold text-blue-700 hover:text-blue-900"><i class="fa-solid fa-download mr-1"></i> Tải về</a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-8">{{ $documents->links() }}</div>
    </div>
</div>
@endsection