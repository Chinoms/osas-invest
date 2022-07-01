<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPeriod;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return dd();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin/withdraw");
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
            'portfolio' => 'required| numeric',
            'wallet' => 'required',
            'amount' => 'required',
        ]);
        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->status = 0;
        $transaction->bitcoin_wallet = $request['wallet'];
        $transaction->type = 1;  //deposite => 0 , withdrawal => 1 ;     
        $transaction->portfolio_id = $request['portfolio'];
        $transaction->amount = $request['amount'];
        $transaction->save();
        return redirect()->back()->with('success', "Withdrawal request submitted successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $portfolio = Portfolio::where(['user_id'=> Auth::user()->is, "id" => $id])->first();
        $investment_period = InvestmentPeriod::all();
        return view('admin/withdraw')->with(["portfolio" =>  $portfolio, "investment_period" => $investment_period]);
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
