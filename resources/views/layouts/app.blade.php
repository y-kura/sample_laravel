<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- タイトル -->
    @if (View::hasSection('title'))
    <title>@yield('title') - {{ config('app.name') }}</title>
    @else
    <title>{{ config('app.name') }}</title>
    @endif

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
    .container { max-width: 750px; }
    pre { white-space: pre-wrap; }
    input.form-control::placeholder { color: #ccc; }
    </style>
</head>
<body>
    <!-- ヘッダー -->
    <header>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand font-weight-bold" href="{{ url('/') }}">{{ config('app.name') }}</a>
                @auth
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item @if(request('user_id') == Auth::id()) active @endif"><a class="nav-link" href="{{ route('article.index', ['user_id' => Auth::id()]) }}"><i class="bi bi-list align-text-bottom"></i> 自分の記事</a></li>
                        <li class="nav-item @if(Request::is('article/create')) active @endif"><a class="nav-link" href="{{ route('article.create') }}"><i class="bi bi-pencil-square align-text-bottom"></i> 記事を投稿</a></li>
                    </ul>
                </div>
                @endauth
                <ul class="navbar-nav ml-md-auto">
                    @auth
                    <li class="nav-item dropdown active">
                        <a class="nav-item nav-link dropdown-toggle" href="#" id="loginUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-fill"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a class="dropdown-item" href="javascript:logoutForm.submit()">ログアウト</a>
                            </form>
                        </div>
                    </li>
                    @else
                    <li class="nav-item mx-1"><a class="btn btn-outline-light" href="{{ route('login') }}">ログイン</a></li>
                    <li class="nav-item mx-1"><a class="btn btn-outline-warning" href="{{ route('register') }}">新規登録</a></li>
                    @endauth
                </ul>
            </div>
        </nav>
        <br>
    </header>

    <!-- コンテンツ -->
    <main class="py-3">
        @yield('content')
    </main>
</body>
</html>
