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
        {{-- @livewire('dashboard') --}}
        <div class="row">
            <div class="col-3">
                <div class="bg-white p-3 shadow-sm border rounded-3">
                    <h5 class="fw-bold">PHP Test</h5>
                    <ol>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Shortest Word</a></li>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Count the  Islands</a></li>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Word Search</a></li>
                    </ol>
                </div>
            </div>

            <div class="col-3">
                <div class="bg-white p-3 shadow-sm border rounded-3">
                    <h5 class="fw-bold">Mysql Test</h5>
                    <ol>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Shortest Word</a></li>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Count the  Islands</a></li>
                        <li><a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">Word Search</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
