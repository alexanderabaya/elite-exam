@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
            <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
            <li class="breadcrumb-item"><a href="{{ route('album.index') }}" class="text-decoration-none"><small>Albums</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('album.show', $album->id) }}" class="text-decoration-none"><small>{{ $album->name }} Overview</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('album.edit', $album->id) }}" class="text-decoration-none"><small>Edit {{ $album->name }}</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Albums</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/cropperjs/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/venobox/venobox.min.css') }}">
@endsection

@section('content')
    <div class="content-section">
        <div class="content-header mb-3">
            <h4 class="mb-0">Edit {{ $album->name }}</h4>
            <small class="text-muted">Please fill up the following:</small>
        </div>
        <div class="bg-white rounded p-4 shadow-sm ">
            <form action="{{ route('album.update', $album->id) }}" method="POST">
                @csrf
                <div class="col-sxl-7 col-xxl-8 col-xl-12 col-md-12 col-12 row">
                    <div class="mb-3">
                        <label for="" class="form-label">Artist <span class="text-danger">*</span></label>
                        <select class="form-select" name="artist" id="">
                            <option value="">Select an Artist</option>
                            @foreach ($artists as $item )
                                <option value="{{ $item->id }}" {{ old('artist', $album->artist_id) == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('artist')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Album Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Album Name" name="name" value="{{ old('name', $album->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Album Sales <span class="text-danger">*</span></label>
                        <input type="number" step="any" class="form-control" placeholder="Enter Album Sales" name="sales" value="{{ old('sales', $album->sales) }}">
                        @error('sales')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Date Released <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="dateReleased" value="{{ old('dateReleased', $album->date_released) }}">
                        @error('dateReleased')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        {{ $album->last_update }}
                        <label for="" class="form-label"> LastUpdate<span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="lastUpdate" value="{{ old('lastUpdate', $album->last_update) }}">
                        @error('lastUpdate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="mb-5">
                            <label for="" class="form-label">Album Image</label>
                            <div class="d-flex">
                                <label for="upload-image" class="custom-file-upload bg-primary-custom text-white align-self-enter">
                                    <i class="fa-regular fa-image"></i> <span class="ms-1" id="upload-ownership-txt" wire:ignore>Select Image</span>
                                    <input id="upload-image" type="file" class="custom-file-input"  onchange="uploadImage()" accept="image/png, image/jpeg"/>
                                </label>
                                <a class="btn bg-primary-custom text-white crop-result ms-2" href=""  id="uploaded-image" style="display: none" >
                                    <i class="fa-solid fa-image"></i> album-image.jpg
                                </a>
                            </div>
                            <input type="hidden" id="uploaded-image-input" name="image">
                            @error('image')
                                <span class="text-danger d-block"><small>{{ $message }}</small></span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn bg-primary-custom text-white">Submit</button>
                    </div>
                </div>

            </form>
        </div>
        @include('album.modals.crop-image')
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('assets/plugins/cropperjs/cropper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/venobox/venobox.min.js') }}"></script>
    <script>
        new VenoBox({
            selector: '.crop-result',
            numeration: true,
            infinigall: true,
            spinner: 'fold'
        });

        var imageCropModal = $('#crop-image');
        var imageCroppingArea = document.getElementById('image-cropping-area');
        var imageCropper;

        function uploadImage(){
            var fileInput =document.getElementById('upload-image');
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
        }

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

        function cropPhoto(){
            canvas = imageCropper.getCroppedCanvas({
                minWidth: 1280,
                minHeight: 720,
                maxWidth: 1280,
                maxHeight: 720,
            });

            preview = imageCropper.getCroppedCanvas({
                minWidth: 1280,
                minHeight: 720,
                maxWidth: 1280,
                maxHeight: 720,
            });
            $('#uploaded-image').attr('href', canvas.toDataURL("image/png") );
            $('#uploaded-image').show();
            //for summary tab
            imageCropModal.modal('hide');
            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $('#uploaded-image-input').val(base64data)

                }
            });
        }
    </script>
@endsection
