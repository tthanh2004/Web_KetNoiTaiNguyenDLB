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
            $table->string('title');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('set null');
            $table->string('file_path')->nullable(); // Đường dẫn file
            $table->string('type')->nullable();      // Loại file (pdf, docx)
            $table->decimal('size', 10, 2)->nullable(); // Kích thước file
            $table->foreignId('uploaded_by')->nullable()->constrained('users'); // Người upload
            
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
