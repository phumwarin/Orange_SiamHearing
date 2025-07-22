<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('user_code', 225);
            $table->integer('ref_branch_id');
            $table->string('username', 225);
            $table->string('name', 255);
            $table->string('nickname', 225);
            $table->string('salary', 255)->nullable();
            $table->integer('ref_position_id');
            $table->date('work_start_date')->nullable();
            $table->string('email', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone', 20)->nullable();
            $table->longText('remark')->nullable();
            $table->string('password', 255);
            $table->string('remember_token', 100)->nullable();
            $table->enum('ref_status_id', ['1', '0'])->default('1');
            $table->integer('work_status')->default(0);
            $table->string('image_name', 225);
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->unique('email');
        });

        // Insert sample data (1 แถวพอเป็นตัวอย่าง)
        DB::table('users')->insert([
            'id' => 1,
            'user_code' => '1502010467',
            'ref_branch_id' => 1,
            'username' => '09999999999',
            'name' => 'วรเวก ชึรัมย์',
            'nickname' => 'เวก',
            'salary' => '1000000',
            'ref_position_id' => 1,
            'work_start_date' => '2024-09-11',
            'email' => 'wolverine.wek@gmail.com',
            'email_verified_at' => null,
            'phone' => '09999999999',
            'remark' => null,
            'password' => '$2y$10$LwO.dy5SytuilloWtrUdY.2rzRaN3RyX3ovubArushvzYbDtc.EFG',
            'remember_token' => null,
            'ref_status_id' => '1',
            'work_status' => 0,
            'image_name' => 'app-academy-tutor-61473249717.png',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
