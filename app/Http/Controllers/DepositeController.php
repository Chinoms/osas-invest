<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPeriod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class DepositeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolio = Portfolio::all();
        $investment_period = InvestmentPeriod::all();
        return view('admin/deposite')->with(["portfolios" =>  $portfolio, "investment_period" => $investment_period]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'portfolio' => 'required',
            'amount' => 'required',
        ]);

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->status = 0;
        $transaction->type = 0;  //deposite => 0 , withdrawal => 1 ;     
        $transaction->portfolio_id = $request['portfolio'];
        $transaction->amount = $request['amount'];
        $transaction->save();

        return redirect()->back()->with("success", "Deposite Was successfull");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio != null) {
            $investment_period = InvestmentPeriod::all();
            return view('admin/deposite')->with(["portfolio" =>  $portfolio, "investment_period" => $investment_period]);
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
