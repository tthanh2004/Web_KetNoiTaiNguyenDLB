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
            $table->string('author_org')->nullable(); // Tác giả/Cơ quan soạn thảo
            $table->string('file_url'); // Đường dẫn file (quan trọng)
            $table->string('type')->nullable(); // Loại (Báo cáo/Bản đồ)
            
            // Liên kết: Tài liệu này của Dự án nào?
            // onDelete('cascade'): Xóa dự án thì tài liệu tự mất theo
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
