<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả
            $table->string('file_url')->nullable(); // Link tải (nếu có)

            // QUAN TRỌNG: Liên kết với Dự án
            // onDelete('cascade'): Xóa dự án thì sản phẩm mất theo
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};