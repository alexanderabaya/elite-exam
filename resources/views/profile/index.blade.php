@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-muted text-decoration-none"><small>Dashboard</small></a></li>
        <li class="breadcrumb-item active"><a href="{{ route('profile.index') }}" class="text-decoration-none"><small>Profile</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Profile</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/cropperjs/cropper.min.css') }}">
@endsection

@section('content')
    <div class="content-section">
        @livewire('profile.index')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/plugins/cropperjs/cropper.min.js') }}"></script>
    @stack('scripts')
@endsection
