@extends('layouts.masterLogin&Register')

@section('title', 'Register Page')

@section('content')
    <div class="row mt-3">
        <div class="col-lg-4 offset-lg-4 col-12 pb-4 border border-secondary rounded">
            <div class="row my-3">
                <div class="col-4 offset-4">
                    <img src="{{ asset('image/yokousoLogo.png') }}" alt="" class=" img-fluid">
                </div>
            </div>

            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Name" name="name"
                        value="{{ old('name') }}">
                    <label for="name">Name</label>
                    @error('name')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email"
                        value="{{ old('email') }}">
                    <label for="email">Email</label>
                    @error('email')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="mb-3" hidden>
                    <select class="form-select" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="userPassword">
                    <label for="password">Password</label>
                    @error('password')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>


                <div class="form-floating mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation"
                        id="userConfirmPassword">
                    <label for="password_confirmation">Confirm Pasword</label>
                    @error('password_confirmation')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class=" mb-3">
                    <i class="fa-solid fa-eye text-light me-3" id="passwordHideShow"></i>
                    <label class=" textDGR" id="passwordHideShowTxt" style=" cursor: pointer;">show password</label>
                </div>

                <div class="mb-3">
                    <a href="{{ route('loginPage') }}" class=" text-decoration-none me-3"
                        style="color: darkgoldenrod">Login</a>
                </div>

                <input type="submit" value="Register" class="  btnDGR form-control">
            </form>
        </div>
    </div>
@endsection
