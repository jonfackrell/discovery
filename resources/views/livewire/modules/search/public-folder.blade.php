@extends('layouts.app')

@section('content')
    <div>

    <div class="container-fluid mt-12">

        <div class="row">


            <div class="col-sm-12 col-md-2">

                {{--<div class="ml-1">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.likes') }}">Liked</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="{{ route('account.folders') }}">Folders</a>
                            <div id="folder-nav">
                                <ul class="folders ml-4">
                                    @foreach ($folders as $key => $folder)
                                        <li>
                                            <div class="cursor-pointer p-1" wire:click="$set('activeFolder', {{ $folder->id }})">
                                                <i class="far fa-folder"></i>
                                                {{ $folder->name }}
                                            </div>

                                            <ul class="ml-2">
                                                @foreach ($folder->subFolders as $subFolder)
                                                    @include('livewire.modules.search.sub-folder-navigation', ['sub_folder' => $subFolder])
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Recently Viewed</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Preferences</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-lg text-black font-open-sans uppercase" href="#">Personal Info</a>
                        </li>
                    </ul>


                </div>--}}

            </div>

            <div class="col-sm-12 col-md-8 pl-0">

                <div class="results">

                    <div class="">
                        {{--@include('livewire.modules.search.components.pagination')--}}
                    </div>

                    @if($items)

                        <div class="list card mt-12">
                            <div class="card-header bg-gray-50 border-0 py-2 px-4">
                                <h2 class="mb-0">
                                    <div class="text-xl toggle text-black inline-block font-bold">
                                        <i class="tool fas fa-folder cursor-pointer mr-2" aria-hidden="true"></i>
                                        {{ $folder->name }}
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
                                        @livewire('modules.search.summary', ['item' => $item, 'display' => 'search'], key($item->an.rand()))
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
                            @if(!empty($folderItems))
                                {!! $folderItems->links() !!}
                            @endif
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
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.summary[data-book="true"]').each(function (i, val) {
                var $resource = $(this);
                if($resource.find('#'+ $resource.data('bib')).data('loaded') == false){
                    showSummary($resource.data('bib'), $resource.find('#'+ $resource.data('bib')));
                }
            });
            $('.folders').each(function (i, val) {
                var $folderDropdown = $(this);
                if($folderDropdown.find('.fa-check-square').length > 0){
                    $folderDropdown.parents('.dropdown').find('.fa-folder').addClass('folder-yellow');
                }else{
                    $folderDropdown.parents('.dropdown').find('.fa-folder').removeClass('folder-yellow');
                }
            });
        });
    </script>
@endpush
