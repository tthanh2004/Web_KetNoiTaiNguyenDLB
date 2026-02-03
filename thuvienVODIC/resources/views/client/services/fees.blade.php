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
    <div class="container mx-auto px-4 max-w-5xl">
        
        {{-- 1. HEADER TRANG --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl text-blue-900 mb-3 font-black uppercase tracking-tight">Biểu mức thu phí dữ liệu biển</h1>
            <div class="w-24 h-1.5 bg-blue-800 mx-auto mb-4 rounded-full opacity-30"></div>
            <p class="text-slate-500 font-medium italic">(Ban hành kèm theo Thông tư số 294/2016/TT-BTC của Bộ Tài chính)</p>
        </div>

        {{-- 2. PHẦN BẢNG GIÁ DỮ LIỆU (Đưa lên trên cùng, full width) --}}
        <div class="space-y-8 mb-16">
            @foreach($feeCategories as $cat)
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200 group hover:shadow-md transition-shadow">
                <div class="bg-blue-900 text-white px-6 py-4 font-bold uppercase tracking-wide flex items-center gap-3">
                    <span class="text-yellow-400 text-lg">{{ toRoman($loop->iteration) }}.</span> 
                    {{ $cat->name }}
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-slate-50 text-slate-600 border-b border-slate-100">
                            <tr>
                                <th class="px-6 py-3 w-16 text-center font-bold">STT</th>
                                <th class="px-6 py-3">Tên loại tài liệu</th>
                                <th class="px-6 py-3 w-32">Đơn vị</th>
                                <th class="px-6 py-3 text-right w-40">Mức phí (VNĐ)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($cat->feeItems as $item)
                            <tr class="hover:bg-blue-50/40 transition-colors">
                                <td class="px-6 py-4 text-center text-slate-400 font-medium italic">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-700 leading-relaxed">
                                    {{ $item->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ $item->unit }}
                                </td>
                                <td class="px-6 py-4 text-right text-blue-700 font-black">
                                    {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>

        {{-- 3. PHẦN VĂN BẢN GỐC (Chuyển xuống cuối trang) --}}
        <div class="border-t border-slate-200 pt-12">
            <div class="flex flex-col items-center mb-8 text-center">
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Tài liệu đính kèm</h2>
                <p class="text-slate-500">Bạn có thể xem trực tiếp hoặc tải về văn bản quy định gốc bên dưới</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                {{-- Nút tải/xem bên trái --}}
                <div class="lg:col-span-4 space-y-4">
                    <div class="bg-white rounded-3xl p-8 border border-blue-100 shadow-sm">
                        <div class="flex flex-col items-center text-center mb-6">
                            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center text-4xl shadow-inner mb-4">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <h4 class="font-black text-slate-800 text-lg uppercase leading-tight">Thông tư<br>294/2016/TT-BTC</h4>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ asset('storage/documents/294_2016_TT-BTC16255.pdf') }}" 
                               target="_blank" 
                               class="flex items-center justify-center gap-3 w-full py-3 bg-blue-50 text-blue-700 rounded-xl font-bold text-sm hover:bg-blue-100 transition-all border border-blue-100">
                                <i class="fa-solid fa-eye"></i> Mở xem toàn văn
                            </a>
                            <a href="{{ asset('storage/documents/294_2016_TT-BTC16255.pdf') }}" 
                               download 
                               class="flex items-center justify-center gap-3 w-full py-3 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-black transition-all shadow-lg shadow-slate-200">
                                <i class="fa-solid fa-cloud-arrow-down"></i> Tải file .pdf
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Khung nhúng PDF bên phải --}}
                <div class="lg:col-span-8">
                    <div class="bg-slate-200 rounded-3xl overflow-hidden border border-slate-300 shadow-inner h-[600px]">
                        <iframe src="{{ asset('storage/documents/294_2016_TT-BTC16255.pdf') }}#toolbar=0" 
                                width="100%" 
                                height="100%" 
                                class="rounded-3xl">
                        </iframe>
                    </div>
                    <p class="text-[11px] text-slate-400 mt-4 text-center italic">Nếu trình duyệt của bạn không hỗ trợ hiển thị PDF, hãy sử dụng nút tải về bên cạnh.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection