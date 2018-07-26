<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Nestle</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/dataTables.bootstrap4-1.10.19.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <style type="text/css">
        .btn-group-xs > .btn, .btn-xs {
            padding  : .25rem .4rem;
            font-size  : .875rem;
            line-height  : .5;
            border-radius : .2rem;
        }

        .alert {
            padding: 2px; 
            margin-bottom: 0px; 
        }
    </style>
     @yield('style')
</head>
<body id="app-layout">
    <!-- <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/') }}">
                    Nestle Profile
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav> -->

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Nestle Profile
            </a>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    
                    @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">Home</a>
                        </li>
                        <li {{ ( Request::is('division') || Request::is('division/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/division') }}">Division</a>
                        </li>
                        <li {{ ( Request::is('district') || Request::is('district/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/district') }}">District</a>
                        </li>
                        <li {{ ( Request::is('police-station') || Request::is('police-station/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/police-station') }}">Police Station</a>
                        </li>
                        <li {{ ( Request::is('brand') || Request::is('brand/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/brand') }}">Brand</a>
                        </li>
                        <li {{ ( Request::is('product') || Request::is('product/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/product') }}">Product</a>
                        </li>
                        <li {{ ( Request::is('select') || Request::is('select/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/select') }}">Select</a>
                        </li>
                        <li {{ ( Request::is('option') || Request::is('option/*') ? 'class=active' : '' ) }}>
                            <a class="nav-link" href="{{ url('/option') }}">Option</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-1">
        <div class="col-sm-8 offset-sm-2">
            @include('flash::message')
        </div> 
    </div>

    @yield('content')

    <footer class="mt-5">
      <div style="background-color: #343a40!important;">
        <center><p style="font-family: 'Open Sans', serif; font-size: 12px; margin-top: 0px; padding: 10px;"><span style="color: #FFFFFF">Developed by</span> <a href="http://www.myolbd.com/" target="_blank" style="color: red;">MY Outsoursing Ltd. </a> <span style="color: #FFFFFF">All Rights Reserved.</span></p></center>
      </div>
    </footer>
    <!-- JavaScripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script src="{{ asset('assets/js/dataTables-1.10.19.min.js') }}"></script>
    <!-- <script src="{{ asset('https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js') }}"></script> -->
    <script src="{{ asset('assets/js/dataTables.bootstrap4-1.10.19.min.js') }}"></script>
     @yield('script')
</body>
</html>
