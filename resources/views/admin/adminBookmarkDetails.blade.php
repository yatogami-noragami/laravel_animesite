@extends('admin.layout.adminMasterVIew')

@section('title', 'Bookmark Details')

@section('content')
    {{-- Back Arrow --}}

    <a href="{{ route('admin#bookmark#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Bookmark Details --}}

    <div class="container mt-5 p-md-5">
        <h3 class=" text-light text-decoration-none fw-bold p-md-0 pt-5">User- <span
                class=" text-warning">{{ $userName }}</span>
        </h3>

        <div class="container p-md-5">
            <div class="row">

                <div class="col-lg-6 mt-3">
                    <div class="rounded border p-5">
                        <h3 class=" text-light mb-5">Anime</h3>
                        @foreach ($animeArray as $anime)
                            <div class="row mt-3">
                                <a href="{{ route('admin#anime#home#view', $anime->id) }}"
                                    class="btn btn-warning fw-bold">{{ $anime->title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 mt-3">
                    <div class="rounded border p-5">
                        <h3 class=" text-warning mb-5">Movie</h3>

                        @foreach ($movieArray as $movie)
                            <div class="row mt-3">
                                <a href="{{ route('admin#movie#home#view', $movie->id) }}"
                                    class="btn btn-light fw-bold">{{ $movie->title }}</a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
