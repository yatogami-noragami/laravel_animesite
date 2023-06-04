@extends('user.layout.userForm')

@section('title', 'Requst Form')

@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('user#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Rquest --}}

    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
            <form action="{{ route('user#request#anime') }}" method="post">
                @csrf
                <div class="row my-5">
                    <label for="animeTitle" class=" text-success fw-bold fs-5 mb-3">Anime/movie name</label>
                    <input type="text" name="animeTitle" class=" form-control">
                    @error('animeTitle')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <div class="row my-5">
                    <input type="submit" value="Request" class=" btn btn-outline-success form-control">
                </div>
            </form>
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
