<div>
    <div class="d-flex justify-content-center py-3">
        <div class="border account-registration-container shadow-sm border rounded-3 bg-white p-4 col-sxl-3 col-xxl-4 col-xl-4 col-md-4 col-11">
            <div class="d-flex justify-content-center mb-3">
                <img src="{{ asset('assets/images/logo/laravel-full-logo.png') }}" class="col-md-10 col-11">
            </div>
            <h1 class="text-center h2 fw-semibold">Forgot Password</h1>
            <p class="">Enter the <b>email address</b> or <b>username</b> of your account and we'll send you a link to reset your password.</p>
            @error('manyTries')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            @if($confirmation)
                <div class="alert alert-success">
                    The reset password link was sent to email of your account.
                </div>
            @endif

            <form wire:submit.prevent='submitForm' class="mb-3">
                <div class="form-group mb-3">
                    <div class="form-floating">
                        <input class="form-control" id="email" placeholder="Email" type="text" wire:model='email' >
                        <label >Email/Username</label>
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary-custom text-white w-100 btn-lg">Continue</button>
            </form>

            <div class="text-center">
                <a href="{{ url('/') }}" class="link-primary-custom">Go back to Login</a>
            </div>
        </div>
    </div>
</div>
