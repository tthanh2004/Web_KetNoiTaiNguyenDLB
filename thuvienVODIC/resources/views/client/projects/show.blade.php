@extends('client.layout')

@section('content')
<div class="bg-white shadow rounded-lg p-6 mb-6">
    <div class="border-b pb-4 mb-4">
        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
            {{ $project->project_group->name ?? 'Dự án' }}
        </span>
        <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $project->name }}</h1>
        <p class="text-gray-500 mt-1">Đơn vị chủ trì: <span class="font-semibold">{{ $project->implementing_unit->name }}</span></p>
    </div>

    <div class="prose max-w-none text-gray-700 mb-8">
        <h3 class="text-xl font-bold mb-2">Nội dung tóm tắt</h3>
        <p class="whitespace-pre-line">{{ $project->content ?? 'Đang cập nhật...' }}</p>
    </div>

    <h3 class="text-xl font-bold text-gray-800 mb-4 border-l-4 border-primary pl-3">Tài liệu đính kèm</h3>
    
    @if($project->documents->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên tài liệu</th>
                        <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tác giả</th>
                        <th class="py-3 px-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tải về</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($project->documents as $doc)
                    <tr>
                        <td class="py-3 px-4 text-sm text-gray-900">
                            <i class="fa-regular fa-file-pdf text-red-500 mr-2"></i> {{ $doc->title }}
                        </td>
                        <td class="py-3 px-4 text-sm text-gray-500">{{ $doc->author_org ?? '---' }}</td>
                        <td class="py-3 px-4 text-center">
                            <a href="{{ Storage::url($doc->file_url) }}" target="_blank" class="text-blue-600 hover:text-blue-900 font-medium">
                                <i class="fa-solid fa-download"></i> Tải file
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-gray-500 italic p-4 bg-gray-50 rounded">Chưa có tài liệu nào được công khai cho dự án này.</div>
    @endif
</div>
<div class="text-center">
    <a href="{{ route('home') }}" class="text-primary hover:underline"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
</div>
@endsection