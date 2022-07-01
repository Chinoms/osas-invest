@extends('admin/base')

@section('extra-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <style>
        .expiring {
            width: 100px;
            height: 100px;
            background-color: #2f2cd8;
            animation-name: example;
            animation-duration: 2s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }

        @keyframes example {
            from {
                opacity: 1;
            }

            to {
                opacity: 0.5;
            }
        }
    </style>
@endsection

@section('body')
    <div class="homepage mb-80">
        <div class="container">
            <div class="row">
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

                <div id="form" class="col-xl-6 col-md-6 py-md-5">
                    @if (session('success'))
                        <div class="identity-content">
                            <span class="icon"><i class="fa fa-check"></i></span>
                            <h4><span id="folioName"></span> setup successfully</h4>
                            <p>Congratulations on successfully creating a new portfolio. You may now proceed to
                                reviewing your <a href="/portfolio"><b>portfolios</b></a></p>
                        </div>
                    @endif
                    <div class="card" style="background:#f7f8fa;">

                        <div class="card-header">
                            <h4 class="card-title">Portfolio Setup</h4>
                        </div>
                        <div class="card-body">
                            <div id="errorBox" class="alert alert-danger show flex items-center mb-2"
                                style="display: none;"></div>
                            <div class="buy-sell-widget">
                                <form method="POST" action="/portfolio">
                                    @csrf
                                    <a id="butt" href="#demo" data-toggle="collapse" data-target="#demo"
                                        style="opacity:0;"></a>
                                    <div class="form-group">
                                        <label class="mr-sm-2">Tenure </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i class="fa fa-business-time"></i></label>
                                            </div>
                                            <select id="tenure" class="form-control" name="tenure">
                                                @foreach ($investment_period as $period)
                                                    <option value="{{ $period->id }}">{{ $period->months }} Months
                                                        &nbsp;&nbsp;&nbsp;|| &nbsp;{{ $period->rate }}%</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2">Investment amount <a href="" title=""
                                                data-toggle="popover" data-trigger="focus"
                                                data-content="This amount constitutes your INITIAL CONTRACT and your interests will be calculated based on this figure."
                                                data-original-title="Investment Amount"><i class="fa fa-question-circle"
                                                    style="color:orange;"></i></a></label>
                                        <div class="input-group">
                                            <input id="linkTenureAmountBtc" type="number" name="amount" min="0"
                                                step="any" class="form-control" placeholder="0.0214 BTC">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mr-sm-2">savePro™ <a href="javascript:;" title=""
                                                data-toggle="popover" data-trigger="focus"
                                                data-content="If activated, this feature compels you to save by declining any withdrawals below your specified minimum withdrawal amount. NOTE: This feature cannot be changed after portfolio creation"
                                                data-original-title="savePro™"><i class="fa fa-question-circle"
                                                    style="color:orange;"></i></a></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text"><i
                                                        class="fa fa-hand-holding-usd"></i></label>
                                            </div>
                                            <select id="savePro" class="form-control" name="save_pro">
                                                <option value="no">No </option>
                                                <option value="yes">Yes - Activate savePro™</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit"
                                        class="btn btn-primary btn-block waves-effect">Setup</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('extra-script')
@endsection
