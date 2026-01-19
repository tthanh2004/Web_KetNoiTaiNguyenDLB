<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('data_requests', function (Blueprint $table) {
            $table->id();
            
            // Thông tin người gửi (Khách vãng lai)
            $table->string('fullname');      // Họ tên
            $table->string('email');         // Email liên hệ
            $table->string('organization')->nullable(); // Cơ quan
            $table->string('phone')->nullable(); // Số điện thoại
            
            // Nội dung yêu cầu
            $table->text('content'); 
            
            // Trạng thái xử lý (Để Admin quản lý)
            // 'new': Mới gửi, 'contacted': Đã liên hệ, 'done': Đã xong
            $table->string('status')->default('new'); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_requests');
    }
};
