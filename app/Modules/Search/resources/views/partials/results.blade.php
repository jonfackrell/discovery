
<div>
    <div>
        @include('Search::partials.search-box')
    </div>


    <div class="flex overflow-hidden bg-gray-100">

        <div>
            @include('Search::partials.facets')
        </div>


        <div class="flex flex-col w-0 flex-1 overflow-hidden">

            <main wire:loading.remove
                  class="flex-1 relative z-0 overflow-y-auto focus:outline-none"
                  tabindex="0">
                <div class="">
                    <div class="mx-auto">
                        <!-- Replace with your content -->
                        @foreach($items as $item)
                            @livewire('modules.search.summary', ['item' => $item], key($item['database'].$item['an']))
                        @endforeach
                        <!-- /End replace -->
                    </div>
                </div>
            </main>

            <div wire:loading
                 class="w-full h-full relative block top-0 left-0 bg-white opacity-75 z-50">
                <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0"
                      style="top: 10%;">
                    <i class="fas fa-circle-notch fa-spin fa-5x"></i>
                </span>
            </div>
        </div>
    </div>

</div>


