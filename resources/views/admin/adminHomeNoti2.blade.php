@extends('admin.layout.adminMasterVIew')

@section('title', 'Requests & Contacts')

@section('content')

    {{-- Back Arrow --}}

    <a href="{{ route('admin#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:2%; left:5%;"></i>
    </a>
    <div class="row mt-5">
        <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">

            {{-- Navbar --}}

            <ul class="nav nav-tabs">
                <li class="nav-item ">
                    <a class="nav-link text-warning" href="{{ route('admin#home#request', ['number' => '012']) }}">Requests
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active position-relative"
                        href="{{ route('admin#home#contact', ['number' => '012']) }}">Contacts
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ count($contacts->where('status', 0)) }}</span></a>
                </li>

            </ul>

            {{-- Sortings --}}

            <div class="row mt-3">
                <div class="col-md-3 col-8 offset-2 mb-3">
                    <a href="{{ route('admin#home#contact', ['number' => '012']) }}" class=" text-decoration-none mx-md-3">
                        <button class=" btn btn-primary fw-bold w-100">all</button>
                    </a>
                </div>

                <div class="col-md-3 col-8 offset-2 mb-3">
                    <a href="{{ route('admin#home#contact', ['number' => '0']) }}" class=" text-decoration-none mx-md-3 ">
                        <button class=" btn btn-warning fw-bold w-100">pending (s)</button>
                    </a>
                </div>

                <div class="col-md-3 col-8 offset-2 mb-3">
                    <a href="{{ route('admin#home#contact', ['number' => '1']) }}" class=" text-decoration-none mx-md-3 ">
                        <button class=" btn btn-success fw-bold w-100">connected (s)</button>
                    </a>
                </div>

                <div class="col-md-3 col-8 offset-2 ">
                    <a href="{{ route('admin#home#contact', ['number' => '2']) }}" class=" text-decoration-none mx-md-3 ">
                        <button class=" btn btn-danger fw-bold w-100">declined (s)</button>
                    </a>
                </div>

            </div>

            {{-- Contacts --}}

            <div class="row border border-top-0 rounded my-5 ">
                @if (count($contacts) == 0)
                    <h3 class=" text-danger text-center">No message here</h3>
                @else
                    @foreach ($contacts as $contact)
                        <div class="col-md-6 mb-3">
                            <div
                                class="card w-100 @if ($contact->status == 0) bg-light
                            @else
                                bg-secondary @endif">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="card-title fs-4">{{ $contact->name }}</span>
                                        <span
                                            class="card-title  fw-bold
                                        @if ($contact->status == 0) text-warning
                                        @elseif($contact->status == 1)
                                            text-success
                                        @else
                                            text-danger @endif
                                        ">
                                            @if ($contact->status == 0)
                                                pending
                                                <i class="fa-solid fa-spinner"></i>
                                            @elseif($contact->status == 1)
                                                connected
                                                <i class="fa-solid fa-circle-check"></i>
                                            @else
                                                declined
                                                <i class="fa-solid fa-circle-xmark"></i>
                                            @endif
                                        </span>
                                    </div>
                                    <span
                                        class=" card-subtitle text-muted d-block mb-3">{{ $contact->created_at->format('j/F/Y') }}
                                    </span>
                                    <p class="card-text">{{ $contact->description }}</p>

                                    @if ($contact->status == 0)
                                        <div class="row ">
                                            <div class="d-flex justify-content-between">

                                                <a href="#" class=" text-decoration-none text-danger fs-3"
                                                    data-bs-toggle="modal" data-bs-target="#decline">
                                                    <i class="fa-solid fa-circle-xmark"></i>
                                                </a>

                                                <!-- Decline -->
                                                <div class="modal fade" id="decline" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    Confimation
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure to decline this contact ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a href="{{ route('contact#reject', $contact->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-danger">Confirm</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <a href="#" class=" text-decoration-none text-success fs-3"
                                                    data-bs-toggle="modal" data-bs-target="#connect">
                                                    <i class="fa-solid fa-circle-check"></i>
                                                </a>

                                                <!-- Connect -->
                                                <div class="modal fade" id="connect" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    Confimation
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure to connect this contact ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <a href="{{ route('contact#fullfill', $contact->id) }}">
                                                                    <button type="button"
                                                                        class="btn btn-success">Confirm</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination --}}

                    <div class="">
                        {{ $contacts->links() }}
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection
