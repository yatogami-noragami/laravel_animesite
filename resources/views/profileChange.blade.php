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

        </div>
    </div>

    {{-- Change Password --}}

    <div class="row ">
        <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 mt-3">
            <h3 class=" text-danger text-center mb-3">Change Password</h3>
            <form action="{{ route('profile#changeForm') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Old Password" name="oldPassword"
                        id="oldPassword">
                    <label for="oldPassword">Old Password</label>
                    @error('oldPassword')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="New Password" name="newPassword"
                        id="newPassword">
                    <label for="newPassword">New Password</label>
                    @error('newPassword')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="confirmPassword"
                        id="confirmPassword">
                    <label for="confirmPassword">Confirm Password</label>
                    @error('confirmPassword')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class=" mb-3">
                    <i class="fa-solid fa-eye me-3 text-light" id="passwordHideShow"></i>
                    <label class=" text-danger" id="passwordHideShowTxt" style=" cursor: pointer;">show
                        password</label>
                </div>

                <input type="submit" value="Change" class=" btn btn-danger form-control">
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
