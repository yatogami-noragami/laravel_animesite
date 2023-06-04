@extends('layouts.masterProfile')

@section('title', 'Edit Details Page')


@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('profile') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Account Profile --}}

    <div class="row mt-5">
        <div class="col-md-2  offset-md-1 col-10 offset-1">
            @if (Auth::user()->image == null)
                <img src="{{ asset('image/deafault_user.webp') }}" alt="" class=" img-fluid">
            @else
                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                    class=" img-fluid pfImg img-fluid rounded-circle d-block mx-auto">
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

        </div>
    </div>

    {{-- Edit Account Details --}}

    <div class="row">
        <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 mt-3">
            <h3 class=" text-warning text-center mb-3">Edit Details</h3>
            <form action="{{ route('profile#editForm') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Name" name="name"
                        value="{{ Auth::user()->name }}">
                    <label for="name">Name</label>
                    @error('name')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email"
                        value="{{ Auth::user()->email }}">
                    <label for="email">Email</label>
                    @error('email')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class=" mb-3">
                    <label for="image" class=" text-light mb-3">Image</label>
                    <input type="file" class="form-control" name="image" id="profileImage">

                    <div class="my-3">
                        <img src="#" class=" img-fluid" id="previewImage" alt="">
                    </div>
                    @error('image')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <input type="submit" value="Edit" class=" btn btn-warning form-control">
            </form>
        </div>
    </div>

    {{-- Message --}}

    @if (session('Message'))
        <div class="alert alert-danger alert-dismissible fade show me-5 mb-5" role="alert" id="alertBox">
            <strong>{{ session('Message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection
