<div wire:init="loadResults">

    <div class="container-fluid mt-12">

        <div class="row">


            <div class="col-sm-12 col-md-2 bg-gray-50 pr-0 pt-2">

                <div class="ml-1">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.likes') }}">Liked</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.folders') }}">Folders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Recently Viewed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.preferences') }}">Preferences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Personal Info</a>
                        </li>
                    </ul>


                </div>

            </div>

            <div class="col-sm-12 col-md-10 pl-0">

                <div class="results">

                    <div class="">
                        @include('livewire.modules.search.components.pagination')
                    </div>

                    @if($items)

                        <div class="list card mt-12">
                            <div class="card-header bg-gray-50 border-0 py-2 px-4">
                                <h2 class="mb-0">
                                    <div class="text-xl toggle text-black inline-block font-bold">
                                        <i class="tool fas fa-heart cursor-pointer mr-2" aria-hidden="true"></i>
                                        Liked Resources
                                    </div>
                                    <div class="tool dropdown float-right pt-1" style="display: inline-block;">
                                        <i class="fas fa-ellipsis-v" class="btn btn-secondary dropdown-toggle" type="button" id="tools" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu rounded-none dropdown-menu-right" aria-labelledby="tools">

                                        </div>
                                    </div>
                                </h2>
                            </div>

                            <div class="card-body pt-0 pr-0" wire:loading.remove>
                                @foreach($items as $item)
                                    <div class="summary card"
                                         data-book="true"
                                         @if($item->database == 'cat03146a' && $item->format == 'Book')
                                         data-bib="{{ explode('.', $item->an)[1] }}"
                                        @endif
                                    >
                                        @livewire('modules.search.summary', ['item' => $item, 'display' => 'search'], key($item->an))
                                        <div class="row">
                                            <div class="col-1"></div>
                                            <div class="col-10">
                                                <div class="summary-container"
                                                     data-loaded="false" @if($item['database'] == 'cat03146a' && $item['format'] == 'Book')
                                                     id="{{ explode('.', $item['an'])[1] }}" @endif
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


