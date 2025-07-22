<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('backup_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('folder_id')->constrained('backup_folders')->onDelete('cascade');

            $table->string('file_name');      // ชื่อไฟล์แสดงผล
            $table->string('file_path');      // path ที่เก็บใน storage
            $table->string('file_type')->nullable(); // ประเภทไฟล์
            $table->string('file_size')->nullable(); // ขนาดไฟล์

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('backup_files');
    }
};