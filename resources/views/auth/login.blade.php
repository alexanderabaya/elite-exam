@extends('layouts.guest')

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
@endsection

@section('content')
<div class="login-container">
  <div class="position-relative w-100  vh-100">
    <div class="col-sxl-3 col-xl-4 col-md-4 col-11
      bg-white position-absolute top-50 start-50 translate-middle p-4 shadow-sm rounded border">

        <form method="POST" action="{{ route('login') }}">
          @csrf
          <div class="d-flex justify-content-center mb-3">
            <img src="{{ asset('assets/images/logo/laravel-full-logo.png') }}" class="col-10" alt="">
          </div>

          <div class="h3 fw-semibold mb-1 text-center text-primary-custom">Login</div>
          <p class="m-0 text-center text-muted mb-3">Sign in your account</p>

          <div class="form-floating mb-3">
            <input class="form-control" id="email" placeholder="Email" type="text" name="identity" value="{{ old('identity') }}" required autofocus autocomplete="username" >
            <label >Email/Username</label>
          </div>

          <div class="form-floating mb-3">
            <input class="form-control" placeholder="Password" type="password" name="password" required autocomplete="current-password" >
            <label>Password</label>
          </div>

          <div class="form-group mb-4">
            <label class="check-box"> Remember me
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} >
                <span class="checkmark"></span>
            </label>
          </div>

          <button type="submit" class="btn btn-primary-custom text-white fw-bold w-100 py-3 h5">
            LOGIN
          </button>

          @if ($errors->any())
          <div class="text-center">
            {{-- <div class="text-danger h5 mt-3">{{ __('Whoops! Something went wrong.') }}</div> --}}

            <ul class="text-danger list-style-none ps-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
        @endif

          <div class="text-center mt-2">
            <a href="{{ route('guest.forgot-password.index') }}" class="text-primary-custom">Forgot Password ?</a>
          </div>

        </form>
    </div>
  </div>
</div>
@endsection
