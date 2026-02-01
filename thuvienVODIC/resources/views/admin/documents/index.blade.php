@extends('admin.layout.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Quản lý Tài liệu số</h1>
    <a href="{{ route('admin.documents.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
        <i class="fa-solid fa-cloud-arrow-up mr-1"></i> Upload tài liệu
    </a>
</div>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tên tài liệu</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Thuộc dự án</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">File đính kèm</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $doc)
            <tr>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <p class="text-gray-900 font-semibold">{{ $doc->title }}</p>
                    <p class="text-gray-500 text-xs">Upload bởi: {{ $doc->uploader->name ?? 'Admin' }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    @if($doc->project)
                        <a href="{{ route('admin.projects.edit', $doc->project_id) }}" class="text-blue-600 hover:underline">
                            {{ Str::limit($doc->project->name, 40) }}
                        </a>
                    @else
                        <span class="text-red-500 italic">Dự án đã bị xóa</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                    <a href="{{ route('admin.documents.download', $doc->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fa-solid fa-download mr-1"></i> Tải về
                    </a>
                    @if($doc->type)
                        <span class="text-xs text-gray-400 ml-1">({{ $doc->type }})</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Bạn chắc chắn muốn xóa tài liệu này? File gốc cũng sẽ bị xóa khỏi ổ cứng!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 p-2 rounded-full transition">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 bg-gray-50">
        {{ $documents->links() }}
    </div>
</div>
@endsection