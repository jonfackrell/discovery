<div>

    <div class="h-screen flex overflow-hidden bg-gray-100">

        <div class="flex flex-col w-0 flex-1 overflow-hidden">

            <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
                <div class="pt-2 pb-6 md:py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Replace with your content -->
                        @livewire('modules.search.full', ['item' => $item], key($item['database'].$item['an']))
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>

</div>

