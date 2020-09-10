<div>
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
                    <button  x-on:click="mobileMenu = ! mobileMenu"
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
                                <div>
                                    <button x-on:click="CreationDate = !CreationDate"
                                            class="mt-1 text-xl group w-full flex items-center pl-2 pr-1 py-1 leading-5 font-medium rounded-md bg-white text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
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
                                            <span class="group w-full flex items-center pl-11 pr-2 py-0 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
                                                <div class="group flex items-center px-3 py-1 leading-5 font-medium text-gray-900 rounded-md hover:text-black focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
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
                                                            <span class="option">
                                                                {{ $value }}
                                                            </span>
                                                        </label>
                                                    </span>
                                                </div>
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div>
                                <button  x-on:click="{{ $facet['identifier'] }} = !{{ $facet['identifier'] }}"
                                        class="mt-1 group w-full flex items-center pl-2 pr-1 py-1 text-xl leading-5 font-medium rounded-md bg-white text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition ease-in-out duration-150">
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
                                        <div class="group flex items-center px-3 py-1 -mb-1 leading-5 font-medium focus:outline-none focus:bg-gray-300 transition ease-in-out duration-150 cursor-pointer"
                                             aria-current="page">
                                            <input type="checkbox"
                                                   id="{{ Str::of($facet['identifier'] . '_' . $value['action'])->slug() }}"
                                                   wire:model="{{ $facet['identifier'] }}"
                                                   value="{{ $value['action'] }}"
                                                   class="flex-shrink-0 -ml-1 mr-1 h-3 w-3 text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600 transition ease-in-out duration-150"
                                            >
                                            <span class="truncate">
                                                <label for="{{ Str::of($facet['identifier'] . '_' . $value['action'])->slug() }}" title="{{ Str::of($value['name'])->title() }}">
                                                    <span class="option">
                                                        {{ Str::of($value['name'])->title() }}
                                                    </span>
                                                </label>
                                            </span>
                                            <span title="{{ number_format( $value['count'] ) }}"
                                                  class="ml-auto inline-block py-0.5 pl-1 pr-1 leading-4 rounded-full group-focus:bg-gray-100 transition ease-in-out duration-150">
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
</div>
