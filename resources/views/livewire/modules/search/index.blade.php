<div wire:init="loadResults">

    @include('livewire.modules.search.components.search')

    <br />

    <br />

    <div class="container-fluid">

        <div class="row">


                <div class="col-sm-12 col-md-2 bg-gray-50 pr-0 pt-2">

                    @include('livewire.modules.search.components.facets')

                </div>

                <div class="col-sm-12 col-md-10 pl-0">

                    <div class="results">

                        <div class="">
                            @include('livewire.modules.search.components.pagination')
                        </div>

                        @if($items)

                            <div class="list card">
                                <div class="card-body pt-0 px-0" wire:loading.remove>
                                    @foreach($items as $item)
                                        <div class="summary card hover:bg-gray-75"
                                             data-book="true"
                                             @if($item['database'] == 'cat03146a' && in_array($item['format'], ['Book', 'Map']))
                                                data-bib="{{ explode('.', $item['an'])[1] }}"
                                             @endif
                                        >
                                            @livewire('modules.search.summary', ['item' => $item, 'display' => 'search'], key($item['an']))
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-10">
                                                    <div class="summary-container"
                                                         data-loaded="false"
                                                         @if($item['database'] == 'cat03146a' && in_array($item['format'], ['Book', 'Map']))
                                                            id="{{ explode('.', $item['an'])[1] }}"
                                                         @endif
                                                    ></div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        @else
                            <div class="list card">
                                @include('livewire.modules.search.components.results-loading')
                            </div>
                        @endif

                    </div>


                </div>

        </div>

    </div>

</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.hook('afterDomUpdate', function () {
            $(document).scrollTop(0);
        });
    </script>
@endpush


