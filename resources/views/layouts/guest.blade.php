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
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/scss/app.scss', 'resources/js/app.js'])
        @include('layouts.components.styles')
        @yield('styles')
    </head>
    <body>
        @include('layouts.components.loader')
        @yield('content')
        @yield('modal')
        @include('sweetalert::alert')
    </body>

    @include('layouts.components.scripts')
    @yield('scripts')
</html>
