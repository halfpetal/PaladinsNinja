<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if(env('APP_ENV') != 'local')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-91457849-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-91457849-4');
    </script>
    @endif

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="login-status" content="{{ Auth::check() ? 'true' : 'false' }}">
    <meta name="keywords" content="paladins, champions of the realm, champions, ninja, master, trends, player, guru, meta, discord, twitter, community, reviews, review, esports, recruitment, stats, statistics, coach, tp, elo, mobile, bot, app, mobile app">
    <meta name="description" content="Giving Paladins player the information they want and need about their games, profile, loadouts, and trends.">
    <meta name="author" content="Halfpetal LLC">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/new-alt.png') }}" />

    <title>{{ (isset($pageTitle) ? $pageTitle . ' / ' : '') . config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/particles.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @if(session('user.theme') !== null)
    <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/{{ session('user.theme') }}/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    @endif

    <link rel="stylesheet" href="https://cdn.rawgit.com/tarkhov/postboot/v1.0.0-beta1/dist/css/postboot.min.css" />
    <script src="https://cdn.rawgit.com/tarkhov/postboot/v1.0.0-beta1/dist/js/postboot.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.6.0/js/all.js" integrity="sha384-z9ZOvGHHo21RqN5De4rfJMoAxYpaVoiYhuJXPyVmSs8yn20IE3PmBM534CffwSJI"
        crossorigin="anonymous"></script>

    @yield('head')
</head>

<body>
    <div id="app" onload="loaded">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/') }}" data-toggle="tooltip" title="{{ \Version::compact() }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <form class="form-inline" role="form" action="{{ route('search') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row no-gutters">
                            <input name="platform" id="platform" type="hidden" value="pc">
                            <div class="col">
                                <input class="form-control form-control rounded-0" type="text" id="name" name="name"
                                    placeholder="Find a Player">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-success rounded-0" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.show', ['user' => Auth::user()->username]) }}">
                                {{ __('My Profile') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('player', ['player' => Auth::user()->paladins_player_id]) }}">
                                {{ __('My Player Profile') }}
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('settings') }}">
                                {{ __('Settings') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            Tools / Related <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <h6 class="dropdown-header">Tools</h6>
                            <a class="dropdown-item" href="{{ route('champion.index') }}">{{ __('Champion List') }}</a>
                            <a class="dropdown-item" href="{{ route('tools.tierlist.index') }}">{{ __('Tierlists') }}</a>
                            <a class="dropdown-item" href="{{ route('tools.loadout-builder.index') }}">{{ __('Builds') }}</a>

                            <div class="dropdown-divider"></div>
                            <h6 class="dropdown-header">Related</h6>
                            <a class="dropdown-item" href="https://www.thebettermeta.com/" target="_blank">The Better Meta</a>
                            <a class="dropdown-item" href="http://paladinsworld.com" target="_blank" rel="noopener noreferrer">Paladins World</a>
                            <a class="dropdown-item" href="https://reddit.com/r/Paladins" target="_blank" rel="noopener noreferrer">r/Paladins</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @if(!isset($noFooter))
            @include('includes.footer')
        @endif

        <adblock-detector></adblock-detector>
    </div>

    @yield('footer')
</body>

</html>