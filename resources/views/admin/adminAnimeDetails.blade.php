@extends('admin.layout.adminMasterVIew')

@section('title', 'Admin Anime View Page')

@section('content')


    {{-- Back Arrow --}}

    <a href="{{ url()->previous() }}" class=" text-decoration-none text-secondary">
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

            <div class="row mt-5">
                <a href="{{ route('admin#anime#home#edit', $anime->id) }}" class=" text-decoration-none text-light">
                    <button class=" btn btn-warning form-control">
                        <i class="fa-solid fa-user-pen fs-4 me-1"></i>
                        <span class=" fs-5 ms-1">edit details</span>
                    </button>
                </a>
            </div>
        </div>

        <div class="col-lg-5 col-md-6 mt-5">
            <div class="row mt-3">
                <h5 class=" text-secondary">Title: </h5>
                <h5 class=" text-warning ">{{ $anime->title }}</h5>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Description: </h5>
                <p class=" text-warning fs-5">{{ $anime->description }}</p>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Genre: </h5>
                <h5 class=" text-warning ">{{ $anime->genre }}</h5>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Rating: </h5>
                <h5 class=" text-warning ">{{ $anime->rating }}/10</h5>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Released year: </h5>
                <h5 class=" text-warning ">{{ $anime->year }}</h5>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Total episode: </h5>
                <h5 class=" text-warning ">{{ $anime->episode_count }}</h5>
            </div>

            <div class="row mt-3">
                <h5 class=" text-secondary">Available episode: </h5>
                <h5 class=" text-warning ">{{ $anime->available_episode }}</h5>
            </div>
        </div>
    </div>
@endsection
