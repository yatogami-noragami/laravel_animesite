@extends('admin.layout.adminMasterVIew')

@section('title', 'Admin Anime View Page')

@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('admin#anime#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Anime Details --}}

    <div class="row my-5">

        <div class="col-lg-5 offset-lg-1 col-md-6 mt-5 ">
            @if ($anime->image == null)
                <img src="{{ asset('image/default_anime_poster.jpg') }}" class=" d-block mx-auto img-fluid rounded ">
            @else
                <img src="{{ asset('storage/' . $anime->image) }}" class=" d-block mx-auto img-fluid rounded w-100">
            @endif
        </div>

        <div class="col-lg-5 col-md-6 mt-5">
            <form
                @if ($anime->image == null) action="{{ route('admin#anime#home#update', ['image' => 'image']) }}"
            @else
                action="{{ route('admin#anime#home#update', $anime->image) }}" @endif
                method="post" enctype="multipart/form-data">
                @csrf

                <input type="number" name="animeId" value="{{ $anime->id }}" hidden>
                <input type="number" name="animePreEpisode" value="{{ $anime->available_episode }}" hidden>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="animeTitle" name="animeTitle"
                        value="{{ $anime->title }}">
                    <label for="animeTitle">Title</label>
                    @error('animeTitle')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea name="animeDes" id="animeDes" class="form-control" style="height:200px">{{ $anime->description }}</textarea>
                    <label for="animeDes">Description</label>
                </div>

                <div class="">
                    <button class="btn btn-info form-control my-4" type="button" id="genreBtn">Choose Genre</button>
                    @error('animeGenres')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror

                    <div class="" id="genreDiv">
                        @foreach ($genres as $genre)
                            <div class="form-check form-check-inline mb-4 me-4">
                                <input class="form-check-input genresCheck" type="checkbox" id="{{ $genre->name }}"
                                    name="{{ $genre->name }}" value="{{ $genre->name }}"
                                    @foreach ($genreArray as $ogGenre)
                                    @if ($ogGenre == $genre->name)
                                        checked
                                    @endif @endforeach
                                    style="cursor:pointer">
                                <label class="form-check-label text-light" style="cursor:pointer"
                                    for="{{ $genre->name }}">{{ $genre->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <input type="text" name="animeGenres" class="form-control genresHidden my-3"
                        value="{{ $anime->genre }}" hidden>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeYear" name="animeYear" value="{{ $anime->year }}">
                    <label for="animeYear">Year</label>
                    @error('animeYear')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeRating" name="animeRating"
                        value="{{ $anime->rating }}">
                    <label for="animeRating">Rating</label>
                    @error('animeRating')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeEpisode" name="animeEpisode"
                        value="{{ $anime->episode_count }}">
                    <label for="animeEpisode">Episode</label>
                    @error('animeEpisode')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="my-3">

                    <label for="animeImage" class=" text-light mb-3">Edit image </label>
                    <input class="form-control form-control" id="animeImage" name="animeImage" type="file">
                    @error('animeImage')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror

                    <img src="#" class=" img-fluid d-block mx-auto mt-4 w-100 rounded" id="previewImage"
                        alt="">
                </div>

                <div class="mb-3">
                    <input type="submit" value="Edit" class="btn btn-info form-control">
                </div>
            </form>
        </div>


    </div>
@endsection
