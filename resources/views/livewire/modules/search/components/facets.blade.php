<div class="accordion sticky-top sticky-offset" id="facets" wire:loading.remove>

    @foreach($facets as $fkey => $facet)

        @if($loop->index == 1)

            <div class="facet card border-0 mt-2">
                <div class="card-header bg-gray-50 border-0 p-1 font-open-sans" id="facet_header_{{ $fkey }}">
                    <h2 class="mb-0 text-black">
                        <div class="text-lg toggle" type="button" data-toggle="collapse" data-target="#date_range" aria-expanded="true" aria-controls="date_range">
                            Creation Date
                        </div>
                    </h2>
                </div>

                <div id="date_range" class="collapse show" aria-labelledby="date_range_header" data-parent="#facets">
                    <div class="card-body bg-gray-50 pt-0">
                        <ul>
                            @foreach([
                                null => 'All Years',
                                1 => 'This Year',
                                2 => 'Last 2 Years',
                                5 => 'Last 5 Years',
                                10 => 'Last 10 Years',
                            ] as $vkey => $value)
                                <li>
                                    <input type="radio" id="date_range_{{ $vkey }}"  wire:model="period" value="{{ $vkey }}">
                                    <label for="date_range_{{ $vkey }}">
                                                        <span class="option">
                                                            {{ $value }}
                                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        @else
        <div class="facet-container">
            <div class="facet card border-0 mt-2">
                <div class="card-header bg-gray-50 border-0 p-1 font-open-sans" id="facet_header_{{ $fkey }}">
                    <h2 class="mb-0">
                        <div class="text-lg toggle text-black font-open-sans @if(!$loop->first) collapsed @endif" type="button" data-toggle="collapse" data-target="#facet_collapse_{{ $fkey }}" aria-expanded="true" aria-controls="facet_collapse_{{ $fkey }}">
                            {{ $facet['name'] }}
                        </div>
                    </h2>
                </div>

                <div id="facet_collapse_{{ $fkey }}" class="collapse @if($loop->first) show @endif" aria-labelledby="facet_header_{{ $fkey }}" data-parent="#facets">
                    <div class="card-body bg-gray-50 pt-0">
                        <ul>
                            @foreach($facet['values'] as $vkey => $value)
                                <li>
                                    <input type="checkbox"
                                           id="{{ $facet['identifier'] }}_{{ $value['action'] }}"
                                           wire:model="facet.{{ $facet['identifier'] }}.{{ $value['action'] }}"
                                           value="{{ $value['action'] }}"
                                    >
                                    <label for="{{ $facet['identifier'] }}_{{ $value['action'] }}">
                                        <span class="option">
                                            {{ $value['name'] }}
                                        </span>
                                        <span class="count">
                                            ({{ $value['count'] }})
                                        </span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

    @endforeach


</div>
<div class="accordion sticky-top sticky-offset" wire:loading style="width: 100%;">
    <div id="loading-container" class="loading-placeholder">
        <div class="facet card border-0 mt-2">
            <div class="card-header bg-gray-50 border-0 p-1">
                <h2 class="mb-0">
                    <div class="text-lg toggle text-black font-open-sans" type="button" data-toggle="collapse" data-target="#date_range" aria-expanded="true" aria-controls="date_range">
                        Source Type
                    </div>
                </h2>
            </div>

            <div class="collapse show" aria-labelledby="date_range_header" data-parent="#facets">
                <div class="card-body bg-gray-50 pt-0">
                    <script>
                        var types = [1,2,3,4,5,7,8,9,10];
                    </script>
                    <ul x-data="types">
                        <template x-for="type in types" :key="type">
                            <li>
                                <input type="checkbox">
                                <label for="">
                                                            <span class="option">
                                                                <span class="text"></span>
                                                            </span>
                                </label>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>
        </div>
        <div class="facet card border-0 mt-2">
            <div class="card-header bg-gray-50 border-0 p-1">
                <h2 class="mb-0">
                    <div class="text-lg toggle text-black font-open-sans" type="button" data-toggle="collapse" data-target="#date_range" aria-expanded="true" aria-controls="date_range">
                        Creation Date
                    </div>
                </h2>
            </div>

            <div class="collapse show" aria-labelledby="date_range_header" data-parent="#facets">
                <div class="card-body bg-gray-50 pt-0">
                    <ul>
                        @foreach([
                            null => 'All Years',
                            1 => 'This Year',
                            2 => 'Last 2 Years',
                            5 => 'Last 5 Years',
                            10 => 'Last 10 Years',
                        ] as $vkey => $value)
                            <li>
                                <input type="radio" id="date_range_{{ $vkey }}"  wire:model="period" value="{{ $vkey }}">
                                <label for="date_range_{{ $vkey }}">
                                                            <span class="option">
                                                                {{ $value }}
                                                            </span>
                                </label>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
