@extends('admin.layout.adminMasterVIew')

@section('title', 'Add New Episode Page')

@section('content')

    {{-- Add New Episode --}}

    <a href="{{ route('admin#anime#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    <div class="row mt-5">
        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
            <div class="row mb-5">
                <form action="{{ route('admin#anime#home#episodeaddnew') }}" method="post">
                    @csrf

                    <input type="number" name="animeId" value="{{ $anime->id }}" hidden>
                    <input type="number" name="episodeLimit" value="{{ $anime->episode_count }}" hidden>

                    <h3 class=" text-light text-center my-4">Anime title: {{ $anime->title }}</h3>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="episodeNumber" name="episodeNumber"
                            value="{{ old('episodeNumber') }}">
                        <label for="episodeNumber">Episode number</label>
                        @error('episodeNumber')
                            <strong class=" text-danger fw-bold">{{ $message }}</strong>
                        @enderror
                    </div>

                    <input type="submit" value="Add" class=" btn btn-info form-control">
                </form>
            </div>

            <div class="mb-5">

                <form action="{{ route('admin#anime#home#episodeaddnew#batch') }}" method="post">
                    @csrf
                    <input type="number" name="animeId" value="{{ $anime->id }}" hidden>
                    <input type="number" name="episodeLimit" value="{{ $anime->episode_count }}" hidden>
                    <input type="number" name="preEpisode" value="{{ $episodeCount }}" hidden>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="episodeTotalNumber" name="episodeTotalNumber"
                            value="{{ old('episodeTotalNumber') }}">
                        <label for="episodeTotalNumber">Episode total number</label>
                        @error('episodeTotalNumber')
                            <strong class=" text-danger fw-bold">{{ $message }}</strong>
                        @enderror
                    </div>

                    <input type="submit" value="Add batch" class=" btn btn-info form-control">
                </form>
            </div>

            <p class=" text-light fs-5 mt-3">Added episodes:
                @foreach ($episodes as $episode)
                    {{ $episode->episode_number }} ,
                @endforeach
            </p>

            <p class=" text-light fs-5 mt-3">Total episode slot:
                {{ $anime->episode_count }}
            </p>
        </div>
    </div>

    {{-- Message --}}

    @if (session('Message'))
        <div class="alert alert-success alert-dismissible fade show me-5 mb-5" role="alert" id="alertBox">
            <strong>{{ session('Message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection
