@extends('layouts.app')

@section('header')
    <div aria-label="breadcrumb">
        <ol class="breadcrumb  mb-1">
        <li class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}" class="text-decoration-none"><small>Dashboard</small></a></li>
        </ol>
    </div>
    <h3 class="m-0" >Dashboard</h3>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="content-section">
        {{-- @livewire('dashboard') --}}
        <div class="bg-white p-3 shadow-sm border rounded-3">
            <div class="mb-3">
                <h5 class="fw-bold">PHP Test</h5>
                <ol>
                    <li>
                        <a href="{{ route('php-test.shortest-word') }}" class="link-primary-custom" target="_blank">
                            Shortest Word
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('php-test.count-the-islands') }}" class="link-primary-custom" target="_blank">
                            Count the  Islands
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('php-test.word-search') }}" class="link-primary-custom" target="_blank">
                            Word Search
                        </a>
                    </li>
                </ol>
            </div>

            <div class="mb-3">
                <h5 class="fw-bold">Mysql Test</h5>
                <ol>
                    <li>
                        <a href="{{ route('mysql-test.albums-sold-per-artist') }}" class="link-primary-custom" target="_blank">
                            Display total number of albums sold per artist
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mysql-test.combined-album-sales-per-artist') }}" class="link-primary-custom" target="_blank">
                            Display combined album sales per artist
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mysql-test.top-one-artist') }}" class="link-primary-custom" target="_blank">
                            Display the top 1 artist who sold most combined album sales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mysql-test.top-ten-albums-per-year') }}" class="link-primary-custom" target="_blank">
                            Display the top 10 albums per year based on their number of sales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('php-test.album-search-by-artist') }}" class="link-primary-custom" target="_blank">
                            Display list of albums based on the searched artist
                        </a>
                    </li>
                </ol>
            </div>

            <div class="mb-3">
                <h5 class="fw-bold">Laravel Test</h5>
                <ol>
                    <li>
                        <a href="{{ route('artist.index') }}" class="link-primary-custom" target="_blank">
                            Artist CRUD
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mysql-test.combined-album-sales-per-artist') }}" class="link-primary-custom" target="_blank">
                            Album CRUD
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('artist.index') }}" class="link-primary-custom" target="_blank">
                            Display total number of albums sold per artist
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('artist.index') }}" class="link-primary-custom" target="_blank">
                            Display combined album sales per artist
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('artist.index') }}" class="link-primary-custom" target="_blank">
                            Display the top 1 artist who sold most combined album sales
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('album.index') }}" class="link-primary-custom" target="_blank">
                            Display list of albums based on the searched artist
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @stack('scripts')
@endsection
