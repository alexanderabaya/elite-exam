<div>
    <div class="row mb-4">
        <div class="col-4">
            <h6 class="fw-semibold h4 mb-0">Profile Information</h6>
            <small>update your account's profile information and email address.</small>
        </div>

        <div class="col-8">
            <div class="bg-white shadow-sm rounded-3 border py-4 px-5">
                <div>
                    <label class="h5 mb-3">Avatar</label>
                    <div class="d-flex mb-3">
                        <div class="border rounded-circle overflow-hidden me-4" style="height: 100px;width:100px;">
                            @if ($this->user->profile_photo_path)
                                <img src="{{ asset('database-image/profile-image/'.$this->user->profile_photo_path) }}" alt="" class="w-100">
                            @else
                                <img src="{{ asset('assets/images/user.png') }}" alt="" class="w-100">
                            @endif
                        </div>
                        <div class="d-flex">
                            <div class="align-self-center">
                                <label for="upload-photo" class="custom-file-upload bg-primary-custom text-white align-self-enter">
                                    <i class="fa-regular fa-image"></i> <span class="ms-1" id="upload-ownership-txt" wire:ignore>Select Image</span>
                                    <input id="upload-photo" type="file" class="custom-file-input" wire:model="imageData" wire:change="uploadImage()" accept="image/png, image/jpeg"/>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <form wire:submit.prevent='updateProfile'>
                    <div class="mb-3 col-9">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" wire:model="name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-9">
                        <label for="" class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Enter Userame" wire:model="username" name="username">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-9">
                        <label for="" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Enter Company Name" wire:model="email" name="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary-custom text-white px-4">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <h6 class="fw-semibold h4 mb-0">Change Password</h6>
            <small>Ensure your account by using a long and random password to stay secure.</small>
        </div>

        <div class="col-8">
            <div class="bg-white shadow-sm rounded-3 border py-4 px-5">
                <form wire:submit.prevent='updatePassword'>
                    <div class="mb-3 col-9">
                        <label for="" class="form-label">Current Password</label>
                        <x-password-input class="form-control" placeholder="Enter Current Password" wire:model="currentPassword" />
                        @error('currentPassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-9">
                        <label for="" class="form-label">New Password</label>
                        <x-password-input class="form-control" placeholder="Enter New Password" wire:model="newPassword" />
                        @error('newPassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-9">
                        <label for="" class="form-label">Confirm Password</label>
                        <x-password-input class="form-control" placeholder="Enter Confirm Password" wire:model="confirmPassword" />
                        @error('confirmPassword')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary-custom text-white px-4">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @include('livewire.profile.modals.crop-image-modal')
</div>

@push('scripts')
    <script>
        var imageCropModal = $('#crop-image-modal');
        var imageCroppingArea = document.getElementById('image-cropping-area');
        var imageCropper;

        window.addEventListener('uploadImage', event => {
            var fileInput =document.getElementById('upload-photo');
            var files = fileInput.files;
            var done = function (url) {
                imageCroppingArea.src = url;
                imageCropModal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                done(reader.result);
                };
                reader.readAsDataURL(file);
            }
            }
        });

        imageCropModal.on('shown.bs.modal', function () {
            imageCropper = new Cropper(imageCroppingArea, {
                dragMode: 'move',
                aspectRatio:1/1,
                restore: false,
                guides: true,
                center: true,
                highlight: true,
                // cropBoxMovable: false,
                // cropBoxResizable: false,
                toggleDragModeOnDblclick: false,
                // preview: '.preview-upload-id'
            });
        }).on('hidden.bs.modal', function () {
            imageCropper.destroy();
            imageCropper = null;
        });

        //crop function
        window.addEventListener('cropPhoto', event => {
            canvas = imageCropper.getCroppedCanvas({
                minWidth: 0,
                minHeight: 0,
                maxWidth: 1280,
                maxHeight: 720,
            });

            preview = imageCropper.getCroppedCanvas({
                minWidth: 0,
                minHeight: 0,
                maxWidth: 1280,
                maxHeight: 720,
            });
            //for summary tab
            imageCropModal.modal('hide');
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    @this.set('image', base64data);
                    @this.updateAvatar();
                }
            });


        });
    </script>
@endpush
