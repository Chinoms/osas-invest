@extends('admin/base')
@section('body')
    <div class="homepage mb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-12">
                    <div class="card" style="background:#f7f8fa;">
                        <div class="card-body">
                            <div class="buy-sell-widget">
                                <h2 class=""><strong>Withdraw</strong></h2>
                                <hr class="mb-4">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <p><strong>Opps Something went wrong</strong></p>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <form method="post" action="/cashier/withdraw">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mr-sm-2">Portfolio</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="cc BTC-alt"></i></label>
                                            </div>
                                            <select name="portfolio" class="form-control">

                                                <option value="{{ $portfolio->id }}"> Portfolio 0 ||
                                                    {{ $portfolio->transaction->where('type', 0)->sum('amount') - $portfolio->transaction->where('type', 1)->sum('amount') }}
                                                    BTC
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2">Recipient wallet</label>
                                        <div class="form-group">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <label class="input-group-text"><i class="fa fa-money"></i></label>
                                                </div>
                                                <input type="text" name="wallet" class="form-control"
                                                    placeholder="3FZbgi29cpjq2GjdwV8eyHuJJnkLtktZc5">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2">Enter your amount</label>
                                        <div class="input-group">
                                            <input type="number" min="0" step="any" id="btcAmountWithdraw"
                                                name="amount" class="form-control" placeholder="0.0214 BTC">
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-block waves-effect"><i
                                            class="fa fa-arrow-up">&nbsp;</i>Withdraw
                                        Now</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-12">
                    <div class="card" style="background:#f7f8fa;">
                        <div class="card-body">
                            <div class="buyer-seller">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="seller-info text-right">
                                        <span id="folioName">Portfolio 2</span> Summary
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Balance</td>
                                                <td id="folioBalance">
                                                    {{ $portfolio->transaction->where('type', 0)->sum('amount') - $portfolio->transaction->where('type', 1)->sum('amount') }}
                                                    BTC</td>
                                            </tr>
                                            <tr>
                                                <td>Setup Date</td>
                                                <td id="folioSetupDate">{{ $portfolio->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Initial Contract</td>
                                                <td id="folioTenureAmount">{{ $portfolio->investment_amount }}</td>
                                            </tr>
                                            <tr>
                                                <td>Tenure</td>
                                                <td id="folioTenure">{{ $portfolio->tenure->months }} Months</td>
                                            </tr>
                                            <tr>
                                                <td>Rate</td>
                                                <td id="folioRate">{{ $portfolio->tenure->rate }}%</td>
                                            </tr>
                                            <tr>
                                                <td>Maturity</td>
                                                <td id="folioMaturityDate">Not set</td>
                                            </tr>
                                            <tr>
                                                <td>Remarks</td>
                                                <td id="folioStatus">Portfolio will not earn interests</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
