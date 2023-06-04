@extends('layouts.masterLogin&Register')

@section('title', 'Login Page')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-4 offset-lg-4 col-12 pb-4 border border-secondary rounded">
            <div class="row my-3">
                <div class="col-4 offset-4">
                    <img src="{{ asset('image/yokousoLogo.png') }}" alt="" class=" img-fluid">
                </div>
            </div>

            <form action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email"
                        value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="userPassword">
                    <label for="password">Password</label>
                    @error('password')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>


                <div class=" mb-3">
                    <i class="fa-solid fa-eye text-light me-3" id="passwordHideShow"></i>
                    <label class=" textDGR" id="passwordHideShowTxt" style=" cursor: pointer;">show
                        password</label>
                </div>

                <div class="mb-3">
                    <a href="{{ route('registerPage') }}" class=" text-decoration-none me-3"
                        style="color: darkgoldenrod">Register</a>
                </div>

                <input type="submit" value="Login" class="  btnDGR form-control">
            </form>
        </div>
    </div>
@endsection
