

    @if ($paginator->hasPages())
        <ul class="pagination" role="navigation">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                </li>
            @else
                <li class="page-item">
                    <button type="button" class="page-link" wire:click="previousPage" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled d-none d-md-block" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active d-none d-md-block" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item d-none d-md-block"><button type="button" class="page-link" wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <button type="button" class="page-link" wire:click="nextPage" rel="next" aria-label="@lang('pagination.next')">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    Next <i class="fas fa-chevron-right"></i>
                </span>
                </li>
            @endif
        </ul>
    @endif

