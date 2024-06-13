@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
            <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
            <li class="breadcrumb-item"><a href="{{ route('artist.index') }}" class="text-decoration-none"><small>Artist</small></a></li>
            <li class="breadcrumb-item active"><a href="{{ route('artist.show', $artist->id) }}" class="text-decoration-none"><small>{{ $artist->name }} Overview</small></a></li>
        </ol>
    </div>
    <h3 class="m-0">Artist</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endsection

@section('content')
    <div class="content-section">
        <h3 class="mb-3 fw-bold">{{ $artist->name }} Overview</h3>
        <div class="row">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="dashboard-counter shadow-sm bg-white px-4 d-flex">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="align-self-center">
                            <h6 class="display-5 mb-0 fw-bold text-primary-custom">{{ number_format($artist->album->sum('sales'),2, '.', ',') }}</h6>
                            <span class="text-muted">Total Sales</span>
                        </div>
                        <div class="display-4 align-self-center text-primary-custom">
                            <i class="fa-solid fa-sack-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-4 col-12">
                <div class="dashboard-counter shadow-sm bg-white px-4 d-flex">
                    <div class="d-flex justify-content-between flex-grow-1">
                        <div class="align-self-center">
                            <h6 class="display-5 mb-0 fw-bold text-primary-custom">{{ number_format($artist->album->count()) }}</h6>
                            <span class="text-muted">Total Albums</span>
                        </div>
                        <div class="display-4 align-self-center text-primary-custom">
                            <i class="fa-solid fa-compact-disc"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h4 class="mb-3">List of Albums</h4>
        <div class="table-controls d-flex justify-content-end mb-3">
            <div class="d-flex justify-content-end align-self-end">
                <div class="me-2">
                    <form action="{{ route('artist.show', $artist->id) }}" method="GET">
                        <div class="btn-group">
                            <input type="text" class="form-control" placeholder="Quick Search" name="search">
                            <button type="submit" class="btn btn-primary-custom text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="align-self-center">
                    <a href="{{ route('artist.create') }}" class="btn btn-primary-custom text-white">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Album
                    </a>

                    <a href="{{ route('artist.edit', $artist->id) }}" class="btn btn-primary-custom text-white ms-2">
                        <i class="fa-solid fa-pen-to-square me-2"> </i>
                        Edit Artist
                    </a>
                </div>
            </div>
        </div>



        <div class="table-container">
            <table class="table table-borderless mb-2 w-100">
                <thead class="" >
                    <tr>
                        <th>Album Name</th>
                        <th>Total Sales</th>
                        <th>Date Released</th>
                        <th>Last Updated</th>
                        <th class="px-5 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($albumCount)
                        @forelse ($albums as $album )
                            <tr>
                                <td>{{ $album->name }}</td>
                                <td>{{ number_format($album->sales, 2,'.', ',') }}</td>
                                <td>{{ date('F d, Y', strtotime($album->date_released)) }}</td>
                                <td>{{ date('F d, Y', strtotime($album->last_updated)) }}</td>
                                <td class="fit-to-cell">
                                    <div class="d-flex justify-content-center fs-5">
                                        <a href="{{ route('artist.edit', $album->id) }}" class="text-dark ms-3" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"> </i>
                                        </a>

                                        <a href="" class="text-dark ms-3" title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    No results on "<b>{{ $search }}</b>"
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="4" class="text-center">
                                No Data Available
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

        </div>

        <div class="">
            {{ $albums->links() }}
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
