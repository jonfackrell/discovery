
<div>
    <div>
        @include('Search::partials.search-box')
    </div>


    <div class="flex overflow-hidden bg-gray-100">

        <div>
            @include('Search::partials.facets')
        </div>


        <div class="flex flex-col w-0 flex-1 overflow-hidden">

            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
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
        </div>
    </div>

</div>


