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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code_number')->nullable(); // Số hiệu 1864
            $table->string('name'); // Tên dự án
            $table->text('content')->nullable(); // Nội dung tóm tắt
            $table->date('start_date')->nullable(); // Ngày bắt đầu
            
            // --- CÁC KHÓA NGOẠI ---
            
            // 1. Admin nào tạo dự án này? (MỚI THÊM)
            // Nếu Admin bị xóa, cột này sẽ về NULL (Set null) để giữ lại dự án
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // 2. Thuộc nhóm dự án nào?
            $table->foreignId('project_group_id')->constrained('project_groups');
            
            // 3. Đơn vị nào thực hiện?
            $table->foreignId('implementing_unit_id')->constrained('implementing_units');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
