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
        Schema::create('implementing_units', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên đơn vị (Viện Hải dương học...)
            
            // Liên kết: Đơn vị này thuộc Bộ nào?
            $table->foreignId('ministry_id')->nullable()->constrained('ministries');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('implementing_units');
    }
};
