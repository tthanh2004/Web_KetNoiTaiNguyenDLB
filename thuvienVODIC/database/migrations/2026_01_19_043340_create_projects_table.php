<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code_number')->nullable(); // Số hiệu dự án
            $table->string('name'); // Tên dự án
            $table->text('content')->nullable(); // Nội dung tóm tắt
            $table->date('start_date')->nullable(); // Ngày bắt đầu
            
            // --- CÁC KHÓA NGOẠI ---
            
            // 1. QUAN TRỌNG: QUẢN LÝ DỰ ÁN CHA - CON (Đệ quy)
            // parent_id = NULL: Là dự án lớn (VD: Đề án 47 tổng thể)
            // parent_id = Có số: Là dự án thành phần con
            $table->foreignId('parent_id')->nullable()->constrained('projects')->onDelete('cascade');

            // 2. Thuộc nhóm dự án nào? (VD: Nhóm nhiệm vụ thường xuyên)
            $table->foreignId('project_group_id')->constrained('project_groups');
            
            // 3. Đơn vị nào thực hiện?
            $table->foreignId('implementing_unit_id')->constrained('implementing_units');

            // 4. Admin nào tạo dự án này? (Tracking)
            // Set null khi admin bị xóa để không mất dự án
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};