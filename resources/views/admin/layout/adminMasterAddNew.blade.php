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
    <link rel="stylesheet" href="{{ asset('css/adminNewAnime.css') }}">

    <title>@yield('title')</title>
</head>

<body class="bg-dark overflow-x-hidden">

    <div class="container">

        {{-- Admin DashBoard Desktop Size --}}

        <div class="row mb-3">
            <div class="col-10  text-left p-4">
                <h1 class=" text-light">Admin Dashboard</h1>
            </div>

            <div class="col-2 d-flex justify-content-end align-items-center">
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

        {{-- Admin DashBoard Tablet And Smaller Size --}}

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

                    <a class="list-group-item list-group-item-action" href="{{ route('admin#home') }}">Dashboard</a>

                    <a class=list-group-item list-group-item-action" href="{{ route('admin#add#genre') }}">Add new
                        genre</a>
                    <a class=list-group-item list-group-item-action" href="{{ route('admin#add#anime') }}">Add new
                        anime</a>
                    <a class=list-group-item list-group-item-action" href="{{ route('admin#add#movie') }}">Add new
                        movie</a>
                    <hr class="border-primary border-2">

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <input type="submit" value="Logout" class=" btn btn-danger form-control">
                    </form>
                </div>
            </div>
        </div>

        {{-- Back Arrow --}}

        <div class="row">
            <a href="{{ route('admin#home') }}" class=" text-decoration-none text-secondary">
                <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:10%; left:5%;"></i>
            </a>
        </div>

        {{-- Content --}}

        @yield('content')

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
<script src="{{ asset('js/adminNewAnime.js') }}"></script>

</html>
