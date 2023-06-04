@extends('admin.layout.adminMasterHomepage')

@section('title', 'Admin Homepage')

@section('content')

    {{-- Anime Homepage --}}

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
                            <li><a class="dropdown-item" href="{{ route('admin#anime#home#idsort') }}">Sort by ID</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin#anime#home#titlesort') }}">Sort by Title</a>
                            </li>
                        </ul>

                        <a href="{{ route('admin#anime#home') }}">
                            <button class=" btn btn-warning ms-3">Reset</button>
                        </a>

                    </div>


                </div>
                <div class="col-lg-3 offset-lg-3 mt-3">

                    <div id="searchParent">
                        <form action="{{ route('admin#anime#home') }}" method="get">
                            <div class="d-flex">
                                <input type="search" id="searchBox" name="key" class=" form-control me-3"
                                    value="{{ request('key') }}" placeholder="Search by name..." autocomplete="off">
                                <button class=" btn btn-secondary " type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>

                        <div class="rounded mt-3 bg-dark" id="searchRes">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3 col-12">
                        <form action="{{ route('admin#anime#home#genresort') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-8">
                                    <select class="form-select" name="genre">
                                        <option value="null">Sort by Genre</option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->name }}"
                                                @if ($genreSelected != null) @if ($genreSelected == $genre->name) selected @endif
                                                @endif
                                                >{{ $genre->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">
                                    <input type="submit" value="Sort" class="btn btn-warning form-control">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            <div class="row p-3">
                <h5 class=" text-primary text-end me-3">Total anime: {{ $animes->total() }}</h5>
            </div>

            {{-- Anime Table --}}

            <div class=" table-responsive">
                @if (count($animes) == 0)
                    <h1 class=" text-danger">No data here</h1>
                @else
                    <table class="table table-light table-striped table-hover ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>Created at</th>
                                <th>Edited at</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($animes as $anime)
                                <tr>
                                    <td>{{ $anime->id }}</td>
                                    <td class=" w-25">
                                        @if ($anime->image == null)
                                            <img src="{{ asset('image/default_anime_poster.jpg') }}"
                                                class=" img-fluid w-50 rounded">
                                        @else
                                            <img src="{{ asset('storage/' . $anime->image) }}"
                                                class=" img-fluid w-50 rounded">
                                        @endif
                                    </td>
                                    <td>{{ $anime->title }}</td>
                                    <td>{{ $anime->genre }}</td>
                                    <td>{{ $anime->created_at->format('j-F-Y') }}</td>
                                    <td>{{ $anime->updated_at->format('j-F-Y') }}</td>

                                    <td>
                                        <a href="{{ route('admin#anime#home#episodeadd', $anime->id) }}"
                                            class=" text-decoration-none">
                                            <i class="fa-solid fa-square-plus fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin#anime#home#view', $anime->id) }}"
                                            class=" text-decoration-none">
                                            <i class="fa-solid fa-eye fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin#anime#home#edit', $anime->id) }}"
                                            class=" text-decoration-none">
                                            <i class="fa-solid fa-edit fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <a href="#" class=" text-decoration-none" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop{{ $anime->id }}">
                                            <i class="fa-solid fa-trash fs-4 text-dark"></i>
                                        </a>
                                    </td>

                                    <!-- Delete Anime -->
                                    <div class="modal fade" id="staticBackdrop{{ $anime->id }}"
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
                                                    Are you sure to delete anime {{ $anime->title }} ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="{{ route('admin#anime#home#delete', $anime->id) }}">
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
                    {{ $animes->links() }}
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

{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        //Ajax For Search Box

        $('#searchRes').hide();

        $('#searchBox').on('input', function() {

            $search = $(this).val();
            $url = "http://localhost/anime_site/public/admin/ajax/anime/search/" + $search;
            if ($search.length > 1) {
                $id = [];
                $list = '';
                $.ajax({
                    type: "get",
                    url: $url,
                    dataType: "json",
                    success: function(response) {
                        for ($i = 0; $i < response.length; $i++) {
                            if (!$id.includes(response[$i].id)) {
                                $id.push(response[$i].id);
                                $list += `
                    <a href="http://localhost/anime_site/public/admin/animesview/${response[$i].id}" class="resLink text-decoration-none">

                        <div class="row p-3">

                            <div class="col">
                                <div
                                class="d-flex justify-content-center align-items-center h-100">
                                    <p class="resTxt text-center">${response[$i].title}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                        `;
                            }
                        }
                        if ($list != '') {
                            $('#searchRes').empty();
                            $('#searchRes').html($list);
                            $('#searchRes').show();
                        }

                    }

                });

            } else {
                $('#searchRes').hide();
                $list = '';
                $('#searchRes').html($list);
            }
        });
    });
</script>
