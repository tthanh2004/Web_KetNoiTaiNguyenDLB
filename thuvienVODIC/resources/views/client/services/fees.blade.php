@extends('client.layout')
@php
    if (!function_exists('toRoman')) {
        function toRoman($number) {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $returnValue = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $returnValue .= $roman;
                        break;
                    }
                }
            }
            return $returnValue;
        }
    }
@endphp

@section('content')
<div class="bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-3xl text-blue-900 mb-2 font-bold text-center uppercase">Biểu mức thu phí khai thác dữ liệu tài nguyên biển</h1>
        <p class="text-center text-slate-500 mb-10">(Thông tư số 294/2016/TT-BTC ngày 15 tháng 11 năm 2016 của Bộ Tài chính)</p>

        <div class="space-y-8">
            @foreach($feeCategories as $cat)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-slate-200">
                <div class="bg-blue-900 text-white px-6 py-3 font-bold uppercase tracking-wide flex items-center gap-2">
                    <span class="text-yellow-400">{{ toRoman($loop->iteration) }}.</span> 
                    {{ $cat->name }}
                </div>

                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-50 text-slate-600 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-3 w-16 text-center font-bold">STT</th>
                            <th class="px-6 py-3">Tên loại phí</th>
                            <th class="px-6 py-3 w-32">Đơn vị tính</th>
                            <th class="px-6 py-3 text-right w-40">Mức thu (VNĐ)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($cat->feeItems as $item)
                        <tr class="hover:bg-blue-50/50 transition-colors">
                            {{-- SỐ THỨ TỰ DÒNG (1, 2, 3...) --}}
                            <td class="px-6 py-3 text-center text-slate-400 font-medium">
                                {{ $loop->iteration }}
                            </td>
                            
                            <td class="px-6 py-3 font-medium text-slate-700">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-3 text-slate-500">
                                {{ $item->unit }}
                            </td>
                            <td class="px-6 py-3 text-right text-blue-700 font-bold">
                                {{ number_format($item->price, 0, ',', '.') }}
                            </td>
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