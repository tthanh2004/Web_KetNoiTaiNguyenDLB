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
            
            // --- CỘT CƠ BẢN ---
            $table->string('name');
            $table->string('code_number')->nullable();
            $table->string('library_code')->nullable();
            $table->string('thumbnail')->nullable();
            
            // --- NỘI DUNG & THỜI GIAN ---
            $table->text('content')->nullable();
            $table->text('note')->nullable();
            $table->integer('start_year')->nullable();
            $table->integer('end_year')->nullable();
            $table->string('handover_time')->nullable();

            // --- THÔNG SỐ KỸ THUẬT & TÀI CHÍNH ---
            $table->string('scale')->nullable();
            $table->decimal('budget', 15, 0)->nullable();
            $table->decimal('price', 15, 0)->nullable();
            
            // --- QUẢN LÝ KHO ---
            $table->string('cabinet_location')->nullable();
            $table->string('data_entry_person')->nullable();

            // --- TRẠNG THÁI ---
            $table->string('status')->default('completed')->index(); 
            
            // --- KHÓA NGOẠI (FOREIGN KEYS) ---
            // Lưu ý: Đã xóa ->change() và ->after() vì không dùng trong Create
            
            $table->foreignId('parent_id')->nullable()->constrained('projects')->onDelete('cascade');
            
            $table->foreignId('project_group_id')->nullable()->constrained('project_groups');
            
            $table->foreignId('ministry_id')->nullable()->constrained('ministries'); 

            $table->foreignId('implementing_unit_id')->nullable()->constrained('implementing_units'); 
            
            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};