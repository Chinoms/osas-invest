<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">

    <link rel="stylesheet" href="{{ asset('vendor/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toast.min.css') }}">
    {{-- <link rel="stylesheet" href="{{asset('icons/line_awesome.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/owlcarousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/style.css') }}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

  
    @yield('extra-style')

</head>

<body class="dashboard">
    <div id="ajaxpreloader">
        <div class="ajaxsk-three-bounce">
            <div class="sk-child "><img src="{{ asset('images/ripple.svg') }}" /></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="header dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="navbar navbar-expand-lg navbar-light px-0">
                            <a class="navbar-brand" href="/dashboard" onClick="navigate('dashboard');"><img
                                    src="./images/w_logo.png" alt=""></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    <li class="nav-item active">
                                        <a class="nav-link active" href="/dashboard">Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/transactions">Transactions</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/portfolio">Portfolio</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dashboard_log my-2">
                                <div class="d-flex align-items-center">

                                    <div class="profile_log dropdown">
                                        <div class="user" data-toggle="dropdown">
                                            <span class="thumb"><i class="la la-user"></i><span id="menuBadge"
                                                    class="badge" style="display:none;"></span></span>
                                            <span class="name">{{ Auth::user()->phone_number }}</span>
                                            <span class="arrow"><i class="la la-angle-down"></i></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item">
                                                <i class="la la-envelope"></i> Messages
                                                <span id="dropdownBadge" class="badge"
                                                    style="background-color:#6610f2;color:#fff;display:none;top: -20px;width:60%;margin:auto;"></span>
                                            </a>
                                            <form action="{{ route('logout') }}" method="post">
                                                @csrf
                                                {{-- <button type="submit">Logout</button> --}}
                                                <button href="" class="dropdown-item logout">
                                                    <i class="la la-sign-out"></i> Logout

                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="page_title section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="page_title-content">
                            <p>Welcome Back,
                                <span>{{ Auth::user()->phone_number }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @yield('body')




        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                    </div>
                    <div class="col-xl-6 col-md-6 text-lg-right text-center">
                        <div class="social">
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-12 text-center text-lg-right">
                        <div class="copy_right text-center text-lg-center">
                            &copy; 2022
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ajaxloader" style="display: none;">
        <div id="ajaxpreloader">
            <div class="ajaxsk-three-bounce">
                <div class="sk-child "><img src="{{ asset('images/ripple.svg') }}" /></div>
            </div>
        </div>
    </div>
    <script>
        function preLoader(y) {
            if (y == "on") {
                document.getElementById('ajaxloader').style.display = "block";
            }
            if (y == "off") {
                document.getElementById('ajaxloader').style.display = "none";
            }
        }

        function navigate(link) {
            preLoader('on');
            window.location.href = link;
        }
    </script>
    <script src="{{ asset('vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/js/wave.min.js') }}"></script>
    <script src="{{ asset('vendor/magnific-popup/magnific-popup.js') }}"></script>
    <script src="{{ asset('vendor/magnific-popup/magnific-popup-init.js') }}"></script>

    <script src="{{ asset('vendor/js/index.js') }}"></script>
    <script id="badgeScript" src="./js/checkMessages.js?g=1656175418"></script>

    @yield('extra-script')
</body>

</html>
