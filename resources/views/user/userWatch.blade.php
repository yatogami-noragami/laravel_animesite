@extends('user.layout.userMasterHomepage')

@section('title', 'Watch')

@section('content')

    {{-- Watch Anime --}}
    <div class="row">
        <div class="col-10 offset-1 ">
            <div class="row">
                <div class="col-lg-8 ">
                    <a href="{{ route('user#anime#details', $anime->id) }}" class=" text-warning">
                        <h6>{{ $anime->title }}</h6>
                    </a>
                    <img src="{{ asset('image/video_goes_here.png') }}" class=" w-100 rounded">
                </div>

            </div>
        </div>
    </div>



    @php
        $button_count = $anime->available_episode;
        $buttons_per_row = 12;
        $num_rows = ceil($button_count / $buttons_per_row);
    @endphp

    <div class="row mt-3">

        {{-- Buttons --}}

        <div class="col-lg-7 offset-lg-1 mb-5">
            <div class="d-flex justify-content-between">
                <a href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => 1]) }}" class=" text-decoration-none">
                    <button type="button" class="btn btn-primary rounded-pill px-lg-5">first</button>
                </a>

                <a @if ($epid == 1) href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => 1]) }}"
                    @else
                        href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => $epid - 1]) }}" @endif
                    class=" text-decoration-none">
                    <button type="button" class="btn btn-primary rounded-pill px-lg-5">previous</button>
                </a>

                <a @if ($epid == $button_count) href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => $button_count]) }}"
                    @else
                        href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => $epid + 1]) }}" @endif
                    class=" text-decoration-none">
                    <button type="button" class="btn btn-primary rounded-pill px-lg-5">next</button>
                </a>

                <a href="{{ route('user#anime#watch', ['id' => $anime->id, 'epid' => $button_count]) }}"
                    class=" text-decoration-none">
                    <button type="button" class="btn btn-primary rounded-pill px-lg-5">last</button>
                </a>
            </div>
        </div>

        {{-- Episodes --}}

        <div class="col-lg-10 mt-3">
            <div class="row">
                @foreach ($episodes as $episode)
                    <div class="col-3 col-md-2 col-lg-1 my-3">
                        <a href="{{ route('user#anime#watch', ['id' => $episode->anime_id, 'epid' => $episode->episode_number]) }}"
                            type="button"
                            class="btn btn-outline-warning px-4
                            @if ($epid == $episode->episode_number) active @endif
                            ">
                            {{ $episode->episode_number }}
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Comments --}}

        <div class="col-lg-7 offset-lg-1 mt-5">
            <div class="row d-flex justify-content-center">
                <button class=" btn btn-light rounded-pill w-lg-25 w-50 " id="commentBtn">show comment section</button>
            </div>

            <div class="row mt-3 " id="commentWrite">

                <div class="col-12 d-flex align-items-center pt-3 ">

                    <form
                        action="{{ route('user#anime#comment', ['userid' => Auth::user()->id, 'animeid' => $anime->id, 'animeepid' => $epid]) }}"
                        method="post" class=" w-100">
                        @csrf
                        <div class=" input-group mb-3 ">
                            <input type="text" name="userComment" class=" form-control" placeholder="Write a comment...">
                            <button class="input-group-text" type=" submit">
                                <span class="input-group-text"><i class="fa-solid fa-paper-plane"></i></span>
                            </button>

                        </div>
                    </form>

                </div>
            </div>

            <div class="row" id="commentRead">
                <div class="col-10 offset-1 mt-5 rounded" style="background-color: #c2c2c2">
                    @if (count($comments) == 0)
                    @else
                        @foreach ($comments as $comment)
                            @if ($anime->id == $comment->anime_id && $epid == $comment->episode_number)
                                <div class="row">

                                    <div class=" col-6 d-flex justify-content-start align-items-center ">
                                        <span class=" text-danger fw-bold">{{ $comment->name }}</span>
                                    </div>

                                    <div class=" col-6 d-flex justify-content-end align-items-center ">
                                        <span class=" text-muted">{{ $comment->created_at->format('j/F/Y') }}</span>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <h6>{{ $comment->description }}</h6>
                                </div>

                                @if ($comment->user_id == $user_id)
                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-end">
                                            <a href="#" class=" text-decoration-none me-3" data-bs-toggle="modal"
                                                data-bs-target="#userCommentEdit">
                                                <i class="fa-solid fa-user-pen text-black fs-5"></i>
                                            </a>

                                            <a href="#" class=" text-decoration-none " data-bs-toggle="modal"
                                                data-bs-target="#userComment">
                                                <i class="fa-solid fa-trash text-black fs-5"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Delete Comment -->
                                    <div class="modal fade" id="userComment" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Confimation
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this comment ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a
                                                        href="{{ route('user#comment#delete', [
                                                            'userid' => $user_id,
                                                            'id' => $comment->anime_id,
                                                            'epid' => $comment->episode_number,
                                                        ]) }}">
                                                        <button type="button" class="btn btn-danger">Confirm</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Comment -->
                                    <div class="modal fade" id="userCommentEdit" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editing the
                                                        comment
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form
                                                    action="{{ route('user#comment#edit', [
                                                        'userid' => $user_id,
                                                        'id' => $comment->anime_id,
                                                        'epid' => $comment->episode_number,
                                                    ]) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <textarea name="userComment" class="form-control" cols="30" rows="5">{{ $comment->description }}</textarea>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Edit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <hr class=" text-dark border-dark border-2">
                            @endif
                        @endforeach
                    @endif

                </div>

            </div>

        </div>

    </div>
@endsection
