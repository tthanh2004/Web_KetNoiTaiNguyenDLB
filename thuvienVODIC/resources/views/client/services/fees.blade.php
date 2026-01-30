@extends('client.layout')
@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-3xl font-serif text-blue-900 mb-2 font-bold text-center">BIỂU MỨC THU PHÍ KHAI THÁC, SỬ DỤNG DỮ LIỆU TÀI NGUYÊN, MÔI TRƯỜNG BIỂN VÀ HẢI ĐẢO</h1>
        <p class="text-center text-slate-500 mb-10">(Thông tư số 294/2016/TT-BTC  ngày 15 tháng 11 năm 2016 của Bộ Tài chính)</p>

        <div class="space-y-8">
            @foreach($feeCategories as $cat)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="bg-blue-900 text-white px-6 py-3 font-bold uppercase tracking-wide">
                    {{ $cat->name }}
                </div>
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-100 text-slate-600">
                        <tr>
                            <th class="px-6 py-3">Tên loại phí</th>
                            <th class="px-6 py-3">Đơn vị tính</th>
                            <th class="px-6 py-3 text-right">Mức thu (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($cat->feeItems as $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-3 font-medium text-slate-700">{{ $item->name }}</td>
                            <td class="px-6 py-3 text-slate-500">{{ $item->unit }}</td>
                            <td class="px-6 py-3 text-right text-blue-700 font-bold">{{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection