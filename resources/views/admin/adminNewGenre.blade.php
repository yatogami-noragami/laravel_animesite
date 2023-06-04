@extends('admin.layout.adminMasterAddNew')

@section('title', 'Add New Genre')

@section('content')

    {{-- Add New Genre --}}
    <h3 class=" text-info text-center mb-5">Add New Genre Form</h3>

    <form action="{{ route('admin#create#genre') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-4  offset-lg-4 ">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Anime Genre"
                        value="{{ old('name') }}">
                    <label for="name">Genre</label>
                    @error('name')
                        <strong class=" text-danger fw-bold">{{ $message }}</strong>
                    @enderror
                </div>

                <input type="submit" value="Add" class=" form-control btn btn-info">
            </div>

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
