@extends('layouts.guest')

@section('styles')

@endsection

@section('content')
    <div class="content-section center-container">
        <div class="centered-container" style="height: 300px">
            @livewire('forgot-password.reset', [
                'forgotPassword' => $forgotPassword
            ])
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
