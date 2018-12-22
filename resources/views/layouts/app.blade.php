<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91457849-4"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-91457849-4');
    </script>

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-6691059885236141",
        enable_page_level_ads: true
        });
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="paladins, champions of the realm, champions, ninja, master, trends, player, guru, meta, discord, twitter, community">
    <meta name="description" content="Giving Paladins player the information they want and need about their games, profile, loadouts, and trends.">
    <meta name="author" content="Halfpetal LLC">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-alt.png') }}"/>
    
    <title>{{ (isset($pageTitle) ? $pageTitle . ' | ' : '') . config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.rawgit.com/tarkhov/postboot/v1.0.0-beta1/dist/css/postboot.min.css"/>
    <script src="https://cdn.rawgit.com/tarkhov/postboot/v1.0.0-beta1/dist/js/postboot.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.6.0/js/all.js" integrity="sha384-z9ZOvGHHo21RqN5De4rfJMoAxYpaVoiYhuJXPyVmSs8yn20IE3PmBM534CffwSJI" crossorigin="anonymous"></script>
    
    @yield('head')
</head>
<body>
    <div id="app" onload="loaded">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <form class="form-inline" role="form" action="{{ route('search') }}" method="POST">
                            {{  csrf_field() }}
                            <div class="row no-gutters">
                                <input name="platform" id="platform" type="hidden" value="pc">
                                <div class="col">
                                    <input class="form-control form-control rounded-0" type="text" id="name" name="name" placeholder="Find a Player">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-success rounded-0" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('champions') }}">Champion List</a>
                        </li>

                        <li class="nav-item divider-vertical"></li>

                        <li class="nav-item">
                            <a class="nav-link navbar-brand" href="https://discord.gg/C6zQ6Yj"><i class="fab fa-discord"></i></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link navbar-brand" href="https://twitter.com/Paladins_Ninja"><i class="fab fa-twitter"></i></a>
                        </li>

                    {{-- <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest --}}
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
