@extends('admin.layout.adminMasterHomepage')

@section('title', 'Admin Homepage')

@section('content')

    {{-- User Homepage --}}
    <div class="row mb-3">

        <div class=" p-1">

            {{-- Sortings --}}

            <button class="btn btn-primary w-100" id="sortBtn">Sort & Search</button>

            <div class="row" id="sorting">
                <div class="col-lg-6 mt-3">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle " type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sort By
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('admin#home#idsort') }}">Sort by ID</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin#home#namesort') }}">Sort by Name</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin#home#emailsort') }}">Sort by Email</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin#home#rolesort') }}">Sort by Role</a></li>
                        </ul>

                        <a href="{{ route('admin#home') }}" class="">
                            <button class=" btn btn-warning ms-3">Reset</button>
                        </a>
                    </div>


                </div>
                <div class="col-lg-3 offset-lg-3 mt-3">
                    <form action="{{ route('admin#home') }}" method="get">
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
                <h5 class=" text-primary me-3 text-end">Total admin: {{ $adminCount }}</h5>
                <h5 class=" text-primary me-3 text-end">Total user: {{ $userCount }}</h5>

            </div>

            {{-- User Table --}}

            <div class=" table-responsive">
                @if (count($users) == 0)
                    <h1 class=" text-danger">No data here</h1>
                @else
                    <table class="table table-light table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Joined at</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <a href="#!" class=" text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdropdelete{{ $user->id }}">
                                            <i class="fa-solid fa-trash fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <!-- Delete -->
                                    <div class="modal fade" id="staticBackdropdelete{{ $user->id }}"
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
                                                    Are you sure to delete user {{ $user->name }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin#home#delete', $user->id) }}">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($user->role == 'admin')
                                        @if ($user->id != $loginId)
                                            <td>
                                                <a href="#" class=" text-decoration-none" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdropdown{{ $user->id }}">
                                                    <i class="fa-solid fa-angles-down fs-4 text-dark"></i>
                                                </a>
                                            </td>
                                        @endif

                                        <!-- Downgrade -->
                                        <div class="modal fade" id="staticBackdropdown{{ $user->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confimation
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to downgrade {{ $user->name }} from
                                                        "{{ $user->role }}" to "User" ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin#home#downgrade', $user->id) }}">
                                                            <button type="button" class="btn btn-warning">Confirm</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <td>
                                            <a href="#" class=" text-decoration-none" data-bs-toggle="modal"
                                                data-bs-target="#staticBackdroppro{{ $user->id }}">
                                                <i class="fa-solid fa-angles-up fs-4 text-dark"></i>
                                            </a>
                                        </td>

                                        <!-- Promote -->
                                        <div class="modal fade" id="staticBackdroppro{{ $user->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Confimation
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure to promote {{ $user->name }} from
                                                        "{{ $user->role }}" to "Admin" ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <a href="{{ route('admin#home#promote', $user->id) }}">
                                                            <button type="button"
                                                                class="btn btn-success">Confirm</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{-- Pagination --}}

                <div class="">
                    {{ $users->links() }}
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
