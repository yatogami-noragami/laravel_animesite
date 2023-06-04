@extends('admin.layout.adminMasterVIew')

@section('title', 'Comment Details')

@section('content')
    {{-- Back Arrow --}}

    <a href="{{ route('admin#comment#home') }}" class=" text-decoration-none text-secondary">
        <i class="fa-solid fa-arrow-left-long fs-3" style="position: absolute; top:5%; left:5%;"></i>
    </a>

    {{-- Comment Details --}}

    <div class="container mt-5 p-md-5">
        <h3 class=" text-light text-decoration-none fw-bold p-md-0 pt-5">User- <span
                class=" text-warning">{{ $userName }}</span>
        </h3>

        <div class="container p-md-5">
            <div class="row">
                <div class="container p-md-5">
                    @if ($comment->episode_number != 0)
                        <h3 class=" text-light">Title- <a href="{{ route('admin#anime#home#view', $name->id) }}"
                                class="text-warning">{{ $name->title }}</a></h3>

                        <h3 class=" text-light mt-4">Episode- <span
                                class=" text-warning">{{ $comment->episode_number }}</span>
                        </h3>
                    @else
                        <h3 class=" text-light">Title- <a href="{{ route('admin#movie#home#view', $name->id) }}"
                                class="text-warning">{{ $name->title }}</a></h3>
                    @endif

                    <h3 class=" text-light mt-4">Comment- <span class="fs-5 text-warning">{{ $comment->description }}</span>
                    </h3>

                    <h3 class=" text-light mt-4">Commented at- <span
                            class="fs-5 text-warning">{{ $comment->created_at->format('j-F-Y H:i A') }}</span>
                    </h3>

                    @if ($comment->created_at != $comment->updated_at)
                        <h3 class=" text-light mt-4">Edited at- <span
                                class="fs-5 text-warning">{{ $comment->updated_at->format('j-F-Y H:i A') }}</span>
                        </h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
