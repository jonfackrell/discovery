<div>
    <input type="search" wire:model="term" />

    <ul>
        @foreach($items as $item)
            <li>
                {{ $item->relevancy }}: {!! html_entity_decode( $item->title ) !!}
                <br />
                {!! html_entity_decode( $item->author ) !!}
            </li>
        @endforeach
    </ul>
</div>


