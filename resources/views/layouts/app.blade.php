<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle') - {{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body style="background-color: #d9c7b8">
    <div id="app">
        @include('layouts.header')

        <main class="@if(request()->routeIs('welcome') || request()->routeIs('login') || request()->routeIs('register')) py-0 @else py-4 @endif">
            @if(request()->routeIs('admin.*'))
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        @include('layouts.sidebar')
                    </div>
                    <div class="col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
            @else
            @yield('content')
            @endif
        </main>
    </div>
</body>
</html>
