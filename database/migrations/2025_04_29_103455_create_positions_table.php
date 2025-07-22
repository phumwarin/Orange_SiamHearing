<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id(); // PRIMARY KEY แบบ auto increment
            $table->string('position_name', 225)->charset('utf8')->collation('utf8_general_ci');
            $table->timestamps(); // created_at และ updated_at
        });

        // เพิ่มข้อมูลเริ่มต้น
        DB::table('positions')->insert([
            [
                'position_name' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'position_name' => 'พนักงานทั่วไป',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
