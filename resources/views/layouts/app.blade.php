<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="@lang('platform.direction')">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <title>@yield('title'){{ config('platform.name', 'ShirazPlatform') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
    <script type="text/javascript">
        var _paq = _paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//matomo.shirazsoft.com/";
            _paq.push(['setTrackerUrl', u+'piwik.php']);
            _paq.push(['setSiteId', '2']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
</head>
<body class="rtl">
<div id="app">
    <header class="{{ config('platform.header-position') }}">
        <nav class="navbar navbar-expand-md {{ config('platform.navbar-type') }}">
            <div class="{{ config('platform.navbar-container') }}">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand ml-auto" href="{{ url('/') }}">
                    <i class="fa {{ config('platform.main-icon') }}"></i> {{ config('platform.name', 'ShirazPlatform') }}
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @guest

                        @else
                            <li><a class="nav-link{{ Request::segment(1) == 'dashboard' ? ' active' : '' }}" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> داشبرد</a></li>
                            @if(Auth::user()->level == 'admin')
                                <li><a class="nav-link{{ Request::segment(1) == config('platform.admin-route') ? ' active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fa fa-cogs"></i> مدیریت سیستم</a></li>
                            @endif
                        @endguest
                        @foreach($menus as $menu)
                            @if($menu->position == 'navbar-top')
                                @guest
                                    @if($menu->register == 'no' )
                                        <li><a class="nav-link{{ Route::currentRouteName() == $menu->route ? ' active' : '' }}" href="{{ route($menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                    @endif
                                @else
                                    @if($menu->register == 'yes')
                                        <li><a class="nav-link{{ Route::currentRouteName() == $menu->route ? ' active' : '' }}" href="{{ route($menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                    @endif
                                @endguest
                            @endif
                        @endforeach
                            <li><a class="nav-link{{ Request::segment(1) == 'file' ? ' active' : '' }}" href="{{ route('file') }}"><i class="fa fa-files-o"></i> نرم افزار</a></li>
                            <li><a class="nav-link{{ Request::segment(1) == 'product' ? ' active' : '' }}" href="{{ route('product') }}"><i class="fa fa-cubes"></i> سخت افزار</a></li>
                    </ul>

                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @if(Cart::count())
                            <li>
                                <a class="nav-link{{ Request::segment(1) == 'cart' ? ' active' : '' }}" href="{{ route('cart') }}"><i class="fa fa-shopping-basket"></i> سبد خرید<span class="badge badge-pill badge-info">{{Cart::count()}}</span></a>
                            </li>
                        @endif
                        @guest
                            <li><a class="nav-link{{ Request::segment(1) == 'login' ? ' active' : '' }}" href="{{ route('login') }}"><i class="fa fa-sign-in"></i>ورود </a></li>
                            @if(config('platform.enable-register'))
                                <li><a class="nav-link{{ Request::segment(1) == 'register' ? ' active' : '' }}" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> ثبت نام</a></li>
                            @endif
                        @else
                            <li><a class="nav-link{{ Request::segment(1) == 'notification' ? ' active' : '' }}" href="{{ route('notification') }}"><i class="fa fa-bullhorn"></i> اطلاعیه ها<notification-navbar-component></notification-navbar-component></a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-circle-o"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile') }}">
                                        <i class="fa fa-user"></i> مشخصات کاربری
                                    </a>
                                    <a class="dropdown-item" href="{{ route('password') }}">
                                        <i class="fa fa-key"></i>  تغییر رمز عبور
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i> خروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="py-4" role="main">
        <div class="{{ config('platform.main-container') }}">
            @include('flash::message')
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="{{ config('platform.footer-position') }}">
        <nav class="navbar navbar-expand-lg {{ config('platform.navbar-bottm-type') }}">
            <div class="{{ config('platform.navbar-container') }}">
                <ul class="navbar-nav ml-auto">

                @foreach($menus as $menu)
                    @if($menu->position == 'navbar-bottom')
                        @if($menu->register == 'yes' && Auth::check())
                                @if($menu->register == 'route')
                                    <li><a class="nav-link{{ Route::currentRouteName() == $menu->route ? ' active' : '' }}" href="{{ route($menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                @else
                                    <li><a class="nav-link" href="{{ $menu->route }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                @endif
                        @else
                                @if($menu->register == 'route')
                                    <li><a class="nav-link{{ Route::currentRouteName() == $menu->route ? ' active' : '' }}" href="{{ route($menu->route) }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                @else
                                    <li><a class="nav-link" href="{{ $menu->route }}"><i class="{{ $menu->icon }}"></i> {{ $menu->title }}</a></li>
                                @endif
                        @endif
                    @endif
                @endforeach
                </ul>
                <div class="mr-auto">
                    <a href="https://shirazsoft.com" target="_blank">قدرت گرفته از گروه نرم افزار شیراز</a>
                </div>
            </div>
        </nav>
    </footer>

</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('js')
</body>
</html>

