@extends('admin.layout.app')

@section('content')
<h1 class="text-3xl font-bold text-gray-800 mb-6">Tổng quan hệ thống</h1>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded shadow p-5 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-blue-100 rounded p-3">
                <i class="fa-solid fa-folder-tree text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Tổng Dự án</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_projects'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-5 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-green-100 rounded p-3">
                <i class="fa-solid fa-file-contract text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Tài liệu số</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_documents'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-5 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-yellow-100 rounded p-3">
                <i class="fa-solid fa-envelope text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Yêu cầu mới</p>
                <p class="text-2xl font-bold text-red-600">{{ $stats['new_requests'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded shadow p-5 border-l-4 border-purple-500">
        <div class="flex items-center">
            <div class="flex-shrink-0 bg-purple-100 rounded p-3">
                <i class="fa-solid fa-users text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm font-medium">Tổng tương tác</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total_requests'] }}</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-blue-50 border border-blue-200 rounded p-4 text-blue-800">
    <h3 class="font-bold"><i class="fa-solid fa-circle-info mr-2"></i>Hướng dẫn nhanh:</h3>
    <ul class="list-disc list-inside mt-2 text-sm ml-4">
        <li>Vào mục <b>Dự án</b> để thêm mới các đề án, nhiệm vụ.</li>
        <li>Sau khi tạo dự án, vào mục <b>Tài liệu số</b> để upload file đính kèm cho dự án đó.</li>
        <li>Kiểm tra mục <b>Yêu cầu dữ liệu</b> thường xuyên để phản hồi người dân.</li>
    </ul>
</div>
@endsection