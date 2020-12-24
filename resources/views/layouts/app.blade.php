<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Elliot's Blog</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="/css/app.css" rel="stylesheet" type="text/css" >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   </head>
<body>
    <div id="app">
        <div class='img-container'>
            <img src="{{URL::asset('/img/background/IMG_5645.JPG')}}" class="img-fluid"/>
            <a class='img-text d-flex justify-content-center' href="{{ url('/') }}"><b>Elliot's Blog</b></a>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm site-header sticky-top">
            <a class="navbar-brand ml-1" href="{{ url('/') }}"><b>Elliot's Blog</b></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
              

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/1"><b>White Water</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/2"><b>Canoe Slalom</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/3"><b>Canoe Polo</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pages/4"><b>Off Topic</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>About/Contact</b></a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                </div>
            
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
