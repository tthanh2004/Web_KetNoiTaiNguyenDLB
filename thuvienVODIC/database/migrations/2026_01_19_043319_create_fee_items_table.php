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
        Schema::create('fee_items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên loại phí
            $table->string('unit'); // Đơn vị tính (Mảnh/Tờ)
            $table->decimal('price', 15, 0); // Giá tiền (15 số, 0 số thập phân)
            
            // Liên kết: Thuộc nhóm phí I hay II?
            $table->foreignId('fee_category_id')->constrained('fee_categories');
            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_items');
    }
};
