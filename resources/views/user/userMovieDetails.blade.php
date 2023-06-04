@extends('user.layout.userMasterHomepage')

@section('title', $anime->title)

@section('content')

    {{-- Movie Details --}}

    <div class="row mb-5">
        <div class="col-lg-5 offset-lg-1 col-md-6">
            @if ($anime->image == null)
                <img src="{{ asset('image/default_anime_poster.jpg') }}" alt="" class=" img-fluid rounded">
            @else
                <img src="{{ asset('storage/' . $anime->image) }}" alt="" class=" img-fluid w-100 rounded">
            @endif
        </div>

        <div class="col-lg-5 col-md-6">
            <div class="row mt-3">
                <h3 class=" text-light fw-bold text-decoration-underline text-center">{{ $anime->title }}</h3>
            </div>

            <div class="row mt-5">
                @if ($anime->description == null)
                    <h3 class=" text-danger text-center mb-5">No description here</h3>
                @else
                    <p class=" text-light fs-5">{{ $anime->description }}</p>
                @endif
            </div>

            <div class="row mt-3">

                <h5 class=" text-light mb-4">Genre: <span class=" text-info">{{ $anime->genre }}</span></h5>
                <h5 class=" text-light mb-4">Rating: <span class=" text-info">{{ $anime->rating }}/10</span></h5>
                <h5 class=" text-light mb-4">Released: <span class=" text-info">{{ $anime->year }}</span></h5>
                </h5>
            </div>

            <div class="row mt-3">
                <a href="{{ route('user#movie#watch', $anime->id) }}">
                    <button class=" btn btn-outline-success w-100 py-3 fs-5 fw-bold">watch now</button>
                </a>
            </div>

            {{-- Bookmark Movie --}}

            <div class="row mt-3">
                @if ($animeNames == null)
                    <form action="{{ route('user#anime#bookmark#add') }}" method="post">
                        @csrf
                        <input type="text" name="animeName" hidden value="{{ $anime->title }},">
                        <button type="submit" class="btn btn-outline-warning form-control py-3 fs-5">
                            bookmark this movie
                        </button>
                    </form>
                @else
                    @if (in_array($anime->title, $animeNames))
                        <form action="{{ route('user#anime#bookmark#remove') }}" method="post">
                            @csrf
                            <input type="text" name="animeName" hidden value="{{ $anime->title }},">
                            <button type="submit" class="btn btn-outline-danger form-control py-3 fs-5">
                                remove this movie from bookmark
                            </button>
                        </form>
                    @else
                        <form action="{{ route('user#anime#bookmark#add') }}" method="post">
                            @csrf
                            <input type="text" name="animeName" hidden value="{{ $anime->title }},">
                            <button type="submit" class="btn btn-outline-warning form-control py-3 fs-5">
                                bookmark this movie
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

    {{-- Recommendation --}}

    @if (count($recoms) != 0)
        <h3 class=" text-warning my-5">You may also like</h3>

        <div class="row mb-5">
            <div class="col-8 offset-2">
                <div class="row">
                    @foreach ($recoms as $recom)
                        <div class="col-lg-4 col-md-6 col-6 ">

                            <a href="{{ route('user#movie#details', $recom->id) }}" class=" text-decoration-none">
                                <div class="card bg-dark p-lg-3 animeCard">
                                    @if ($recom->image == null)
                                        <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                            class="rounded animeImage2">
                                    @else
                                        <img src="{{ asset('storage/' . $recom->image) }}" class="rounded animeImage2">
                                    @endif
                                    <div class="card-body">
                                        <p class="card-title text-light text-center animeTitle">{{ $recom->title }}
                                        </p>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    @endif


@endsection
