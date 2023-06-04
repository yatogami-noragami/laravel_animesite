@extends('admin.layout.adminMasterHomepage')

@section('title', 'Admin Homepage')

@section('content')

    {{-- Genre Homepage --}}
    <div class="row">

        <div class=" p-1">

            {{-- Sortings --}}

            <button class="btn btn-primary w-100" id="sortBtn">Sort & Search</button>

            <div class="row" id="sorting">
                <div class="col-lg-6 mt-3">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sort By
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('admin#genre#home#idsort') }}">Sort by ID</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin#genre#home#namesort') }}">Sort by Name</a>
                            </li>
                        </ul>

                        <a href="{{ route('admin#genre#home') }}">
                            <button class=" btn btn-warning ms-3">Reset</button>
                        </a>
                    </div>


                </div>
                <div class="col-lg-3 offset-lg-3 mt-3">
                    <form action="{{ route('admin#genre#home') }}" method="get">
                        <div class="d-flex">
                            <input type="search" name="key" class=" form-control me-3" value="{{ request('key') }}"
                                placeholder="Search by name...">
                            <button class=" btn btn-secondary " type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row p-3">
                <h5 class=" text-primary text-end me-3">Total genre: {{ $genres->total() }}</h5>
            </div>

            {{-- Genre Table --}}

            <div class=" table-responsive">
                @if (count($genres) == 0)
                    <h1 class=" text-danger">No data here</h1>
                @else
                    <table class="table table-light table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created at</th>>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($genres as $genre)
                                <tr>
                                    <td>{{ $genre->id }}</td>
                                    <td>{{ $genre->name }}</td>
                                    <td>{{ $genre->created_at->format('j-F-Y') }}</td>

                                    <td>
                                        <a href="{{ route('admin#genre#home#edit', $genre->id) }}"
                                            class=" text-decoration-none">
                                            <i class="fa-solid fa-edit fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="#" class=" text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $genre->id }}">
                                            <i class="fa-solid fa-trash fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <!--Delete Genre -->
                                    <div class="modal fade" id="staticBackdrop{{ $genre->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confimation</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete genre {{ $genre->name }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin#genre#home#delete', $genre->id) }}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{-- Pagination --}}

                <div class="">
                    {{ $genres->links() }}
                </div>

                {{-- Message --}}

                @if (session('Message'))
                    <div class="alert alert-success alert-dismissible fade show me-5 mb-5" role="alert" id="alertBox">
                        <strong>{{ session('Message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>


        </div>
    </div>
@endsection
