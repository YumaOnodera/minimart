<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- サイト説明 -->
    <meta name="description" content="Minimart(ミニマート)は、自分のお気に入りグッズを共有できるサービスです。">

    <!-- Twitterカード設定 -->
    @if (request()->is('goods/*'))
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:title" content="{{ $goods->goods_name }}" />
    <meta property="og:description" content="{{ $goods->goods_description }}" />
    <meta property="og:image" content="{{ $goods->goods_img_src }}" />
    @endif

    <title>{{ config('app.name', 'Minimart') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">ホーム</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/mypage') }}">マイページ</a>
                        </li>
                        @endauth
                    </ul>

                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Minimart') }}
                    </a>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('会員登録') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (isset(Auth::user()->user_img_src))
                                    <img src="{{ Auth::user()->user_img_src }}" alt="{{ Auth::user()->user_name }}" height="24"> <span class="caret"></span>
                                    @else
                                    <img class="circle" src="http://drive.google.com/uc?export=view&id=10eWgwGJDpiRqxi4NnQ3aWgLs9k52yA_g" alt="{{ Auth::user()->user_name }}"　height="24"> <span class="caret"></span>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item py-2 bg-light" href="{{ url('/mypage') }}">
                                        {{ Auth::user()->user_name }}
                                    </a>
                                    <hr class="m-0">
                                    <a class="dropdown-item py-2" href="{{ url('/setting/account') }}">
                                        {{ __('アカウント設定') }}
                                    </a>
                                    <a class="dropdown-item py-2" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary ml-3" href="/mypage/create">新規作成</a>
                            </li>
                        @endguest
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
