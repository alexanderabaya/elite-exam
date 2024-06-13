@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
        <li class="breadcrumb-item active"><a href="{{ route('artist.index') }}" class="text-decoration-none"><small>Artist</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Artist</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endsection

@section('content')
    <div class="content-section">
        <h4 class="mb-3">List of Artist</h4>
        <div class="table-controls d-flex justify-content-end mb-3">
            <div class="d-flex justify-content-end align-self-end">
                <div class="me-2">
                    <form action="{{ route('artist.index') }}" method="GET">
                        <div class="btn-group">
                            <input type="text" class="form-control" placeholder="Quick Search" name="search">
                            <button type="submit" class="btn btn-primary-custom text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="align-self-center">
                    <a href="{{ route('artist.create') }}" class="btn btn-primary-custom text-white">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Artist
                    </a>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-4 col-md-4 col-12">
                <div class="dashboard-counter shadow-sm bg-white p-3">
                    <span class="text-muted d-block">Top Selling Artist</span>
                    <a href="{{ route('artist.show', $topArtist->id) }}" class="link-primary-custom fs-3 fw-bold text-decoration-none mb-0">
                        {{ $topArtist->name }}
                    </a>
                    <span class="d-block fs-1 fw-bold lh-1">
                        {{ number_format($topArtist->album_sum_sales,2, '.', ',') }}
                    </span>

                </div>
            </div>
        </div>



        <div class="table-container">
            <table class="table table-borderless mb-2 w-100">
                <thead class="" >
                    <tr>
                        <th>Artist Name</th>
                        <th>No. of Albums</th>
                        <th>Total Sales</th>
                        <th class="px-5 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($artistCount)
                        @forelse ($artists as $artist )
                            <tr>
                                <td>{{ $artist->name }}</td>
                                <td>{{ $artist->album->count() }} {{ $artist->album->count() > 1 ? 'albums' : 'album' }}</td>
                                <td>{{ number_format($artist->album->sum('sales'), 2,'.', ',') }}</td>
                                <td class="fit-to-cell">
                                    <div class="d-flex justify-content-center fs-5">
                                        <a href="{{ route('artist.show', $artist->id) }}" class="text-dark" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{ route('artist.edit', $artist->id) }}" class="text-dark ms-3" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"> </i>
                                        </a>

                                        <button type="button" class="text-dark ms-3" title="Delete" data-bs-toggle="modal" data-bs-target="#delete-artist"
                                            data-id="{{ $artist->id }}"
                                            data-name="{{ $artist->name }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
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
            {{ $artists->links() }}
        </div>
    </div>
    @include('artist.modals.delete-artist')
@endsection

@section('scripts')
    <script>
        $('#delete-artist').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            $('#artist-id-input').val(id);
            $('#artist-name').text(name);
        });

        $('#delete-artist').on('hide.bs.modal', function (event) {
            $('#artist-id-input').val("");
            $('#artist-name').text("");
        });

    </script>
@endsection
