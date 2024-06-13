<div>
    <div class="d-flex justify-content-center py-3">
        <div class="border account-registration-container shadow-sm border rounded-3 bg-white p-4 col-sxl-3 col-xxl-4 col-xl-4 col-md-4 col-11">
            <div class="d-flex justify-content-center mb-3">
                <img src="{{ asset('assets/images/logo/laravel-full-logo.png') }}" class="col-md-10 col-11">
            </div>
            <h1 class="text-center h2 fw-semibold">Reset Password</h1>
            <p class="text-center">Please enter a new strong password.</p>

            <form wire:submit.prevent='submitForm'>
                <div class="form-group mb-3">
                    <div class="form-floating">
                        <input class="form-control" placeholder="Password" type="password" wire:model='newPassword' >
                        <label >New Password</label>
                    </div>
                    @error('newPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="form-floating">
                        <input class="form-control" placeholder="Password" type="password" wire:model='confirmPassword' >
                        <label >Confirm Password</label>
                    </div>
                    @error('confirmPassword')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary-custom text-white w-100 btn-lg">Submit</button>
            </form>
        </div>
    </div>
</div>
