<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('investment_periods', function (Blueprint $table) {
            $table->id();
            $table->integer("months");
            $table->integer("rate");
            $table->timestamps();
        });

        DB::table('investment_periods')->insert([
            ["months"=> 3, "rate" => 3],
            ["months"=> 6, "rate" => 10],
            ["months"=> 12, "rate" => 25],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_periods');
    }
};
