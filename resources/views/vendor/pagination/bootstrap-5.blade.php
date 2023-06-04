@if ($paginator->hasPages())
    <nav class="d-flex justify-contents-center bg-secondary rounded mt-5">
        <div class="d-flex justify-content-center  flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item mx-3 mt-3 disabled" aria-disabled="true">
                        <span
                            class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5">@lang('pagination.previous')</span>
                    </li>
                @else
                    <li class="page-item mx-3 mt-3">
                        <a class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                            href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item mx-3 mt-3">
                        <a class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                            href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                    </li>
                @else
                    <li class="page-item mx-3 mt-3 disabled" aria-disabled="true">
                        <span
                            class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5">@lang('pagination.next')</span>
                    </li>
                @endif
            </ul>
        </div>

        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-center">
            {{-- <div>
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div> --}}

            <div class=" ">
                <ul class=" pagination m-3 ">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="page-item mx-3  disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                                aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item mx-3 ">
                            <a class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                                href="{{ $paginator->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li class="page-item mx-3  disabled" aria-disabled="true"><span
                                    class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item mx-3  active" aria-current="page"><span
                                            class="page-link text-light border-0 fw-bold px-3 pb-2 bg-dark rounded fs-5">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item mx-3 "><a
                                            class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                                            href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li class="page-item mx-3 ">
                            <a class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                                href="{{ $paginator->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    @else
                        <li class="page-item mx-3  disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                            <span class="page-link text-warning fw-bold px-3 pb-2 bg-dark rounded fs-5"
                                aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
