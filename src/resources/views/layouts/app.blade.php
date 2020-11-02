<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GroupList') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
    <script src="{{ asset('js/sort.js') }}"></script>
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/parts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sort.css') }}" rel="stylesheet">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/users') }}"> --}}
                {{ config('app.name', 'GroupList') }}
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    @guest
                    @if (Route::has('register'))
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                {{ __('Register') }}
                            </a>
                        </li>
                    </ul>
                    @endif
                    @else
                    {{-- else guest --}}

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav ml-3 mr-auto">

                        <li class="nav-item active mr-1">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item active mr-1">
                            {{-- <a class="nav-link" href="{{ url('calendar') }}">カレンダー</a> --}}
                        </li>
                        <li class="nav-item dropdown mr-3">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                投稿一覧
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                {{-- <a href="{{ url('users/item/list') }}" class="dropdown-item">個人</a> --}}
                                <div class="dropdown-divider"></div>
                                {{-- <a href="{{ url('users/item/group') }}" class="dropdown-item">グループ別</a> --}}
                            </div>
                        </li>

                        @if (Auth::user()->is_admin == '1')
                        <li class="nav-item active">

                            {{-- <a class="nav-link" href="{{ route('admin') }}">
                            管理者画面
                            </a> --}}
                        </li>
                        @endif
                    </ul>

                    <ul class="navbar-nav ml-5 ml-auto">
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                user : {{ Auth::user()->user_name }} <span class="caret"></span>
                            </a>

                            {{-- logout --}}
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                    @endguest
                </div>
            </div>
            {{-- container --}}
        </nav>

        {{-- menu --}}
        <main class="py-4">
            @section('content')
            @show
        </main>

    </div>
</body>

</html>
