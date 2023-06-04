@extends('admin.layout.adminMasterVIew')

@section('title', 'Admin Movie View Page')

@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('admin#movie#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Edit Movie --}}

    <div class="row my-5">

        <div class="col-lg-5 offset-lg-1 col-md-6 mt-5 ">
            @if ($movie->image == null)
                <img src="{{ asset('image/default_anime_poster.jpg') }}" class=" d-block mx-auto img-fluid rounded ">
            @else
                <img src="{{ asset('storage/' . $movie->image) }}" class=" d-block mx-auto img-fluid rounded w-100">
            @endif

        </div>

        <div class="col-lg-5 col-md-6 mt-5">
            <form
                @if ($movie->image == null) action="{{ route('admin#movie#home#update', ['image' => 'image']) }}"
            @else
                action="{{ route('admin#movie#home#update', $movie->image) }}" @endif
                method="post" enctype="multipart/form-data">
                @csrf

                <input type="number" name="movieId" value="{{ $movie->id }}" hidden>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="movieTitle" name="movieTitle"
                        value="{{ $movie->title }}">
                    <label for="movieTitle">Title</label>
                    @error('movieTitle')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea name="movieDes" id="movieDes" class="form-control" style="height:200px">{{ $movie->description }}</textarea>
                    <label for="movieDes">Description</label>
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
                        value="{{ $movie->genre }}" hidden>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="movieYear" name="movieYear" value="{{ $movie->year }}">
                    <label for="movieYear">Year</label>
                    @error('movieYear')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="movieRating" name="movieRating"
                        value="{{ $movie->rating }}">
                    <label for="movieRating">Rating</label>
                    @error('movieRating')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="my-3">

                    <label for="movieImage" class=" text-light mb-3">Edit image </label>
                    <input class="form-control form-control" id="animeImage" name="movieImage" type="file">
                    @error('movieImage')
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
