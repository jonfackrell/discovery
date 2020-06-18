<div class="accordion" id="facets" wire:loading.remove>
    <!-- sticky-top sticky-offset-->
    @foreach($facets as $fkey => $facet)

        @if($loop->index == 1)

            <div class="facet card border-0 mt-2">
                <div class="card-header bg-gray-50 border-0 p-1 font-open-sans hover:bg-gray-75" id="facet_header_{{ $fkey }}">
                    <h2 class="mb-0 text-black">
                        <div class="text-lg toggle" type="button" data-toggle="collapse" data-target="#date_range" aria-expanded="true" aria-controls="date_range">
                            Creation Date
                        </div>
                    </h2>
                </div>

                <div id="date_range" class="collapse show" aria-labelledby="date_range_header" data-parent="#facets">
                    <div class="card-body bg-gray-50 pt-0">
                        <nav>
                            @foreach([
                                null => 'All Years',
                                1 => 'This Year',
                                2 => 'Last 2 Years',
                                5 => 'Last 5 Years',
                                10 => 'Last 10 Years',
                            ] as $vkey => $value)

                                <div class="group flex items-center px-3 py-1 leading-5 font-medium text-gray-900 rounded-md bg-gray-200 hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                     aria-current="page">
                                    <input type="radio" id="date_range_{{ $vkey }}"  wire:model="period" value="{{ $vkey }}" class="flex-shrink-0 -ml-1 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150">
                                    <span class="truncate">
                                        <label for="date_range_{{ $vkey }}">
                                            <span class="option">
                                                {{ $value }}
                                            </span>
                                        </label>
                                    </span>

                                </div>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>

        @else
        <div class="facet-container">
            <div class="facet card border-0 mt-2">
                <div class="card-header bg-gray-50 border-0 p-1 font-open-sans hover:bg-gray-75" id="facet_header_{{ $fkey }}">
                    <h2 class="mb-0">
                        <div class="text-lg toggle text-black font-open-sans @if(!$loop->first) collapsed @endif" type="button" data-toggle="collapse" data-target="#facet_collapse_{{ $fkey }}" aria-expanded="true" aria-controls="facet_collapse_{{ $fkey }}">
                            {{ $facet['name'] }}
                        </div>
                    </h2>
                </div>

                <div id="facet_collapse_{{ $fkey }}" class="collapse @if($loop->first) show @endif" aria-labelledby="facet_header_{{ $fkey }}" data-parent="#facets">
                    <div class="card-body bg-gray-50 pt-0 px-0">
                        <nav>
                            @foreach($facet['values'] as $vkey => $value)
                                <div class="group flex items-center px-3 py-1 -mb-1 leading-5 font-medium text-gray-900 rounded-md bg-gray-200 hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                   aria-current="page">
                                    <input type="checkbox"
                                           id="{{ $facet['identifier'] }}_{{ $value['action'] }}"
                                           wire:model="facet.{{ $facet['identifier'] }}.{{ $value['action'] }}"
                                           value="{{ $value['action'] }}"
                                           class="flex-shrink-0 -ml-1 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150"
                                    >
                                    <span class="truncate">
                                      <label for="{{ $facet['identifier'] }}_{{ $value['action'] }}">
                                        <span class="option">
                                            {{ $value['name'] }}
                                        </span>
                                    </label>
                                    </span>
                                    <span title="{{ number_format( $value['count'] ) }}"
                                          class="ml-auto inline-block py-0.5 pl-1 pr-1 leading-4 rounded-full bg-gray-50 group-focus:bg-gray-100 transition ease-in-out duration-150">
                                      @if($value['count'] < 100000) ({{ number_format( $value['count'] ) }}) @else {{ '(+99,999)' }} @endif
                                    </span>
                                </div>
                            @endforeach
                        </nav>
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
                    <nav x-data="types">
                        <template x-for="type in types" :key="type">
                            <div class="group flex items-center px-0 py-1 -mb-1 leading-5 font-medium text-gray-900 rounded-md bg-gray-200 hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                 aria-current="page">
                                <input type="checkbox"
                                       class="flex-shrink-0 -ml-1 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150">
                                <span class="truncate">
                                    <label for="">
                                        <span class="option">
                                            <span class="text" style="width: 150px;"></span>
                                        </span>
                                    </label>
                                </span>
                            </div>
                        </template>
                    </nav>
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
                    <nav>
                        @foreach([
                            null => 'All Years',
                            1 => 'This Year',
                            2 => 'Last 2 Years',
                            5 => 'Last 5 Years',
                            10 => 'Last 10 Years',
                        ] as $vkey => $value)
                            <div class="group flex items-center px-3 py-1 leading-5 font-medium text-gray-900 rounded-md bg-gray-200 hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                 aria-current="page">
                                <input type="radio" id="date_range_{{ $vkey }}" value="{{ $vkey }}" class="flex-shrink-0 -ml-1 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150">
                                <span class="truncate">
                                        <label for="date_range_{{ $vkey }}">
                                            <span class="option">
                                                {{ $value }}
                                            </span>
                                        </label>
                                    </span>

                            </div>
                        @endforeach

                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
