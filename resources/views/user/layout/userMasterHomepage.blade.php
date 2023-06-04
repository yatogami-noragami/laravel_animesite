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
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">

    <title>@yield('title')</title>
</head>

<body class=" bg-dark">
    <h1 id="tabName" hidden>{{ $tabName }}</h1>

    <div class="container">

        {{-- Header Section Start --}}
        <section>

            {{-- Website Name For Tablet And Smaller Size --}}

            <div class="row">
                <div class="d-lg-none d-block text-center">
                    <a href="{{ route('user#home') }}" class=" logoName text-decoration-none">
                        <h1 class=" my-4 fw-bold ">Yokouso Anime Site</h1>
                    </a>
                </div>
            </div>

            {{-- Website Logo For Desktop Size --}}

            <div class="row mb-5">
                <div class="col-2 offset-1 d-lg-block d-none mt-5">
                    <a href="{{ route('user#home') }}" class=" text-decoration-none">
                        <img src="{{ asset('image/yokousoLogo.png') }}" alt="" class=" img-fluid p-md-1 p-0">
                    </a>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="row h-50 d-felx justify-content-center align-items-end mb-3">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-lg-center justify-content-start align-items-center">
                                <i class="fa-regular fa-user text-secondary fs-5 me-3"></i>
                                <a href="{{ route('profile') }}"
                                    class=" me-3 text-decoration-none text-light">{{ Auth::user()->name }}</a>

                                <form action="{{ route('logout') }}" method="post">
                                    @csrf

                                    <input type="submit" value="Logout" class=" btn "
                                        style="background-color: darkgoldenrod">
                                </form>
                            </div>

                            <div class="d-lg-none d-md-block">

                            </div>
                        </div>
                    </div>

                    {{-- Navbar --}}

                    <div class="row h-50 ">
                        <nav class="nav navbar-header d-flex align-items-center" id="nav">
                            <a class="nav-link @if ($tabName == 'home') active @endif"
                                href="{{ route('user#home') }}">Home</a>
                            <a class="nav-link @if ($tabName == 'animelist') active @endif"
                                href="{{ route('user#home#anime#list') }}">Anime list</a>
                            <a class="nav-link @if ($tabName == 'newseason') active @endif"
                                href="{{ route('user#home#new#season') }}">New season</a>
                            <a class="nav-link @if ($tabName == 'movies') active @endif"
                                href="{{ route('user#home#movies') }}">Movie</a>
                            <a class="nav-link @if ($tabName == 'popular') active @endif"
                                href="{{ route('user#home#popular') }}">Popular</a>
                        </nav>
                    </div>
                </div>

                {{-- Request,Contact And Links For Desktop Size --}}

                <div class="col-lg-3 mt-lg-0 mt-md-4 mt-5">
                    <div class="row h-50 mb-3 d-lg-block d-none">
                        <div class="d-flex justify-content-end align-items-end">
                            <a href="{{ route('user#request') }}"
                                class=" linkDGR2 text-decoration-none me-2">Request</a>
                            <span class=" text-secondary me-2">|</span>
                            <a href="{{ route('user#contact') }}"
                                class=" linkDGR2 text-decoration-none me-4">Contact</a>
                            <a href="#" class=" text-decoration-none linkDGR2 me-3 fs-5">
                                <i class="fa-brands fa-telegram "></i>
                            </a>

                            <a href="#" class=" text-decoration-none linkDGR2 me-3 fs-5">
                                <i class="fa-brands fa-discord "></i>
                            </a>

                            <a href="#" class=" text-decoration-none linkDGR2 me-3 fs-5">
                                <i class="fa-brands fa-facebook "></i>
                            </a>

                            <a href="#" class=" text-decoration-none linkDGR2 me-3 fs-5">
                                <i class="fa-brands fa-at "></i>
                            </a>
                        </div>
                    </div>

                    {{-- Search Box --}}

                    @if (isset($tabName))
                        <div class="row h-50">
                            <div class="container-fluid d-flex justify-content-center align-items-center">
                                <form action="" method="get">
                                    <div class=" input-group" id="searchParent">

                                        <input type="text" class="form-control bg-dark" placeholder="Search"
                                            id="searchBox" name="search" value="{{ request('search') }}"
                                            autocomplete="off" />
                                        <button type="submit" class="btn">
                                            <i class="fa-solid fa-magnifying-glass" style="color: darkgoldenrod"></i>
                                        </button>

                                        <div class="rounded mt-3 bg-dark" id="searchRes">

                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        {{-- Header Section End --}}

        {{-- Main Content Section Start --}}
        <div class=" z-0">
            @yield('content')
        </div>
        {{-- Main Content Section End --}}

        {{-- Backtotop Button --}}
        <div class="" id="backToTop">
            <button class="btn">
                <i class="fa-solid fa-arrow-up-from-bracket fs-2 linkDGR2"></i>
            </button>
        </div>

        {{-- Request,Contact And Links For Tablet And Smaller Size --}}

        <div class="row d-block d-lg-none rounded mt-5 " id="footerdiv">
            <div class=" col-10 offset-1  col-md-8 offset-md-2 d-flex justify-content-center py-3">
                <a href="{{ route('user#request') }}" class=" text-decoration-none text-dark fw-bold">request</a>
                <span class=" fw-bold">|</span>
                <a href="{{ route('user#contact') }}"
                    class=" text-decoration-none text-dark fw-bold me-3">contact</a>

                <a href="#!" class=" text-decoration-none text-dark me-3 fs-5">
                    <i class="fa-brands fa-telegram "></i>
                </a>

                <a href="#!" class=" text-decoration-none text-dark me-3 fs-5">
                    <i class="fa-brands fa-discord "></i>
                </a>

                <a href="#!" class=" text-decoration-none text-dark me-3 fs-5">
                    <i class="fa-brands fa-facebook "></i>
                </a>

                <a href="#!" class=" text-decoration-none text-dark me-3 fs-5">
                    <i class="fa-brands fa-at "></i>
                </a>
            </div>
        </div>

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
<script src="{{ asset('js/homepage.js') }}"></script>

<script>
    $(document).ready(function() {

        //Ajax For Anime And Movie Search

        $('#searchRes').hide();

        $('#searchBox').on('input', function() {

            $search = $(this).val();
            $tabName = $('#tabName').html();
            if ($tabName == 'movies') {
                $url = "http://localhost/anime_site/public/user/ajax/movie/search/" + $search;
                $href = "http://localhost/anime_site/public/user/movie/";
            } else {
                $url = "http://localhost/anime_site/public/user/ajax/anime/search/" + $search;
                $href = "http://localhost/anime_site/public/user/anime/";
            }
            if ($search.length > 1) {
                $id = [];
                $list = '';
                $(function() {
                    $.ajax({
                        type: "get",
                        url: $url,
                        dataType: "json",
                        success: function(response) {
                            for ($i = 0; $i < response.length; $i++) {
                                if (!$id.includes(response[$i].id)) {
                                    $id.push(response[$i].id);
                                    $list += `
                    <a href="${$href + response[$i].id}" class="resLink text-decoration-none">

                        <div class="row p-3">

                            <div class="col">
                                <div
                                class="d-flex justify-content-center align-items-center h-100">
                                    <p class="resTxt text-center">${ response[$i] . title }</p>
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
                });
            } else {
                $('#searchRes').hide();
                $list = '';
                $('#searchRes').html($list);
            }
        });

    });
</script>

</html>
