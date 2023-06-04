@extends('admin.layout.adminMasterHomepage')

@section('title', 'Admin Homepage')

@section('content')

    {{-- Comment Homepage --}}
    <div class="row mb-3">

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
                            <li><a class="dropdown-item" href="{{ route('admin#comment#home#idsort') }}">Sort by ID</a>
                            </li>

                            <li><a class="dropdown-item" href="{{ route('admin#comment#home#usernamesort') }}">Sort by User
                                    name</a>
                            </li>

                            <li><a class="dropdown-item" href="{{ route('admin#comment#home#animenamesort') }}">Sort by
                                    Anime name</a>
                            </li>

                        </ul>

                        <a href="{{ route('admin#comment#home') }}">
                            <button class=" btn btn-warning ms-3">Reset</button>
                        </a>
                    </div>


                </div>
                <div class="col-lg-3 offset-lg-3 mt-3">
                    <form action="{{ route('admin#comment#home') }}" method="get">
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
                <h5 class=" text-primary text-end me-3">Total comment: {{ $comments->total() }}</h5>
            </div>

            {{-- Comment Table --}}

            <div class=" table-responsive">
                @if (count($comments) == 0)
                    <h1 class=" text-danger">No data here</h1>
                @else
                    <table class="table table-light table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Comment</th>
                                <th>Anime name</th>
                                <th>Episode number</th>
                                <th>Updated at</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($comments as $comment)
                                <tr>
                                    <td>{{ $comment->id }}</td>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ Str::limit($comment->description, 30, '...') }}</td>

                                    <td>{{ $comment->title }}</td>
                                    <td>{{ $comment->episode_number }}</td>
                                    <td>{{ $comment->updated_at->format('j-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin#comment#home#view', $comment->id) }}"
                                            class=" text-decoration-none">
                                            <i class="fa-solid fa-eye fs-4 text-dark"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#!" class=" text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $comment->id }}">
                                            <i class="fa-solid fa-trash fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <!-- Delete Comment -->
                                    <div class="modal fade" id="staticBackdrop{{ $comment->id }}"
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
                                                    Are you sure to delete comment of user {{ $comment->name }} from anime
                                                    {{ $comment->title }}, episode {{ $comment->episode_number }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin#comment#home#delete', $comment->id) }}">
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
                    {{ $comments->links() }}
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
