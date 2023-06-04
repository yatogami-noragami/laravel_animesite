<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Boostrap CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Font Awesome --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    {{-- Main CSS --}}
    <link rel="stylesheet" href="{{ asset('css/adminHomepage.css') }}">

    <title>@yield('title')</title>
</head>

<body class="bg-dark">

    <h1 id="tabName" hidden>{{ $tabName }}</h1>

    <div class="container" id="maindiv">

        {{-- Admin Dashboard For Desktop Size --}}

        <div class="row mb-3">
            <div class="col-8  text-left p-4">
                <h1 class=" text-light">Admin Dashboard</h1>
            </div>

            <div class="col-4 d-flex justify-content-end align-items-center">
                <a href="{{ route('admin#home#request', ['number' => '012']) }}" class=" text-decoration-none me-4">
                    <i class="fa-solid fa-bell text-light fs-3 me-2"></i>
                </a>

                <div class="dropdown d-lg-block d-none">

                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fa-solid fa-crown me-2"></i>{{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark">

                        <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin#home') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin#add#genre') }}">Add new genre</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin#add#anime') }}">Add new anime</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin#add#movie') }}">Add new movie</a></li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <input type="submit" value="Logout" class=" btn btn-danger form-control">
                            </form>
                        </li>
                    </ul>
                </div>

                <a class="btn btn-primary d-block d-lg-none" data-bs-toggle="offcanvas" href="#offcanvasExample"
                    aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars"></i>
                </a>
            </div>

        </div>

        {{-- Admin Dashboard For Tablet And Smaller Size --}}

        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Admin - {{ Auth::user()->name }}</h5>
                <button type="button" class="btn-close bg-primary" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="list-group">
                    <a class="list-group-item list-group-item-action" href="{{ route('profile') }}">Profile</a>

                    <a class="list-group-item list-group-item-action active"
                        href="{{ route('admin#home') }}">Dashboard</a>

                    <a class="list-group-item list-group-item-action" href="{{ route('admin#add#genre') }}">Add new
                        genre</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('admin#add#anime') }}">Add new
                        anime</a>
                    <a class="list-group-item list-group-item-action" href="{{ route('admin#add#movie') }}">Add new
                        movie</a>


                    <hr class=" border-primary border-2">

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" value="Logout" class=" btn btn-danger form-control">
                    </form>
                </div>
            </div>
        </div>

        {{-- Navbar --}}

        <nav class="nav nav-pills nav-fill mb-5">
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'home') active text-light @endif"
                href="{{ route('admin#home') }}">Total users</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'anime') active text-light @endif"
                href="{{ route('admin#anime#home') }}">Anime</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'episode') active text-light @endif"
                href="{{ route('admin#episode#home') }}">Episode</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'movie') active text-light @endif"
                href="{{ route('admin#movie#home') }}">Movie</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'genre') active text-light @endif"
                href="{{ route('admin#genre#home') }}">Genre</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'bookmark') active text-light @endif"
                href="{{ route('admin#bookmark#home') }}">Bookmark</a>
            <a class="nav-link text-warning navTabColor
            @if ($tabName == 'comment') active text-light @endif"
                href="{{ route('admin#comment#home') }}">Comment</a>
        </nav>

        {{-- Content --}}

        @yield('content')


    </div>

    {{-- Backtotop Button --}}
    <div class=" " id="backToTop">
        <button class="btn">
            <i class="fa-solid fa-arrow-up-from-bracket text-primary fs-2"></i>
        </button>
    </div>


</body>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
    crossorigin="anonymous"></script>

{{-- Main JS --}}
<script src="{{ asset('js/adminHomepage.js') }}"></script>


</html>
