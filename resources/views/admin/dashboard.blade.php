@extends('admin/base')
@section('body')
    <div class="homepage mb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="card balance-widget" style="background:#f7f8fa;">
                        <div class="card-header pb-0 border-0">
                            <h4 class="card-title">Your Portfolios </h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="balance-widget">
                                {{-- <div class="total-balance">
                                    <h3>19 BTC</h3>
                                    <h6>Total Balance</h6>
                                </div> --}}
                                <ul class="list-unstyled">
                                    @foreach ($portfolios as $portfolio)
                                        <li class="media">
                                            <i class="cc BTC mr-3"></i>
                                            <div class="media-body">
                                                <a href="#" onClick="navigate('portfolio?id=122623');">
                                                    <h6 class="m-0">{{ $portfolio->name }}</h6>
                                                </a>
                                            </div>
                                            <div class="text-right">
                                                <a href="#" onClick="navigate('portfolio?id=122623');">
                                                    <h5>{{ $portfolio->investment_amount }} BTC</h5>
                                                    <span>{{ $portfolio->transaction->where('type', 0)->sum('amount') - $portfolio->transaction->where('type', 1)->sum('amount') }}</span>
                                                </a>
                                            </div>
                                        </li>
                                    @endforeach

                                    <li class="media">
                                        <a href="/portfolio/create"> <button
                                                class="btn btn-primary btn-block waves-effect">Create
                                                Portfolio</button></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    <div class="card" style="background:#f7f8fa;">
                        <div class="card-header border-0 pb-0">
                            <h4 class="card-title">Recent Transactions</h4>
                            <a href="/transactions">View More </a>
                        </div>
                        <div class="card-body">
                            <div class="transaction-table">
                                <div class="table-responsive">
                                    <table class="table mb-0 table-responsive-sm">
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                                <tr>
                                                    <td>
                                                        @if ($transaction->type == 0)
                                                            <span class="buy-thumb bg-primary">
                                                                <i class="la la-arrow-down"></i>
                                                            </span>
                                                        @else
                                                            <span class="buy-thumb bg-danger">
                                                                <i class="la la-arrow-up"></i>
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span>{{ $transaction->created_at->format('d-M-Y') }}</span>
                                                    </td>
                                                    <td>
                                                        <span> {{$transaction->portfolio->name}} </span>
                                                    </td>
                                                    <td>
                                                        <span class=""> Portfolio funding received</span>
                                                    </td>
                                                    <td class="text-success"><span>@if ($transaction->type == 0)
                                                        +{{$transaction->amount}}
                                                    @else
                                                    -{{$transaction->amount}}
                                                    @endif BTC</span></td>
                                                </tr>
                                            @endforeach
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
