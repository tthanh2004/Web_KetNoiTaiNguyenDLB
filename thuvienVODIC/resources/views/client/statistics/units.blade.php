@extends('client.layout')
@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-4 max-w-5xl">
        <h1 class="text-3xl font-serif text-blue-900 mb-8 font-bold text-center">Thống kê theo Đơn vị thực hiện</h1>
        
        <div class="bg-slate-50 p-8 rounded-2xl border border-slate-200">
            @foreach($units as $index => $unit)
            <div class="mb-6 last:mb-0">
                <div class="flex justify-between items-end mb-1">
                    <span class="font-bold text-slate-700 flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-blue-200 text-blue-800 flex items-center justify-center text-xs">{{ $index + 1 }}</span>
                        {{ $unit->name }}
                    </span>
                    <span class="text-sm font-bold text-blue-600">{{ $unit->projects_count }} dự án</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ ($unit->projects_count / $units->first()->projects_count) * 100 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection