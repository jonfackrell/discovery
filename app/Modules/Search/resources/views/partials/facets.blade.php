<div>

    @if(! setting('hiddenfilters'))

        <!-- Off-canvas menu for mobile -->
        <div x-show="mobileMenu"
             class="md:hidden">
            <div class="fixed inset-0 flex z-40">
                <!--
                  Off-canvas menu overlay, show/hide based on off-canvas menu state.

                  Entering: "transition-opacity ease-linear duration-300"
                    From: "opacity-0"
                    To: "opacity-100"
                  Leaving: "transition-opacity ease-linear duration-300"
                    From: "opacity-100"
                    To: "opacity-0"
                -->
                <div class="fixed inset-0">
                    <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                </div>
                <!--
                  Off-canvas menu, show/hide based on off-canvas menu state.

                  Entering: "transition ease-in-out duration-300 transform"
                    From: "-translate-x-full"
                    To: "translate-x-0"
                  Leaving: "transition ease-in-out duration-300 transform"
                    From: "translate-x-0"
                    To: "-translate-x-full"
                -->
                <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-white">
                    <div class="absolute top-0 right-0 -mr-14 p-1">
                        <button x-on:click="mobileMenu = ! mobileMenu"
                                class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar">
                            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex-shrink-0 flex items-center px-4">
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-on-white.svg" alt="Workflow">
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto">
                        <nav class="px-2">
                            @foreach($facets as $facetKey => $facet)
                                {{--@if($loop->index == 1)
                                    <div>
                                        <button  x-on:click="CreationDate = !CreationDate"
                                                class="mt-1 group w-full flex items-center pl-2 pr-1 py-1 text-sm leading-5 font-medium rounded-md bg-white text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                        {{ __('Creation Date') }}
                                        <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
                                            <svg :class="{ 'text-gray-400 rotate-90': CreationDate, 'text-gray-300': !CreationDate }"
                                                 class="ml-auto h-5 w-5 transform group-hover:text-gray-400 group-focus:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20">
                                                <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                            </svg>
                                        </button>
                                        <!-- Expandable link section, show/hide based on state. -->
                                        <div x-show="CreationDate"
                                             class="mt-1">
                                            @foreach([
                                                0 => 'All Years',
                                                1 => 'This Year',
                                                2 => 'Last 2 Years',
                                                5 => 'Last 5 Years',
                                                10 => 'Last 10 Years',
                                            ] as $valueKey => $value)
                                                <div class="group flex items-center px-3 py-1 leading-5 font-medium text-gray-900 rounded-md hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                                     aria-current="page">
                                                    <input type="radio"
                                                           id="date_range_{{ $valueKey }}"
                                                           wire:model="period"
                                                           value="{{ $valueKey }}"
                                                           class="flex-shrink-0 -ml-1 mr-1 h-3 w-3"
                                                    >
                                                    <span class="truncate">
                                                        <label for="date_range_{{ $valueKey }}">
                                                            <span class="option">
                                                                {{ $value }}
                                                            </span>
                                                        </label>
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif--}}
                                <div>
                                    <button  x-on:click="{{ $facet['identifier'] }} = !{{ $facet['identifier'] }}"
                                            class="mt-1 group w-full flex items-center pl-2 pr-1 py-1 text-sm leading-5 font-medium rounded-md bg-white text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                        {{ $facet['name'] }}
                                        <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
                                        <svg :class="{ 'text-gray-400 rotate-90': {{ $facet['identifier'] }}, 'text-gray-300': !{{ $facet['identifier'] }} }"
                                             class="ml-auto h-5 w-5 transform group-hover:text-gray-400 group-focus:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20">
                                            <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                        </svg>
                                    </button>
                                    <!-- Expandable link section, show/hide based on state. -->
                                    <div x-show="{{ $facet['identifier'] }}"
                                         class="mt-1">
                                        @foreach($facet['values'] as $valueKey => $value)
                                            <span class="group w-full flex items-center pl-11 pr-2 py-1 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Str::of($value['name'])->title() }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </nav>
                    </div>
                </div>
                <div x-show="mobileMenu"
                     class="flex-shrink-0 w-14">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col" style="width: 22rem;">
                <div class="flex flex-col flex-grow border-r border-gray-200 pt-0 pb-4 bg-white overflow-y-auto">
                    <div class="mt-0 flex-grow flex flex-col">
                        <nav class="flex-1 px-2 bg-white">
                            @foreach($facets as $facetKey => $facet)

                                @if($loop->index == 1)
                                    <div class="mb-2">
                                        <button x-on:click="CreationDate = !CreationDate"
                                                class="mt-1 text-l group w-full flex items-center pl-2 pr-1 py-1 leading-5 font-bold rounded-md bg-white text-black hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                        {{ __('Creation Date') }}
                                        <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
                                            <svg :class="{ 'text-gray-400 rotate-90': CreationDate, 'text-gray-300': !CreationDate }"
                                                 class="ml-auto h-5 w-5 transform group-hover:text-gray-400 group-focus:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20">
                                                <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                            </svg>
                                        </button>
                                        <!-- Expandable link section, show/hide based on state. -->
                                        <div x-show="CreationDate"
                                             class="mt-1">
                                            @foreach([
                                                0 => 'All Years',
                                                1 => 'This Year',
                                                2 => 'Last 2 Years',
                                                5 => 'Last 5 Years',
                                                10 => 'Last 10 Years',
                                            ] as $valueKey => $value)
                                                <span class="group w-full flex items-center pl-2 pr-2 py-0 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                                    <div class="group flex items-center px-3 pb-1 leading-5 font-normal text-black rounded-md hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                                         aria-current="page">
                                                        <input type="radio"
                                                               name="period"
                                                               id="date_range_{{ $valueKey }}"
                                                               wire:model="period"
                                                               value="{{ $valueKey }}"
                                                               class="flex-shrink-0 -ml-1 mr-1 h-3 w-3"
                                                        >
                                                        <span class="truncate">
                                                            <label for="date_range_{{ $valueKey }}">
                                                                <span class="option font-normal text-black text-base">
                                                                    {{ $value }}
                                                                </span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </span>
                                            @endforeach
                                            <div class="mt-4 mx-2 flex justify-center items-center">
                                                <div x-data="range()"
                                                     x-init="setThumbs();"
                                                     class="relative max-w-xl w-full">
                                                    <div>
                                                        <input type="range"
                                                               step="1"
                                                               x-bind:min="min"
                                                               x-bind:max="max"
                                                               x-on:input="mintrigger"
                                                               x-model="from"
                                                               class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                                        <input type="range"
                                                               step="1"
                                                               x-bind:min="min"
                                                               x-bind:max="max"
                                                               x-on:input="maxtrigger"
                                                               x-model="to"
                                                               class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                                        <div class="relative z-10 h-2">

                                                            <div class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200"></div>

                                                            <div class="absolute z-20 top-0 bottom-0 rounded-md bg-byuigrey-400" x-bind:style="'right:'+maxthumb+'%; left:'+minthumb+'%'"></div>

                                                            <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-byuigrey-300 rounded-full -mt-2 -ml-1" x-bind:style="'left: '+minthumb+'%'"></div>

                                                            <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-byuigrey-300 rounded-full -mt-2 -mr-3" x-bind:style="'right: '+maxthumb+'%'"></div>

                                                        </div>

                                                    </div>

                                                    <div class="flex justify-between items-center py-5">
                                                        <div>
                                                            <input type="text" maxlength="4" x-on:input="mintrigger" x-model="from" class="px-3 py-1 border border-gray-200 w-24 text-center">
                                                        </div>
                                                        <div>
                                                            <span class="block w-full rounded-md shadow-sm">
                                                                <button x-on:click="updateDateRange(@this)"
                                                                        class="w-full flex justify-center py-1 px-2 border border-transparent text-sm font-medium btn-raspberry hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                                                Update
                                                                </button>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <input type="text" maxlength="4" x-on:input="maxtrigger" x-model="to" class="px-3 py-1 border border-gray-200 w-24 text-center">
                                                        </div>
                                                    </div>

                                                </div>
                                                <script>
                                                    function range() {
                                                        return {
                                                            from: @entangle('from').defer,
                                                            to: @entangle('to').defer,
                                                            min: {{ $date_range['min'] }},
                                                            max: {{ $date_range['max'] }},
                                                            minthumb: 0,
                                                            maxthumb: 0,

                                                            mintrigger() {
                                                                this.from = Math.min(this.from, parseInt(this.to) - 1);
                                                                this.minthumb = Math.min(((this.from - this.min) / (this.max - this.min)) * 100, 90);
                                                            },

                                                            maxtrigger() {
                                                                this.to = Math.max(this.to, parseInt(this.from) + 1);
                                                                this.maxthumb = Math.min(100 - (((this.to - this.min) / (this.max - this.min)) * 100), 90);
                                                            },

                                                            setThumbs() {
                                                                this.minthumb = Math.min(((this.from - this.min) / (this.max - this.min)) * 100, 90);
                                                                this.maxthumb = Math.min(100 - (((this.to - this.min) / (this.max - this.min)) * 100), 90);
                                                            },

                                                            updateDateRange(wire) {
                                                                wire.call('setDateRange', {
                                                                    'period': 'custom',
                                                                    'from': this.from,
                                                                    'to': this.to,
                                                                });
                                                            }
                                                        }
                                                    }
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-2">
                                    <button x-on:click="{{ $facet['identifier'] }} = !{{ $facet['identifier'] }}"
                                            class="mt-1 group w-full flex items-center pl-2 pr-1 py-1 text-l leading-5 font-bold rounded-md bg-white text-black hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                        {{ $facet['name'] }}
                                        <!-- Expanded: "text-gray-400 rotate-90", Collapsed: "text-gray-300" -->
                                        <svg :class="{ 'text-gray-400 rotate-90': {{ $facet['identifier'] }}, 'text-gray-300': !{{ $facet['identifier'] }} }"
                                             class="ml-auto h-5 w-5 transform group-hover:text-gray-400 group-focus:text-gray-400 transition-colors ease-in-out duration-150" viewBox="0 0 20 20">
                                            <path d="M6 6L14 10L6 14V6Z" fill="currentColor" />
                                        </svg>
                                    </button>
                                    <!-- Expandable link section, show/hide based on state. -->
                                    <div x-show="{{ $facet['identifier'] }}"
                                         class="mt-1 overflow-y-scroll overscroll-contain"
                                         style="max-height: 200px;"
                                    >
                                        @foreach($facet['values'] as $valueKey => $value)
                                            {{--<span class="group w-full flex items-center pl-11 pr-2 py-1 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Str::of($value['name'])->title() }}
                                            </span>--}}
                                            <div class="group flex items-baseline px-3 py-1 -mb-1 leading-5 font-normal focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                                 aria-current="page">
                                                <input type="checkbox"
                                                       id="{{ Str::of($facet['identifier'] . '_' . $value['action'])->slug() }}"
                                                       wire:model="{{ $facet['identifier'] }}"
                                                       value="{{ $value['action'] }}"
                                                       class="flex-shrink-0 ml-2 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150"
                                                >
                                                <span class="">
                                                    <label for="{{ Str::of($facet['identifier'] . '_' . $value['action'])->slug() }}" title="{{ Str::of($value['name'])->title() }}">
                                                        <span class="option font-normal text-black text-base">
                                                            {{ Str::of($value['name'])->title() }}
                                                        </span>
                                                    </label>
                                                </span>
                                                <span title="{{ number_format( $value['count'] ) }}"
                                                      class="ml-auto inline-block py-0.5 pl-1 pr-1 leading-4 font-normal text-black text-base rounded-full group-focus:bg-gray-100 transition ease-in-out duration-150">
                                                    @if($value['count'] < 100000) ({{ number_format( $value['count'] ) }}) @else {{ '(+99,999)' }} @endif
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    @else
            <div x-show="showhiddenfilters"
                 class="fixed inset-0 overflow-hidden z-10">
                <div class="absolute inset-0 overflow-hidden">
                    <!--
                      Background overlay, show/hide based on slide-over state.

                      Entering: "ease-in-out duration-500"
                        From: "opacity-0"
                        To: "opacity-100"
                      Leaving: "ease-in-out duration-500"
                        From: "opacity-100"
                        To: "opacity-0"
                    -->
                    <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                    <section
                             class="absolute inset-y-0 right-0 pl-10 max-w-full flex">
                        <!--
                          Slide-over panel, show/hide based on slide-over state.

                          Entering: "transform transition ease-in-out duration-500 sm:duration-700"
                            From: "translate-x-full"
                            To: "translate-x-0"
                          Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
                            From: "translate-x-0"
                            To: "translate-x-full"
                        -->
                        <div
                             class="w-screen max-w-md">
                            <div class="h-full flex flex-col space-y-6 py-6 bg-white shadow-xl overflow-y-scroll">
                                <header class="px-4 sm:px-6">
                                    <div class="flex items-start justify-between space-x-3">
                                        <h2 class="text-lg leading-7 font-medium text-gray-900">
                                            Panel title
                                        </h2>
                                        <div class="h-7 flex items-center">
                                            <button x-on:click="showhiddenfilters = false"
                                                    aria-label="Close panel" class="text-gray-400 hover:text-gray-500 transition ease-in-out duration-150">
                                                <!-- Heroicon name: x -->
                                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </header>
                                <div class="relative flex-1 px-4 sm:px-6">
                                    <!-- Replace with your content -->
                                    <div class="absolute inset-0 px-4 sm:px-6">
                                        <div class="h-full border-2 border-dashed border-gray-200"></div>
                                    </div>
                                    <!-- /End replace -->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        @endif
</div>

@push('styles')
    <style>
        input[type=range]::-webkit-slider-thumb {
            pointer-events: all;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            /* @apply w-6 h-6 appearance-none pointer-events-auto; */
        }
    </style>
@endpush
