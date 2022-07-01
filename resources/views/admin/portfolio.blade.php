@extends('admin/base')
@section('body')
    <div class="homepage mb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="card profile_card">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="mb-2">Portfolio Summary</h4>
                                </div>
                            </div>
                            <table class="table" style="background:#e4e9f0;" width="80%" align="center">
                                <tbody>
                                    <tr>
                                        <td align="right">
                                            <div>
                                                <p class="mb-1">Overall Portfolios</p>
                                                <h4>{{ count($portfolios) }}</h4>
                                            </div>
                                        </td>
                                        <td align="left">
                                            <div>
                                                <p class="mb-1">Overall Balance</p>
                                                <h4>{{ $total_deposite + $total_withdrawal }}</h4>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div>
                                                <p class="mb-1">Active Portfolios</p>
                                                <h4>{{ $active_portfolio }}</h4>
                                            </div>
                                        </td>
                                        <td align="left">
                                            <div>
                                                <p class="mb-1">Settled Portfolios</p>
                                                <h4>{{ $settled_portfolio }}</h4>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="right">
                                            <div>
                                                <p class="mb-1">Total Deposits</p>
                                                <h4>{{ $total_deposite }}</h4>
                                            </div>
                                        </td>
                                        <td align="left">
                                            <div>
                                                <p class="mb-1">Total Withdrawals</p>
                                                <h4>{{ $total_withdrawal }}</h4>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="media" style="width:60%;margin:auto">
                                <a href="/portfolio/create" <button=""
                                    class="btn btn-primary btn-block waves-effect"><i class="fa fa-plus"></i>&nbsp;&nbsp;New
                                    Portfolio</a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($portfolios as $portfolio)
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="card acc_balance" style="background:#f7f8fa;">
                            <div class="card-header">
                                <h4 class="card-title">{{ $portfolio->name}}</h4>
                            </div>
                            <div class="card-body">
                                <span>Available BTC</span>
                                <h3>{{ $portfolio->transaction->where(['type'=> 0, 'status' => 1])->sum('amount') - $portfolio->transaction->where(['type'=> 1, 'status' => 1])->sum('amount') }}
                                    BTC</h3>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">Setup Date</p>
                                        <h4>{{ $portfolio->created_at->format('Y-m-d') }}</h4>
                                    </div>
                                    <div align="right">
                                        <p class="mb-1">Tenure</p>
                                        <h4>{{ $portfolio->tenure->months }} Months</h4>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">Initial Contract</p>
                                        <h4>{{ $portfolio->investment_amount }} BTC</h4>
                                    </div>
                                    <div align="right">
                                        <p class="mb-1">Rate</p>
                                        <h4>{{ $portfolio->tenure->rate }}%</h4>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">Deposits</p>
                                        <h4 style="color:green;opacity:0.55">+
                                            {{ $portfolio->transaction->where(['type'=> 0, 'status' => 1])->sum('amount') }}</h4>
                                    </div>
                                    <div align="right">
                                        <p class="mb-1">Withdrawals</p>
                                        <h4 style="color:red;opacity:0.55">
                                            -{{ $portfolio->transaction->where(['type'=> 1, 'status' => 1])->sum('amount') }} BTC</h4>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between my-4">
                                    <div>
                                        <p class="mb-1">Status</p>
                                        <h4>New</h4>
                                    </div>
                                    <div align="right">
                                        <p class="mb-1">Remarks</p>
                                        <h4>Tenure not started</h4>
                                    </div>
                                </div>
                                <div class="btn-group mb-3">
                                    <a href="/cashier/deposite/{{$portfolio->id}}" class="btn btn-success waves-effect"><i
                                            class="fa fa-arrow-down">&nbsp;</i>Deposit</a>
                                    <a href="/cashier/withdraw/{{$portfolio->id}}" class="btn btn-primary btn-sm waves-effect"><i
                                            class="fa fa-arrow-up">&nbsp;</i>Withdraw</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
