@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item "><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
        <li class="breadcrumb-item active"><a href="{{ route('album.index') }}" class="text-decoration-none"><small>Albums</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Albums</h3>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/table.css') }}">
@endsection

@section('content')
    <div class="content-section">
        <h4 class="mb-3">List of Albums</h4>
        <div class="table-controls d-flex justify-content-end mb-3">
            <div class="d-flex justify-content-end align-self-end">
                <div class="me-2">
                    <form action="{{ route('album.index') }}" method="GET">
                        <div class="btn-group">
                            <input type="text" class="form-control" placeholder="Quick Search" name="search">
                            <button type="submit" class="btn btn-primary-custom text-white"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="align-self-center">
                    <a href="{{ route('album.create') }}" class="btn btn-primary-custom text-white">
                        <i class="fa-solid fa-plus me-2"></i>
                        Add Album
                    </a>
                </div>
            </div>
        </div>



        <div class="table-container">
            <table class="table table-borderless mb-2 w-100">
                <thead class="" >
                    <tr>
                        <th>Album Name</th>
                        <th>Artist</th>
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
                                <td>
                                    <div class="user-data-container d-flex align-items-center">
                                        @if ($album->image)
                                            <img src="{{ asset('database-image/album-image/'.$album->image) }}" alt="">
                                        @else
                                            <img src="{{ asset('assets/images/album.png') }}" alt="">
                                        @endif
                                        <div class="user-data-content ms-2">
                                            <span class="user-data-name">{{ $album->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="user-data-container d-flex align-items-center">
                                        <img src="{{ asset('assets/images/user.png') }}" alt="">
                                        <div class="user-data-content ms-2">
                                            <span class="user-data-name">{{$album->artist->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($album->sales, 2,'.', ',') }}</td>
                                <td>{{ date('F d, Y', strtotime($album->date_released)) }}</td>
                                <td>{{ date('F d, Y', strtotime($album->last_update)) }}</td>
                                <td class="fit-to-cell">
                                    <div class="d-flex justify-content-center fs-5">
                                        <a href="{{ route('album.show', $album->id) }}" class="text-dark" title="View">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>

                                        <a href="{{ route('album.edit', $album->id) }}" class="text-dark ms-3" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"> </i>
                                        </a>

                                        <button type="button" class="text-dark ms-3" title="Delete" data-bs-toggle="modal" data-bs-target="#delete-album"
                                            data-id="{{ $album->id }}"
                                            data-name="{{ $album->name }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No results on "<b>{{ $search }}</b>"
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="6" class="text-center">
                                No Data Available
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="">
            {{ $albums->onEachSide(0)->links() }}
        </div>
        @include('album.modals.delete-album')
    </div>
@endsection

@section('scripts')
    @stack('scripts')

    <script>
        $('#delete-album').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var name = button.data('name')
            var modal = $(this)
            $('#album-id-input').val(id);
            $('#album-name').text(name);
        });

        $('#delete-album').on('hide.bs.modal', function (event) {
            $('#album-id-input').val("");
            $('#album-name').text("");
        });
    </script>
@endsection
