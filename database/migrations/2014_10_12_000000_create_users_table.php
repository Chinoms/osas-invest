<?php

use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('login_id');
            $table->boolean('active')->default(true);
            $table->string('phone_number', 15)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert([
            ["login_id" => "509033455", "phone_number" => "+2347575757575", "password" => Hash::make('1212121212'), 'active' => false],
            ["login_id" => "509033499", "phone_number" => "+2347575752575", "password" => Hash::make('0000000000'), 'active' => true,]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
