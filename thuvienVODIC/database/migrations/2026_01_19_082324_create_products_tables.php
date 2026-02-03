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
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade'); // Sản phẩm thuộc dự án nào
            $table->string('name'); // Tên sản phẩm (VD: Bản đồ địa hình đáy biển...)
            $table->text('description')->nullable(); // Mô tả chi tiết
            $table->string('file_url')->nullable(); // Đường dẫn file (nếu có)
            $table->string('thumbnail')->nullable(); // Ảnh minh họa (nếu là bản đồ)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};