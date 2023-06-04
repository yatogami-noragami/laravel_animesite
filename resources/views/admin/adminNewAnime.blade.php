@extends('admin.layout.adminMasterAddNew')

@section('title', 'Add New Anime')

@section('content')

    {{-- Add New Anime --}}
    <h3 class=" text-info text-center mb-5">Add New Anime Form</h3>

    <form action="{{ route('admin#create#anime') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row ">
            <div class="col-lg-4 col-md-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="animeTitle" name="animeTitle" placeholder="Anime Title"
                        value="{{ old('animeTitle') }}">
                    <label for="animeTitle">Title</label>
                    @error('animeTitle')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea name="animeDes" id="animeDes" class=" form-control" placeholder="Anime Description">{{ old('animeDes') }}</textarea>
                    <label for="animeDes">Description</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeYear" name="animeYear" placeholder="Anime Year"
                        value="{{ old('animeYear') }}">
                    <label for="animeYear">Year</label>
                    @error('animeYear')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeRating" name="animeRating"
                        placeholder="Anime Rating" value="{{ old('animeRating') }}">
                    <label for="animeRating">Rating</label>
                    @error('animeRating')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="animeEpisode" name="animeEpisode"
                        placeholder="Anime Episode" value="{{ old('animeEpisode') }}">
                    <label for="animeEpisode">Episode</label>
                    @error('animeEpisode')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class=" mb-3">
                    <input class="form-control form-control" id="animeImage" name="animeImage" type="file">
                    @error('animeImage')
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
