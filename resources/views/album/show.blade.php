@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
            <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
            <li class="breadcrumb-item"><a href="{{ route('album.index') }}" class="text-decoration-none"><small>Albums</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('album.show', $album->id) }}" class="text-decoration-none"><small>{{ $album->name }} Overview</small></a></li>
        </ol>
    </div>
    <h3 class="m-0">Albums</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endsection

@section('content')
    <div class="content-section">
        <div class="bg-white rounded p-4 shadow-sm ">
            <h3 class="mb-3 fw-bold">{{ $album->name }} Overview</h3>

            <div class="row">
                <div class="col-2">
                    <div>
                        @if($album->image)
                            <img class="w-100 border" src="{{ asset('database-image/album-image/'.$album->image)}}" alt="">
                        @else
                            <img class="w-100 border" src="{{ asset('assets/images/album.png')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-8">
                    <div class="d-flex mb-3">
                        <span class="col-2 fw-semibold">
                            Album Name:
                        </span>
                        <span class="">
                            {{ $album->name }}
                        </span>
                    </div>

                    <div class="d-flex mb-3">
                        <span class="col-2 fw-semibold">
                            Artist:
                        </span>
                        <span class="">
                            {{ $album->artist->name}}
                        </span>
                    </div>

                    <div class="d-flex mb-3">
                        <span class="col-2 fw-semibold">
                            Total Sales:
                        </span>
                        <span class="">
                            {{ number_format($album->sales, 2, '.', ',')}}
                        </span>
                    </div>

                    <div class="d-flex mb-3">
                        <span class="col-2 fw-semibold">
                            Date Released:
                        </span>
                        <span class="">
                            {{ date('F d, Y', strtotime($album->date_released)) }}
                        </span>
                    </div>

                    <div class="d-flex mb-3">
                        <span class="col-2 fw-semibold">
                            Last Update:
                        </span>
                        <span class="">
                            {{ date('F d, Y', strtotime($album->last_update)) }}
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
