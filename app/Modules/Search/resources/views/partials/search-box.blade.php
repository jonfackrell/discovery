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
                        <button class="-ml-px relative inline-flex items-center px-4 py-4 border border-gray-300 text-sm leading-5 font-medium text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
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
                                    <input id="source_type" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                                    <input id="language" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                                    <input id="per_page" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                                    <input id="range" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                                    <input id="mode" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
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
                                <input id="peer_review" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <label for="peer_review" class="font-medium text-gray-700">{{ __('Peer Reviewed') }}</label>
                            </div>
                            <div class="flex items-center h-5 pl-8 hidden sm:block">
                                <input id="available" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5 hidden sm:block">
                                <label for="available" class="font-medium text-gray-700">{{ __('Available in Library Collection') }}</label>
                            </div>
                            <div class="flex items-center h-5 pl-8 hidden sm:block">
                                <input id="thesaurus" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5 hidden sm:block">
                                <label for="thesaurus" class="font-medium text-gray-700">{{ __('Apply Related Words') }}</label>
                            </div>
                            <div class="flex items-center h-5 pl-8 hidden sm:block">
                                <input id="subjects" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                            </div>
                            <div class="ml-3 text-sm leading-5 hidden sm:block">
                                <label for="subjects" class="font-medium text-gray-700">{{ __('Apply Related Subjects') }}</label>
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
