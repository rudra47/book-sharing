@if ($paginator->hasPages())
    <nav>
        <ul class="pager">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="prev disabled" aria-disabled="true"> <a >&larr; Older Posts</a> </li>
            @else
                <li class="prev"> <a href="{{ $paginator->previousPageUrl() }}" rel="prev">&larr; Older Posts</a> </li>
                
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next"> <a href="{{ $paginator->nextPageUrl() }}" rel="next">New Posts &rarr;</a> </li>

            @else
                <li class="next disabled" aria-disabled="true"> <a>New Posts &rarr;</a> </li>

            @endif
        </ul>
    </nav>
@endif
