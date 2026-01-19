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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tên tài liệu
            $table->string('author_org')->nullable(); // Tác giả
            $table->string('file_url'); // Link file
            $table->string('type')->nullable(); // Loại file
            
            // --- CÁC KHÓA NGOẠI ---
            
            // 1. Admin nào upload tài liệu này? (MỚI THÊM)
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // 2. Thuộc dự án nào? (Quan trọng)
            // Nếu xóa dự án, tài liệu đi theo luôn (Cascade)
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
