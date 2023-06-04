@extends('admin.layout.adminMasterAddNew')

@section('title', 'Add New Movie')

@section('content')

    {{-- Add New Movie --}}
    <h3 class=" text-info text-center mb-5">Add New Movie Form</h3>

    <form action="{{ route('admin#create#movie') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="movieTitle" name="movieTitle" placeholder="Movie Title"
                        value="{{ old('movieTitle') }}">
                    <label for="movieTitle">Title</label>
                    @error('movieTitle')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea name="movieDes" id="movieDes" class=" form-control" placeholder="Movie Description">{{ old('movieDes') }}</textarea>
                    <label for="movieDes">Description</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="movieYear" name="movieYear" placeholder="Movie Year"
                        value="{{ old('movieYear') }}">
                    <label for="movieYear">Year</label>
                    @error('movieYear')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="movieRating" name="movieRating"
                        placeholder="Movie Rating" value="{{ old('movieRating') }}">
                    <label for="movieRating">Rating</label>
                    @error('movieRating')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

            </div>

            <div class="col-lg-4 col-md-6">
                <div class=" mb-3">
                    <input class="form-control form-control" id="animeImage" name="movieImage" type="file">
                    @error('movieImage')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3">
                    <img src="#" class=" img-fluid w-100 rounded" id="previewImage" alt="">
                </div>
            </div>

            <div class="col-lg-4 col-md-6">

                <button class="btn btn-info form-control" type="button" id="genreBtn">Choose Genre</button>
                @error('animeGenres')
                    <strong class=" text-danger fw-bold">{{ $message }}</strong>
                @enderror

                <div class="container mb-3 mt-5 " id="genreDiv">
                    @foreach ($genres as $genre)
                        <div class="form-check form-check-inline mb-4 me-4">
                            <input class="form-check-input genresCheck" type="checkbox" id="{{ $genre->name }}"
                                name="{{ $genre->name }}" value="{{ $genre->name }}" style="cursor: pointer">
                            <label class="form-check-label text-light" for="{{ $genre->name }}"
                                style="cursor: pointer">{{ $genre->name }}</label>
                        </div>
                    @endforeach
                    <input type="text" name="animeGenres" class="form-control genresHidden" hidden>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <input type="submit" value="Add" class=" form-control btn btn-info">
        </div>

    </form>

    {{-- Message --}}

    @if (session('Message'))
        <div class="alert alert-success alert-dismissible fade show me-5 mb-5" role="alert" id="alertBox">
            <strong>{{ session('Message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

@endsection
