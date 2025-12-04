@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{!! __('Pagination Navigation') !!}">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span>{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a  href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        {!! __('pagination.previous') !!}
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item ms-2">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"> {!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled ms-2" aria-disabled="true">
                    <span> {!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
