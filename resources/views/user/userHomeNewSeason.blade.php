@extends('user.layout.userMasterHomepage')

@section('title', 'Homepage New Season')

@section('content')

    {{-- uNew Season Homepage --}}
    <section>

        {{-- Sortings --}}

        <div class="row mb-3">
            <div class="d-flex offset-1">
                <a href="{{ route('user#new#season#name#sort') }}" class=" text-decoration-none">
                    <button class=" btn btn-warning ms-1">sort by name</button>
                </a>

                <a href="#!" class=" text-decoration-none" id="newseasongenrebtn">
                    <button class=" btn btn-warning ms-1">sort by genre</button>
                </a>

            </div>

        </div>
        <div class="row my-3" id="newseasongenre">
            @if ($genres)
                <div class="col-lg-8 offset-lg-2 d-flex flex-wrap">
                    @foreach ($genres as $genre)
                        <a href="{{ route('user#new#season#genre#sort', $genre->name) }}"
                            class=" text-decoration-none text-warning me-4 mb-4 fw-bold">{{ $genre->name }}</a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- New Season --}}

        <div class="row ">
            @if (count($animes) == 0)
                <h1 class=" text-danger text-center">No data here</h1>
            @else
                <div class="col-lg-10 offset-lg-1 borderDGR rounded" id="temp">
                    <div class="row p-4">
                        @foreach ($animes as $anime)
                            <div class="col-lg-3 col-md-4 col-6">
                                <a href="{{ route('user#anime#details', $anime->id) }}" class=" text-decoration-none">
                                    <div class="card bg-dark p-md-3 animeCard">
                                        @if ($anime->image == null)
                                            <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                                class="rounded animeImage">
                                        @else
                                            <img src="{{ asset('storage/' . $anime->image) }}" class="rounded animeImage">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title text-light text-center animeTitle">{{ $anime->title }}
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        {{-- Pagination --}}

                        <div class="">
                            {{ $animes->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
