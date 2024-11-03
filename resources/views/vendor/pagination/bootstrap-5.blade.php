<!-- resources/views/vendor/pagination/bootstrap-5.blade.php -->

@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination justify-content-center">
            <!-- Previous Page Link -->
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="bi bi-chevron-left"></i> Previous
                    </span>
                </li>
            @else
                <li class="page-item ms-1">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="bi bi-chevron-left"></i> Previous
                    </a>
                </li>
            @endif

            <!-- Pagination Elements -->
            @foreach ($elements as $element)
                <!-- "Three Dots" Separator -->
                @if (is_string($element))
                    <li class="page-item ms-1 disabled" aria-disabled="true" aria-label="{{ $element }}">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                <!-- Array Of Links -->
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item ms-1 active" aria-current="page" aria-label="{{ __('Page :page', ['page' => $page]) }}">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item ms-1">
                                <a class="page-link" href="{{ $url }}" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <!-- Next Page Link -->
            @if ($paginator->hasMorePages())
                <li class="page-item ms-1">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        Next <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item ms-1 disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">
                        Next <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
