@extends('admin.layout.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Yêu cầu dữ liệu từ Công dân</h1>

<div class="bg-white rounded shadow overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead>
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Người gửi</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nội dung</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Trạng thái</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Người xử lý</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr class="{{ $req->status == 'new' ? 'bg-yellow-50' : '' }}">
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    <p class="font-bold text-gray-900">{{ $req->fullname }}</p>
                    <p class="text-gray-600 text-xs">{{ $req->email }}</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $req->created_at->format('d/m/Y H:i') }}</p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm max-w-xs truncate">
                    <span title="{{ $req->content }}">{{ Str::limit($req->content, 80) }}</span>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-center text-sm">
                    @if($req->status == 'new')
                        <span class="inline-block px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-200 rounded-full text-xs">Mới</span>
                    @else
                        <span class="inline-block px-2 py-1 font-semibold leading-tight text-green-700 bg-green-200 rounded-full text-xs">Đã xử lý</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-sm">
                    @if($req->processor)
                        <span class="text-blue-600 font-semibold">{{ $req->processor->name }}</span>
                    @else
                        <span class="text-gray-400 italic">--</span>
                    @endif
                </td>
                <td class="px-5 py-5 border-b border-gray-200 text-center text-sm">
                    @if($req->status == 'new')
                    <form action="{{ route('admin.requests.update', $req->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-xs" title="Đánh dấu đã xử lý">
                            <i class="fa-solid fa-check"></i> Xử lý
                        </button>
                    </form>
                    @endif
                    
                    <form action="{{ route('admin.requests.destroy', $req->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Xóa yêu cầu này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">
        {{ $requests->links() }}
    </div>
</div>
@endsection