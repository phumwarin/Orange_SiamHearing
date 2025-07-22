<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('item_type')->nullable();          // ประเภทอุปกรณ์
            $table->string('manufacturer')->nullable();       // ผู้ผลิต
            $table->string('model')->nullable();              // รุ่น
            $table->string('dsn_name')->nullable();           // DSN Name
            $table->string('serial_no')->nullable();          // S/N
            $table->string('label')->nullable();              // Label
            $table->date('purchase_date')->nullable();        // วันที่ซื้อ
            $table->string('warranty_remain')->nullable();    // วันคงเหลือของประกัน
            $table->string('user')->nullable();               // ผู้ใช้งาน
            $table->timestamps();                             // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_equipment');
    }
};