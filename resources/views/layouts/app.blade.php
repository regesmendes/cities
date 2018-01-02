<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Reges Dronacharya">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cities') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	@yield("css")

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.2/js/all.js"></script>
	@yield('header-js')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Cities') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                    	@guest
                        	&nbsp;
                        @else
                            @if (Auth::user()->cities()->count() > 0)
                            	<li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                        Your Cities <span class="caret"></span>
                                    </a>
    
                                    <ul class="dropdown-menu">
                                    	@foreach(Auth::user()->cities as $city)
                                            <li><a href="/land/{{ $city->land_id }}">{{ $city->name }}</a></li>
                                        @endforeach
                                    </ul>
                            	</li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    	<div class="container">
        	<div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div>
        </div>

        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/game.js') }}"></script>
	@yield('footer-js');
	
</body>
</html>
