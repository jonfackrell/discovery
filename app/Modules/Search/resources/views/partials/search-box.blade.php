
<div x-data="{
        showAdvancedSearch: {{ ($advanced == "true") ? 'true' : 'false' }},
    }">

    <form wire:submit.prevent="search(Object.fromEntries(new FormData($event.target)))">
        <input type="hidden" name="advanced" x-bind:value="showAdvancedSearch"/>
        <div class="container mx-auto"
    >
            <div class="flex flex-col pt-6 sm:px-6 lg:px-8">
                <div>
                    <label for="field" class="sr-only">{{ __('Search terms') }}</label>
                    <div class="mt-1 flex relative shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center">
                            <select name="field"
                                    id="field"
                                    aria-label="Enter search terms"
                                    class="form-select h-full py-4 pl-3 pr-7 border-transparent bg-transparent text-black sm:text-sm sm:leading-5">
                                <option value="KW" @if((isset($field) && 'KW' == $field) || (empty($field))) selected @endif>
                                    {{ __('Keyword') }}
                                </option>
                                @foreach(collect($info['AvailableSearchCriteria']['AvailableSearchFields']) as $option)
                                    <option value="{{ $option['FieldCode'] }}" @if((isset($field) && $option['FieldCode'] == $field)) selected @endif>
                                        {{ ($option['Label'] != 'All Text') ? __($option['Label']) : __('Any Field') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input name="term"
                               id="term"
                               class="form-input block w-full py-4 pl-32 sm:text-sm sm:leading-5"
                               placeholder="{{ __('Search') }}..."
                               value="{{ isset($term)?$term:'' }}"
                        >
                        @if(setting('hiddenfilters'))
                            <button x-on:click="showhiddenfilters = true"
                                    x-on:click.away="showhiddenfilters = false"
                                    class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                <!-- Heroicon name: sort-ascending -->
                                <svg class="h-5 w-5 text-gray-400"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                {{--<span class="ml-2">Sort</span>--}}
                            </button>
                        @endif
                        <button class="-ml-px relative inline-flex items-center px-4 py-4 border border-gray-300 text-sm leading-5 btn-raspberry hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                            <span class="text-uppercase">{{ __('Search') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            <div x-show="showAdvancedSearch"
                 class=""
            >
                <div class="flex flex-col pt-2 sm:px-6 lg:px-8">
                    <div>
                        <label for="field_2" class="sr-only">{{ __('Search terms') }}</label>
                        <div class="mt-1 flex relative shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <select name="field_2"
                                        id="field_2"
                                        aria-label="Enter search terms"
                                        class="form-select h-full py-4 pl-3 pr-7 border-transparent bg-transparent text-black sm:text-sm sm:leading-5"
                                >
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableSearchFields']) as $option)
                                        <option value="{{ $option['FieldCode'] }}" @if((isset($criteria['field_2']) && $option['FieldCode'] == $criteria['field_2']) || ($option['FieldCode'] == 'TX' && empty($criteria['field_2']))) selected @endif>
                                            {{ ($option['Label'] != 'All Text') ? __($option['Label']) : __('Any Field') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input name="term_2"
                                   id="term_2"
                                   class="form-input block w-full py-4 pl-32 sm:text-sm sm:leading-5"
                                   placeholder="{{ __('Search') }}..."
                                   value="{{ isset($criteria['term_2'])?$criteria['term_2']:'' }}"
                            >
                        </div>
                    </div>
                </div>

                <div class="flex flex-col pt-2 sm:px-6 lg:px-8">
                    <div>
                        <label for="field_3" class="sr-only">{{ __('Search terms') }}</label>
                        <div class="mt-1 flex relative shadow-sm">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <select name="field_3"
                                        id="field_3"
                                        aria-label="Enter search terms"
                                        class="form-select h-full py-4 pl-3 pr-7 border-transparent bg-transparent text-black sm:text-sm sm:leading-5"
                                >
                                    @foreach(collect($info['AvailableSearchCriteria']['AvailableSearchFields']) as $option)
                                        <option value="{{ $option['FieldCode'] }}" @if((isset($criteria['field_3']) && $option['FieldCode'] == $criteria['field_3']) || ($option['FieldCode'] == 'TX' && empty($criteria['field_3']))) selected @endif>
                                            {{ ($option['Label'] != 'All Text') ? __($option['Label']) : __('Any Field') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input name="term_3"
                                   id="term_3"
                                   class="form-input block w-full py-4 pl-32 sm:text-sm sm:leading-5"
                                   placeholder="{{ __('Search') }}..."
                                   value="{{ isset($criteria['term_3'])?$criteria['term_3']:'' }}"
                            >
                        </div>
                    </div>
                </div>

                <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 sm:px-6 lg:px-4">
                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-1">
                                <label for="source_type" class="mt-2 block text-sm font-medium leading-5 text-gray-700">
                                    {{ __('Source Type') }}
                                </label>
                            </div>

                            <div class="sm:col-span-3">
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300
                                                   focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                                                   sm:text-sm sm:leading-5"
                                            name="source_type"
                                            id="source_type">
                                        <option value="" @if(! empty($SourceType) && $SourceType[0] == 'any' || empty($SourceType[0])) selected @endif>{{ __('Any') }}</option>
                                        <option value="Academic Journals" @if(! empty($SourceType) && $SourceType[0] == 'Academic Journals') selected @endif>{{ __('Articles') }}</option>
                                        <option value="Audio" @if(! empty($SourceType) && $SourceType[0] == 'Audio') selected @endif>{{ __('Audio') }}</option>
                                        <option value="Audiobooks" @if(! empty($SourceType) && $SourceType[0] == 'Audiobooks') selected @endif>{{ __('Audiobooks') }}</option>
                                        <option value="Books" @if(! empty($SourceType) && $SourceType[0] == 'Books') selected @endif>{{ __('Books') }}</option>
                                        <option value="Dissertations" @if(! empty($SourceType) && $SourceType[0] == 'Dissertations') selected @endif>{{ __('Thesis & Dissertations') }}</option>
                                        <option value="Magazines" @if(! empty($SourceType) && $SourceType[0] == 'Magazines') selected @endif>{{ __('Magazines') }}</option>
                                        <option value="Maps" @if(! empty($SourceType) && $SourceType[0] == 'Maps') selected @endif>{{ __('Maps') }}</option>
                                        <option value="Music Scores" @if(! empty($SourceType) && $SourceType[0] == 'Music Scores') selected @endif>{{ __('Music Scores') }}</option>
                                        <option value="News" @if(! empty($SourceType) && $SourceType[0] == 'News') selected @endif>{{ __('Newspapers') }}</option>
                                        <option value="Print Books" @if(! empty($SourceType) && $SourceType[0] == 'Print Books') selected @endif>{{ __('Print Books') }}</option>
                                        <option value="Videos" @if(! empty($SourceType) && $SourceType[0] == 'Videos') selected @endif>{{ __('Video') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-1">
                                <label for="language" class="mt-2 block text-sm font-medium leading-5 text-gray-700">
                                    {{ __('Language') }}
                                </label>
                            </div>

                            <div class="sm:col-span-3">
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300
                                                   focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                                                   sm:text-sm sm:leading-5"
                                            name="language"
                                            id="language">
                                        <option value="" @if(empty($language)) selected @endif> -- {{ __('Select a Language') }} -- </option>
                                        @foreach(collect($info['AvailableSearchCriteria']['AvailableLimiters'])->where('Id', 'LA99')->first()['LimiterValues'] as $option)
                                            <option value="{{ $option['Value'] }}" @if($option['Value'] == $language) selected @endif>{{ $option['Value'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 sm:px-6 lg:px-4">
                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-1">
                                <label for="per_page" class="mt-2 block text-sm font-medium leading-5 text-gray-700">
                                    {{ __('Results Per Page') }}
                                </label>
                            </div>

                            <div class="sm:col-span-3">
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300
                                                   focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                                                   sm:text-sm sm:leading-5"
                                            name="count"
                                            id="count">
                                        <option value="10" @if($count == 10) selected @endif>10</option>
                                        <option value="20" @if($count == 20) selected @endif>20</option>
                                        <option value="30" @if($count == 30) selected @endif>30</option>
                                        <option value="40" @if($count == 40) selected @endif>40</option>
                                        <option value="50" @if($count == 50) selected @endif>50</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-1">
                                <label for="range" class="mt-2 block text-sm font-medium leading-5 text-gray-700">
                                    {{ __('Date Range') }}
                                </label>
                            </div>

                            <div class="sm:col-span-3">
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300
                                                   focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                                                   sm:text-sm sm:leading-5"
                                            name="period"
                                            id="period">
                                        <option value="" @if(empty($period)) selected @endif>{{ __('All Years') }}</option>
                                        <option value="1" @if($period == 1) selected @endif>{{ __('This Year') }}</option>
                                        <option value="2" @if($period == 2) selected @endif>{{ __('Last 2 Years') }}</option>
                                        <option value="5" @if($period == 3) selected @endif>{{ __('Last 5 Years') }}</option>
                                        <option value="10" @if($period == 4) selected @endif>{{ __('Last 10 Years') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6 sm:px-6 lg:px-4">
                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-1">
                                <label for="mode" class="mt-2 block text-sm font-medium leading-5 text-gray-700">
                                    {{ __('Search Mode') }}
                                </label>
                            </div>

                            <div class="sm:col-span-3">
                                <div class="mt-1 rounded-md shadow-sm">
                                    <select class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300
                                                   focus:outline-none focus:shadow-outline-blue focus:border-blue-300
                                                   sm:text-sm sm:leading-5"
                                            name="mode"
                                            id="mode">
                                        <option value="bool" @if($mode == 'bool') selected @endif>{{ __('Boolean / Phrase') }}</option>
                                        <option value="all" @if($mode == 'all') selected @endif>{{ __('Find all my search terms') }}</option>
                                        <option value="any" @if($mode == 'any') selected @endif>{{ __('Find any of my search terms') }}</option>
                                        <option value="smart" @if($mode == 'smart' || empty($mode)) selected @endif>{{ __('SmartText Searching') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <div class="mt-2 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-4 sm:px-6 lg:px-8">
                            <div class="sm:col-span-2">
                                <div class="flex items-baseline h-5 pl-8">
                                    <input id="thesaurus" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <label for="thesaurus" class="font-medium text-gray-700">{{ __('Apply Related Words') }}</label>
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <div class="flex items-baseline h-5 pl-8">
                                    <input id="subjects" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <label for="subjects" class="font-medium text-gray-700">{{ __('Apply Related Subjects') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="flex justify-between h-8 mt-4">
                <div class="flex">
                    <div class="sm:-my-px sm:ml-6 sm:flex">
                        <div class="relative flex items-start">
                            <div x-on:click="mobileMenu = ! mobileMenu"
                                 class="flex items-center md:hidden">
                                <svg class="h-5 w-5 cursor-pointer"
                                     fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                    <path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                            </div>
                            <div class="flex items-center h-5 pl-32">
                                <input wire:model="peer_review"
                                       id="peer_review"
                                       type="checkbox"
                                       class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                >
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="peer_review" class="font-medium text-gray-700">{{ __('Peer Reviewed') }}</label>
                            </div>
                            <div class="flex items-center h-5 pl-8">
                                <input id="available" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="available" class="font-medium text-gray-700">{{ __('Available in Library Collection') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mr-8 sm:ml-6 sm:flex sm:items-center">
                    <div class="ml-3 relative sm:-mt-4">
                        <div>
                            <span x-on:click="showAdvancedSearch = !showAdvancedSearch"
                                  class="inline-flex items-center px-1 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out text-uppercase cursor-pointer">
                                {{ __('Advanced Search') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
