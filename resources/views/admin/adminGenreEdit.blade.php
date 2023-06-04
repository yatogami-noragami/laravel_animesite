@extends('admin.layout.adminMasterVIew')

@section('title', 'Admin Anime View Page')

@section('content')

    {{-- Edit Genre --}}

    <a href="{{ route('admin#genre#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:2%; left:5%;"></i>
    </a>

    <div class="mt-5">
        <form action="{{ route('admin#genre#home#update') }}" method="post">
            @csrf

            <input type="number" hidden name="genreId" value="{{ $genre->id }}">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Anime Genre"
                            value="{{ $genre->name }}">
                        <label for="name">Genre</label>
                        @error('name')
                            <strong class=" text-danger fw-bold">{{ $message }}</strong>
                        @enderror
                    </div>

                    <input type="submit" value="Edit" class=" form-control btn btn-info">
                </div>

            </div>

        </form>
    </div>
@endsection
