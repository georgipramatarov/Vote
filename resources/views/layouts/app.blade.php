<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Secure Vote') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Secure Vote') }}
                        {{date("m/d/Y")}}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar 
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>
                    -->
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guard("admin_user")->user())
                            @include('layouts.admin-dropdown')
                        @elseif(! Auth::guest())
                            @include('layouts.dropdown')
                        @elseif (Request::url() == url('/vote'))
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @elseif(Request::url() == url('/admin_login'))
                            <li><a href="{{ url('/admin_register') }}">Register</a></li>
                        @elseif(Request::url() == url('/register'))
                            <li><a href="{{ url('/vote') }}">Vote</a></li>                          
                        @else
                            <li><a href="{{ url('/vote') }}">Vote</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


          @yield('content')
          @yield('security')
          @yield('overview')
          @yield('disable_2FA')
          @yield('enable_2FA')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $("form.test").hover(function(){
            $(this).css("background-color", "lightgray");
            $(this).css("color", "white");
            }, function(){
            $(this).css("background-color", "white");
            $(this).css("color", "black");
        });
    });
    </script>
</body>
</html>
