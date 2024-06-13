@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
        <li class="breadcrumb-item active"><a href="" class="text-decoration-none"><small>Active Link</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Active Link</h3>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="content-section">

        <div class="row gy-4">
            <div class="col-xxl-3 col-xl-4 col-md-4 col-12">
                <div class="dashboard-counter shadow-sm bg-white px-4 d-flex">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="align-self-center">
                            <h6 class="display-5 mb-0 fw-bold text-primary-custom">99,999</h6>
                            <span class="text-muted">Total Users</span>
                        </div>
                        <div class="display-4 align-self-center text-primary-custom">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-md-4 col-12">
                <div class="dashboard-counter shadow-sm bg-primary-custom px-4 d-flex">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="align-self-center">
                            <h6 class="display-5 mb-0 fw-bold text-white">99,999</h6>
                            <span class="text-white">Total Users</span>
                        </div>
                        <div class="display-4 align-self-center text-white">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
