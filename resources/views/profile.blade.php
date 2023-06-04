@extends('layouts.masterProfile')

@section('title', 'Profile')

@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('wall') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Accont Profile --}}

    <div class="row mt-5">
        <div class="col-md-2  offset-md-1 col-10 offset-1">
            @if (Auth::user()->image == null)
                <img src="{{ asset('image/deafault_user.webp') }}" alt="" class=" img-fluid">
            @else
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                    class="img-fluid pfImg img-fluid rounded-circle d-block mx-auto">
            @endif
        </div>

        <div class="col-md-6 offset-md-1 col-10 offset-1 mt-3">
            <div class="row my-2">
                <div class="d-flex justify-content-lg-between align-items-center">
                    <h4 class=" text-secondary text-left">Name: </h4>
                    <h4 class=" text-light text-right">{{ Auth::user()->name }}</h4>
                </div>
            </div>

            <div class="row my-2">
                <div class="d-flex justify-content-lg-between align-items-center">
                    <h4 class=" text-secondary text-left">Email: </h4>
                    <h4 class=" text-light text-right">{{ Auth::user()->email }}</h4>
                </div>
            </div>

            <div class="row my-2">
                <div class="d-flex justify-content-lg-between align-items-center">
                    <h4 class=" text-secondary text-left">Role: </h4>
                    <h4 class=" text-light text-right">{{ Auth::user()->role }}</h4>
                </div>
            </div>

            <div class="row my-2">
                <div class="d-flex justify-content-lg-between align-items-center">
                    <h4 class=" text-secondary text-left">Join date: </h4>
                    <h4 class=" text-light text-right">{{ Auth::user()->created_at->format('j-F-Y') }}</h4>
                </div>
            </div>

            <div class="row my-3">
                <div class="col-lg-6 col-12 mb-3">
                    <a href="{{ route('profile#edit') }}" class=" text-decoration-none text-light w-50">
                        <button class=" btn btn-warning form-control">
                            <i class="fa-solid fa-user-pen fs-6 me-1"></i>
                            <span class=" fs-5 ms-1">edit details</span>
                        </button>
                    </a>
                </div>

                <div class="col-lg-6 col-12 mb-3">
                    <a href="{{ route('profile#change') }}" class=" text-decoration-none text-dark w-50">
                        <button class=" btn btn-danger form-control">
                            <i class="fa-solid fa-lock fs-6 me-1"></i>
                            <span class=" fs-5 ms-1">change password</span>
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Bookmarks For User ONly --}}

    <hr class=" border-2">

    @if (Auth::user()->role == 'user')
        <div class="row mb-5">
            <div class="col-lg-2 col-12 ">
                <button class=" btn btn-outline-primary w-100 p-3 " id="bookmarkBtn">bookmarks</button>

                @if ($animeArray)
                    {
                    <a href="#" class=" text-decoration-none" data-bs-toggle="modal"
                        data-bs-target="#bookmarkDeleteAll">
                        <button class=" btn btn-outline-danger w-100 p-3 mb-3">remove all bookmarks</button>
                    </a>

                    <!-- Delete All Bookmark -->
                    <div class="modal fade" id="bookmarkDeleteAll" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confimation
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete all bookmarks ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="{{ route('user#anime#bookmark#remove#all') }}">
                                        <button type="button" class="btn btn-danger">Confirm</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    }
                @endif
            </div>

            <div class="col-lg-10  col-12 " id="bookmarkDiv">
                <div class="row">
                    <h4 class=" text-primary text-center text-decoration-underline my-5">Animes</h4>
                    @if ($animeArray)

                        @foreach ($animeArray as $anime => $image)
                            <div class="col-lg-4 col-md-6 col-6 mb-4 animeParent">
                                <a href="{{ route('user#bookmark#anime', ['animename' => $anime, 'type' => 'anime']) }}"
                                    class=" text-decoration-none text-light textDGR">
                                    <p class=" text-center animeText">{{ $anime }}</p>
                                </a>

                                <a href="{{ route('user#bookmark#anime', ['animename' => $anime, 'type' => 'anime']) }}">
                                    @if ($image == null)
                                        <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                            class=" img-fluid animeImage rounded px-3 d-block mx-auto">
                                    @else
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class=" img-fluid animeImage rounded px-3 d-block mx-auto">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h1 class=" text-danger text-center">No data here</h1>
                    @endif
                </div>

                <div class="row ">
                    <h4 class=" text-primary text-center text-decoration-underline my-5">Movies</h4>
                    @if ($movieArray)

                        @foreach ($movieArray as $movie => $image)
                            <div class="col-lg-4 col-md-6 col-6 mb-4 animeParent">
                                <a href="{{ route('user#bookmark#anime', ['animename' => $movie, 'type' => 'movie']) }}"
                                    class=" text-decoration-none text-light textDGR">
                                    <p class=" text-center animeText">{{ $movie }}</p>
                                </a>

                                <a href="{{ route('user#bookmark#anime', ['animename' => $movie, 'type' => 'movie']) }}">
                                    @if ($image == null)
                                        <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                            class=" img-fluid animeImage rounded px-3 d-block mx-auto">
                                    @else
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class=" img-fluid animeImage rounded px-3 d-block mx-auto">
                                    @endif
                                </a>
                            </div>
                        @endforeach
                    @else
                        <h1 class=" text-danger text-center">No data here</h1>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Message --}}

    @if (session('Message'))
        <div class="alert alert-success alert-dismissible fade show me-5 mb-5" role="alert" id="alertBox">
            <strong>{{ session('Message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

@endsection
