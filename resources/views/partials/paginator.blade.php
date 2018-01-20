<nav class="pagination is-rounded is-centered" aria-label="pagination">
    <!-- Previous Page Link -->
    @if ($paginator->onFirstPage())
        <a class="pagination-previous" disabled>Previous</a>
    @else
        <a class="pagination-previous" href="{{ $paginator->previousPageUrl() }}">Previous</a>
    @endif

<!-- Pagination Elements -->
    @foreach ($elements as $element)
    <!-- "Three Dots" Separator -->
        @if (is_string($element))
            <li><span class="pagination-ellipsis">&hellip;</span></li>
        @endif

    <!-- Array Of Links -->
        @if (is_array($element))
            <ul class="pagination-list">
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a class="pagination-link is-current" aria-label="Page {{ $page }}" aria-current="page">{{ $page }}</a></li>
                    @else
                        <li><a class="pagination-link" aria-label="Go to page {{ $page }}" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            </ul>
        @endif
    @endforeach

<!-- Next Page Link -->
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="pagination-next">Next page</a>
    @else
        <a class="pagination-next" disabled>Next page</a>
    @endif
</nav>