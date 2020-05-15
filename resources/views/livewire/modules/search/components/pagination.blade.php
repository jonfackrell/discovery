<nav aria-label="Search Results Pagination">

    <div class="results-count">
        @livewire('modules.search.bulk-action')
        <span wire:loading.remove>Results: {{ $total }}</span>
    </div>

    <ul class="pagination">
        @if(ceil(($total/25)) > 1)
            @if($page != 1)
                <li class="page-item"><a class="page-link" wire:click="$set('page', {{ $page - 1 }})"><i class="fas fa-chevron-left"></i> Previous</a></li>
            @endif
            @if($page > 1)
                @for($i = -1; $i <= min(intval($total/25 - 2), 1); $i++)
                    <li class="page-item"><a class="page-link @if($page == ($page + $i)) active @endif" wire:click="$set('page', {{ ($page + $i) }})">{{ ($page + $i) }}</a></li>
                @endfor
                <li class="page-item"><a class="page-link" wire:click="$set('page', {{ $page + 1 }})">Next <i class="fas fa-chevron-right"></i></a></li>
            @else
                @for($i = 0; $i < 3; $i++)
                    <li class="page-item"><a class="page-link @if($page == ($page + $i)) active @endif" wire:click="$set('page', {{ ($page + $i) }})">{{ ($page + $i) }}</a></li>
                @endfor
                @if($page < ceil(($total/25)))
                    <li class="page-item"><a class="page-link" wire:click="$set('page', {{ ($page + 1) }})">Next <i class="fas fa-chevron-right"></i></a></li>
                @endif
            @endif
        @endif
    </ul>
</nav>
