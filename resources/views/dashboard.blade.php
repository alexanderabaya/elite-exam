@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Dashboard</h3>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="content-section">
        @livewire('dashboard')
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
