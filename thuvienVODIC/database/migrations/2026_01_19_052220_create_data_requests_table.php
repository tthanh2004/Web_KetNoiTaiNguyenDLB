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
            
            // Thông tin người dân (Khách)
            $table->string('fullname');
            $table->string('email');
            $table->string('organization')->nullable();
            $table->string('phone')->nullable();
            
            // Nội dung yêu cầu
            $table->text('content');
            
            // Trạng thái & Phản hồi
            $table->string('status')->default('new'); // new, processed
            
            // Admin nào đã xử lý yêu cầu này? (MỚI THÊM - Tùy chọn nâng cao)
            // Để biết Admin A hay Admin B đã trả lời mail cho khách
            $table->foreignId('processed_by_user_id')->nullable()->constrained('users')->onDelete('set null');
            
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
