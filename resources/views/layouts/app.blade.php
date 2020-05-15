<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


    <!-- Styles -->
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/material.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4 {
            font-family: "Cairo";
        }



        #map {
            height:500px;
            width:100%;
        }

    </style>
    @yield('head')

</head>
<body>
    <div id="app">
{{--        @include('layouts.nav-bar')--}}
        <main class="">
            @yield('content')
        </main>
    </div>
</body>
</html>
