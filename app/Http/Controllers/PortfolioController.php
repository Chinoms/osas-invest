<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPeriod;
use App\Models\Portfolio;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
    
        $settled_portfolio = 0;
        $active_portfolio = 0;
        $total_deposite = 0;
        $total_withdrawal = 0;

        $portfolio = Portfolio::where('user_id', Auth::user()->id)->get();
        if(count($portfolio) > 0){
            $transactions = Transaction::where(['user_id' => Auth::user()->id])->get();
            for ($index = 0; $index < count($transactions); $index++) {
                if ($transactions[$index]->type == 0 && $transactions[$index]->status == 1) {
                    $total_deposite = $total_deposite +  $transactions[$index]->amount;
                } elseif($transactions[$index]->type == 1 && $transactions[$index]->status == 1) {
                    $total_withdrawal = $total_withdrawal + $transactions[$index]->amount;
                }else{

                }
            }
        }
        
       
        for ($index = 0; $index < count($portfolio); $index++) {
            if ($portfolio[$index]->is_active) {
                $settled_portfolio = $settled_portfolio + 1;
            } else {
                $active_portfolio = $active_portfolio + 1;
            }
        }

        
        return view('admin/portfolio')->with(['portfolios' => $portfolio, "total_deposite" => $total_deposite, "total_withdrawal" => $total_withdrawal, 'settled_portfolio' => $settled_portfolio, "active_portfolio" => $active_portfolio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investment_period = InvestmentPeriod::all();
        return view('admin/create_portfolio')->with("investment_period", $investment_period);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $result = $request->validate([
            'amount' => 'required|numeric',
            'tenure' => 'required'
        ]);

        
        $portfolio_count = count(Portfolio::where('user_id', Auth::user()->id)->get()) + 1;
        $portfolio = new Portfolio();
        $portfolio->name = "Portfolio $portfolio_count";
        $portfolio->user_id = Auth::user()->id;
        $portfolio->is_active = 1;
        $portfolio->investment_amount = $request['amount'];
        $portfolio->investment_period_id = $request['tenure'];
        $portfolio->save();
        
        return redirect()->back()->with('success', "Withdrawal request submitted successfully");
    }

    protected function transactions(){
        $transactions = Transaction::where(['user_id' => Auth::user()->id])->get();
        return view('admin/transactions')->with('transactions' , $transactions);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
