@extends('client.layout')
@section('content')
<div class="bg-slate-50 py-16">
    <div class="container mx-auto px-4 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-blue-900 p-10 text-white flex flex-col justify-center">
                <h2 class="text-3xl font-serif font-bold mb-6">Thông tin liên hệ</h2>
                <p class="text-blue-100 mb-8 leading-relaxed">Trung tâm Thông tin, dữ liệu biển và hải đảo quốc gia sẵn sàng hỗ trợ bạn trong việc tra cứu và khai thác dữ liệu.</p>
                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center flex-none"><i class="fa-solid fa-location-dot"></i></div>
                        <div>
                            <div class="font-bold text-blue-200 text-sm uppercase">Địa chỉ</div>
                            <div>83 Nguyễn Chí Thanh, Đống Đa, Hà Nội</div>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center flex-none"><i class="fa-solid fa-phone"></i></div>
                        <div>
                            <div class="font-bold text-blue-200 text-sm uppercase">Điện thoại</div>
                            <div>(84-24) 376 18159</div>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-800 flex items-center justify-center flex-none"><i class="fa-solid fa-envelope"></i></div>
                        <div>
                            <div class="font-bold text-blue-200 text-sm uppercase">Email</div>
                            <div>hoanglong@vodic.vn</div>
                        </div>
                    </li>
                </ul>
            </div>
            
            <div class="h-full min-h-[400px] bg-slate-200 relative">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.096814183771!2d105.80962327599954!3d21.028811887773295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab6f760775cb%3A0x6a0531c3607a3c3f!2zODMgTmd1eeG7hW4gQ2jDrSBUaGFuaCwgTGFuZyBUaMaw4bujbmcsIMSQ4buRbmcgxJBhLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1715699999999!5m2!1sen!2s" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection