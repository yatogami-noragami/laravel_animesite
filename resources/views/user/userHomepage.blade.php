@extends('user.layout.userMasterHomepage')

@section('title', 'Homepage')

@section('content')

    {{-- Homepage --}}

    <section>

        {{-- Sortings --}}

        <div class="row mb-3">
            <div class=" d-flex offset-1">
                <a href="{{ route('user#home#name#sort') }}" class=" text-decoration-none">
                    <button class=" btn btn-warning ms-1">sort by name</button>
                </a>

                <a href="#!" class=" text-decoration-none" id="homegenrebtn">
                    <button class=" btn btn-warning ms-1">sort by genre</button>
                </a>

            </div>

        </div>

        <div class="row my-3" id="homegenre">
            @if ($genres)
                <div class="col-lg-8 offset-lg-2 d-flex flex-wrap">
                    @foreach ($genres as $genre)
                        <a href="{{ route('user#home#genre#sort', $genre->name) }}"
                            class=" text-decoration-none text-warning me-4 mb-4 fw-bold">{{ $genre->name }}</a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Home --}}

        <div class="row ">
            @if (count($episodes) == 0)
                <h1 class=" text-danger text-center">No data here</h1>
            @else
                <div class="col-lg-10 offset-lg-1 borderDGR rounded">
                    <div class="row p-4">
                        @foreach ($episodes as $episode)
                            <div class="col-lg-3 col-md-4 col-6 ">
                                <a href="{{ route('user#anime#watch', ['id' => $episode->id, 'epid' => $episode->episode_number]) }}"
                                    class=" text-decoration-none">
                                    <div class="card bg-dark p-md-3 animeCard">
                                        @if ($episode->image == null)
                                            <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                                class="rounded animeImage">
                                        @else
                                            <img src="{{ asset('storage/' . $episode->image) }}" class="rounded animeImage">
                                        @endif
                                        <div class="card-body">
                                            <h6 class="card-title text-light text-center animeTitle">{{ $episode->title }}
                                            </h6>
                                            <p class=" text-light text-center">Ep {{ $episode->episode_number }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach


                    </div>
                </div>
            @endif
        </div>

        {{-- Pagination --}}

        <div class="row">
            <div class="d-flex justify-content-center">
                {{ $episodes->links() }}
            </div>
        </div>
    </section>
@endsection
