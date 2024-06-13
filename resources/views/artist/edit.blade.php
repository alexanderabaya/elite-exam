@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
            <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
            <li class="breadcrumb-item"><a href="{{ route('artist.index') }}" class="text-decoration-none"><small>Artist</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('artist.show', $artist->id) }}" class="text-decoration-none"><small>{{ $artist->name }} Overview</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('artist.edit', $artist->id) }}" class="text-decoration-none"><small>Edit {{ $artist->name }}</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Artist</h3>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="content-section">
        <div class="content-header mb-3">
            <h4 class="mb-0">Edit {{ $artist->name }}</h4>
            <small class="text-muted">Please fill up the following:</small>
        </div>
        <div class="bg-white rounded p-4 shadow-sm ">
            <form action="{{ route('artist.update', $artist->id) }}" method="POST">
                @csrf
                <div class="col-sxl-7 col-xxl-8 col-xl-12 col-md-12 col-12 row">
                    <div class="mb-3">
                        <label for="" class="form-label">Artist Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Artist Code" name="code" value="{{ $artist->code }}" autofocus>
                        @error('code')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Artist Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Artist Name" name="name" value="{{ $artist->name }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn bg-primary-custom text-white">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
