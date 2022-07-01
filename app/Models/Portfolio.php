<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;


    public function transaction(){
        return $this->hasMany('App\Models\Transaction');
    }

    public function tenure(){
        return  $this->belongsTo('App\Models\InvestmentPeriod', "investment_period_id");
    }
}
