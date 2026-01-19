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
            $table->string('code_number')->nullable(); // Số hiệu (Đề án 1864)
            $table->string('name'); // Tên dự án đầy đủ
            $table->text('content')->nullable(); // Nội dung tóm tắt
            $table->date('start_date')->nullable(); // Ngày bắt đầu
            
            // Liên kết 1: Thuộc nhóm nào (Đề án 47)?
            $table->foreignId('project_group_id')->constrained('project_groups');
            
            // Liên kết 2: Đơn vị nào chủ trì?
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
