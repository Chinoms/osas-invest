<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\InvestmentPeriod;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(InvestmentPeriod::class);
            $table->integer("amount");
            $table->boolean("save_pro")->default(false);
            $table->timestamps();   
        
        });

        DB::table("portfolios")->insert([
            ['user_id'=> 1,'investment_period_id'=>1, "amount" => 2000 ],
            ['user_id'=> 1,'investment_period_id'=>1, "amount" => 4000 ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
};
