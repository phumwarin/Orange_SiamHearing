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
        Schema::create('branchs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->string('ip_meter', 255)->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('ref_province_id')->nullable();
            $table->unsignedInteger('ref_district_id')->nullable();
            $table->unsignedInteger('ref_subdistrict_id')->nullable();
            $table->unsignedInteger('zipcode')->nullable();
            $table->unsignedInteger('phone')->nullable();
            $table->string('email', 225)->nullable();
            $table->unsignedInteger('billing_date')->nullable();
            $table->unsignedInteger('payment_end_date')->nullable();
            $table->unsignedInteger('ref_apartment_id')->default(0);
            $table->timestamps();
        });

        // Insert initial data
        DB::table('branchs')->insert([
            [
                'name' => 'อ่อนนุช',
                'ref_apartment_id' => 0,
                'created_at' => Carbon::parse('2025-04-06 20:22:24'),
                'updated_at' => null,
            ],
            [
                'name' => 'ทองหล่อ',
                'ref_apartment_id' => 0,
                'created_at' => Carbon::parse('2025-04-06 20:22:24'),
                'updated_at' => null,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('branchs');
    }
};
