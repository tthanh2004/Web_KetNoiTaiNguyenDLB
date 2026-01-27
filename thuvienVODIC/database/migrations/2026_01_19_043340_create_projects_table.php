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
            $table->string('status')->default('new')->index(); 
            $table->integer('progress')->default(0);
            $table->date('completed_at')->nullable();


            $table->foreignId('parent_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('project_group_id')->constrained('project_groups');
            $table->foreignId('implementing_unit_id')->constrained('implementing_units');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};