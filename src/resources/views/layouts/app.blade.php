<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- サイト説明 -->
    <meta name="description" content="Minimart(ミニマート)は、お気に入りを世界中にシェアできるサービスです。">

    <!-- Twitterカード設定 -->
    @if (request()->is('goods/*'))
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:title" content="{{ $post->goods_name }}" />
    <meta property="og:description" content="{{ $post->goods_description }}" />
    <meta property="og:image" content="/storage/{{ $post->goods_img_src }}" />
    @else
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:title" content="Minimart(ミニマート) | お気に入りを世界中にシェアしよう" />
    <meta property="og:description" content="Minimart(ミニマート)は、お気に入りを世界中にシェアできるサービスです。" />
    <meta property="og:image" content="{{ asset('/img/top.jpg') }}" />
    @endif

    <title>@yield('title') {{ config('app.name', 'Minimart') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/like.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.min.css') }}" rel="stylesheet">
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
                            <a class="nav-link" href="/{{ Auth::user()->user_id }}">マイページ</a>
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle p-1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    @if (isset(Auth::user()->avatar_img_src))
                                    <img class="rounded-circle" src="/storage/{{ Auth::user()->avatar_img_src }}" alt="{{ Auth::user()->user_name }}" height="32">
                                    @else
                                    <img class="rounded-circle" src="{{ asset('/img/default-avatar.jpeg') }}" alt="{{ Auth::user()->user_name }}" height="32">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right m-0 p-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item py-2 bg-light" href="/{{ Auth::user()->user_id }}">
                                        {{ Auth::user()->user_name }}
                                    </a>
                                    <hr class="m-0">
                                    <a class="dropdown-item py-2" href="{{ url('/settings/account') }}">
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
                                <a class="btn btn-primary rounded-pill px-3 ml-3" href="/post/create"><i class="fas fa-pen mr-2"></i><span>投稿</span></a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('header')
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
