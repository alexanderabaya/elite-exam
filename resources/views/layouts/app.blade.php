<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/logo/laravel.ico') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/header/header.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/sidebar/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/layout/app.css') }}">
        @vite(['resources/scss/app.scss'])
        @include('layouts.components.styles')
        @yield('styles')
    </head>
    <body class="d-flex">
        @include('layouts.components.loader')
        <div class="navigation-contents">
            @include('layouts.sidebar.sidebar')
            @include('layouts.header.header')
        </div>
        <div class="main-content-wrapper" id="main-content-wrapper">
            <main>
                @yield('content')
                @yield('modal')
                @include('sweetalert::alert')
            </main>
        </div>
        <div class="page-up-button-container" id="page-up-button">
            <span class="page-up-button" onclick="pageGoUp()">
                <i class="fa-solid fa-chevron-up"></i>
            </span>

        </div>
    </body>

    @vite(['resources/js/app.js'])
    @include('layouts.components.scripts')
    <script src="{{ asset('assets/js/navigation.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar.js') }}"></script>
    @yield('scripts')
</html>
