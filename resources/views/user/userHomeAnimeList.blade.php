@extends('user.layout.userMasterHomepage')

@section('title', 'Homepage Anime List')

@section('content')

    {{-- Anime List Homepage --}}
    <section>
        <div class="row mb-3">
            <div class="d-flex offset-1">

                <a href="#!" class=" text-decoration-none" id="animelistgenrebtn">
                    <button class=" btn btn-warning ms-1">sort by genre</button>
                </a>

            </div>

        </div>

        <div class="row my-3" id="animelistgenre">
            @if ($genres)
                <div class="col-lg-8 offset-lg-2 d-flex flex-wrap">
                    @foreach ($genres as $genre)
                        <a href="{{ route('user#anime#list#genre#sort', $genre->name) }}"
                            class=" text-decoration-none text-warning me-4 mb-4 fw-bold">{{ $genre->name }}</a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sort By Alphabets --}}

        <div class="row my-3">
            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user#home#anime#list') }}" class=" text-decoration-none text-warning fw-bold">#</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'A']) }}"
                        class=" text-decoration-none text-warning fw-bold">A</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'B']) }}"
                        class=" text-decoration-none text-warning fw-bold">B</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'C']) }}"
                        class=" text-decoration-none text-warning fw-bold">C</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'D']) }}"
                        class=" text-decoration-none text-warning fw-bold">D</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'E']) }}"
                        class=" text-decoration-none text-warning fw-bold">E</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'F']) }}"
                        class=" text-decoration-none text-warning fw-bold">F</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'G']) }}"
                        class=" text-decoration-none text-warning fw-bold">G</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'H']) }}"
                        class=" text-decoration-none text-warning fw-bold">H</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'I']) }}"
                        class=" text-decoration-none text-warning fw-bold">I</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'J']) }}"
                        class=" text-decoration-none text-warning fw-bold">J</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'K']) }}"
                        class=" text-decoration-none text-warning fw-bold">K</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'L']) }}"
                        class=" text-decoration-none text-warning fw-bold">L</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'M']) }}"
                        class=" text-decoration-none text-warning fw-bold">M</a>
                </div>
            </div>

            <div class="col-md-6 mt-md-0 mt-3">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'N']) }}"
                        class=" text-decoration-none text-warning fw-bold">N</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'O']) }}"
                        class=" text-decoration-none text-warning fw-bold">O</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'P']) }}"
                        class=" text-decoration-none text-warning fw-bold">P</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'Q']) }}"
                        class=" text-decoration-none text-warning fw-bold">Q</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'R']) }}"
                        class=" text-decoration-none text-warning fw-bold">R</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'S']) }}"
                        class=" text-decoration-none text-warning fw-bold">S</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'T']) }}"
                        class=" text-decoration-none text-warning fw-bold">T</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'U']) }}"
                        class=" text-decoration-none text-warning fw-bold">U</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'V']) }}"
                        class=" text-decoration-none text-warning fw-bold">V</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'W']) }}"
                        class=" text-decoration-none text-warning fw-bold">W</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'X']) }}"
                        class=" text-decoration-none text-warning fw-bold">X</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'Y']) }}"
                        class=" text-decoration-none text-warning fw-bold">Y</a>
                    <a href="{{ route('user#home#anime#list#letter#sort', ['letter' => 'Z']) }}"
                        class=" text-decoration-none text-warning fw-bold">Z</a>
                </div>
            </div>
        </div>

        {{-- Anime List --}}

        <div class="row mb-5">
            @if (count($animes) == 0)
                <h1 class="text-danger text-center">No data here</h1>
            @else
                <div class="col-md-10 offset-md-1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="list-group">
                                @php
                                    $count = 0;
                                    $half = count($animes) / 2;
                                @endphp
                                @foreach ($animes as $anime)
                                    @if ($count < $half)
                                        <a href="{{ route('user#anime#details', $anime->id) }}"
                                            class="text-decoration-none my-2">
                                            <button type="button"
                                                class="list-group-item list-group-item-action btn btn-outline-warning border border-warning border-3 rounded">
                                                {{ $anime->title }}
                                            </button>
                                        </a>
                                    @endif
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-group">
                                @foreach ($animes as $index => $anime)
                                    @if ($index >= $half)
                                        <a href="{{ route('user#anime#details', $anime->id) }}"
                                            class="text-decoration-none my-2">
                                            <button type="button"
                                                class="list-group-item list-group-item-action btn btn-outline-warning border border-warning border-3 rounded">
                                                {{ $anime->title }}
                                            </button>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Pagination --}}

            <div class="">
                {{ $animes->links() }}
            </div>
        </div>

    </section>
@endsection
