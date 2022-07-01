@extends('admin/base')
@section('body')
    <div class="homepage mb-80 px-lg-5 px-sm-2">
        <div class="card" style="background:#f7f8fa;">
            <div class="card-header border-0 pb-0">
                <h4 class="card-title">All Transactions</h4>
            </div>
            <div class="card-body">
                <div class="transaction-table">
                    <div class="table-responsive">
                        <table class="table mb-0 table-responsive-sm">
                            <tbody>
                                @if (count($transactions) > 0)
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
                                                <span>{{ $transaction->portfolio->name }}</span>
                                            </td>
                                            @if ($transaction->status == 1 && $transaction->type == 0)
                                                <td>
                                                    <span class=""> Portfolio funding received</span>
                                                </td>
                                            @elseif($transaction->status == 1 && $transaction->type == 1)
                                                <td>
                                                    <span class=""> Portfolio funding sent</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="">Processing</span>
                                                </td>
                                            @endif

                                            <td class="text-success"><span>
                                                    @if ($transaction->type == 0)
                                                        +{{ $transaction->amount }}
                                                    @else
                                                        -{{ $transaction->amount }}
                                                    @endif BTC
                                                </span></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>No Transactions</h1>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
