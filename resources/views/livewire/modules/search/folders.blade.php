<div wire:init="loadResults">

    <div class="container-fluid mt-12">

        <div class="row">


            <div class="col-sm-12 col-md-2 bg-gray-50 pr-0 pt-2">

                <div class="ml-1">

                    @include('Search::account.sidebar')

                </div>

            </div>

            <div class="col-sm-12 col-md-10 pl-0">

                <div class="results">

                    @if($invite)
                        <div style="margin-top: 55px;">
                            <div class="card m-2">
                                <div class="card-header text-lg">
                                    Share
                                </div>
                                <div class="card-body">

                                    <div class="card-text">
                                        <div class="input-group mb-3">
                                            <input type="text"
                                                   id="shareable-folder-link"
                                                   class="form-control rounded-none"
                                                   placeholder="Shareable Link"
                                                   aria-label="Shareable Link"
                                                   aria-describedby="shareable-link"
                                                   value="{{ $folder->shareable_link }}"
                                            >
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary rounded-none"
                                                        type="button"
                                                        id="shareable-link"
                                                        onclick="copy('shareable-folder-link')"
                                                >
                                                    COPY LINK
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card m-2">
                            <div class="card-header text-lg">
                                Invite
                            </div>
                            <div class="card-body">

                                <div class="card-text w-full">
                                    <form class="w-full share-folder-form" wire:submit.prevent="$emit('shareFolderWithUser', Object.fromEntries(new FormData($event.target)))">
                                        <label for="user" aria-hidden="true">Search Users</label>
                                        <div class="input-group mb-3 rounded-none w-full" wire:ignore>

                                            <select class="form-control share-folder-select rounded-none w-full" id="user" name="user">

                                            </select>

                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary rounded-none" type="submit" id="share-folder-submit">
                                                    SHARE FOLDER
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                @if(!empty($users))
                                    <ul class="list-group">
                                        @foreach($users as $user)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $user['name'] }} ({{ $user['email'] }})
                                                <div class="badge">
                                                    <button class="btn btn-sm btn-danger" wire:click="$emit('unShareFolderWithUser', {{ $user['id'] }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>
                        </div>
                        </div>
                    @elseif($settings)
                        <div style="margin-top: 55px;">
                            <div class="card m-2">
                            <div class="card-header text-lg">
                                Folder Settings
                            </div>
                            <div class="card-body">

                                <div class="card-text w-full">
                                    <form class="w-full" wire:submit.prevent="$emit('updateSettings', Object.fromEntries(new FormData($event.target)))">

                                        <div>
                                            I'm not sure what goes here:
                                            <ul>
                                                <li>Public for Librarians</li>
                                                <li>Delete</li>
                                                <li>Move</li>
                                            </ul>
                                        </div>

                                        <button class="btn btn-outline-secondary rounded-none" type="submit" id="share-folder-submit">
                                            UPDATE
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                        </div>
                    @elseif($cite)
                        <div style="margin-top: 55px;">
                            <div class="card m-2">
                            <div class="card-header text-lg">
                                Generate References for {{ $folder->name }}
                            </div>
                            <div class="card-body">
                                <div class="card-text w-full">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <form class="w-full" wire:submit.prevent="$emit('generateReferences', Object.fromEntries(new FormData($event.target)))">

                                                <div class="input-group mb-3">
                                                    <select class="form-control rounded-none" name="format" aria-describedby="generate-references">
                                                        <option value="abnt" @if($format == 'abnt') selected @endif>ABNT</option>
                                                        <option value="ama" @if($format == 'ama') selected @endif>AMA</option>
                                                        <option value="apa" @if($format == 'apa') selected @endif>APA</option>
                                                        <option value="chicago" @if($format == 'chicago') selected @endif>Chicago/Turabian: Author-Date</option>
                                                        <option value="harvard" @if($format == 'harvard') selected @endif>Harvard</option>
                                                        <option value="mla" @if($format == 'mla') selected @endif>MLA</option>
                                                        <option value="turabian" @if($format == 'turabian') selected @endif>Chicago/Turabian: Humanities</option>
                                                        <option value="vancouver" @if($format == 'vancouver') selected @endif>Vancouver/ICMJE</option>
                                                    </select>
                                                    <div class="input-group-append" id="generate-references">
                                                        <button class="btn btn-outline-secondary rounded-none" type="submit" id="share-folder-submit">
                                                            GENERATE
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- TODO: Add select option for citation style -->

                                            </form>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-2" role="alert">
                                                <p>Always make any necessary corrections before using. Pay special attention to personal names, capitalization, and dates.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($citations)
                                <div class="card-body" wire:loading.remove>
                                    <div class="card-text w-full">
                                        @foreach($citations as $citation)
                                            @if($loop->first)
                                                <p style="text-align: center;">
                                                    {!! $citation['SectionLabel'] !!}
                                                </p>
                                            @endif
                                            <div class="col-10">
                                                <p style="line-height: 2; margin-left: 40px; text-indent: -40px;">
                                                    {!! $citation['Data'] !!}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="loading-placeholder" wire:loading>
                                <div class="row">
                                    <div class="col-10 ml-4">
                                        @foreach($items as $item)
                                            <div class="mb-3" style="margin-left: 40px; text-indent: -40px;">
                                                <div class="text line cite"></div>
                                                @if(random_int(0, 1) == 1)
                                                    <div class="text line cite"></div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    @elseif($items)

                        <div class="">
                            <nav aria-label="Search Results Pagination">

                                <div class="results-count">
                                    @livewire('modules.search.bulk-action')
                                </div>
                                {!! $pagination !!}
                            </nav>
                        </div>

                        <div class="list card mt-12">
                            <div class="card-header bg-gray-50 border-0 py-2 px-4">
                                <h2 class="mb-0">
                                    <div class="text-xl toggle text-black inline-block font-bold">
                                        <i class="tool fas fa-folder cursor-pointer mr-2" aria-hidden="true"></i>
                                        @if($activeFolder)
                                            {{ $folder->name }}
                                        @else
                                            Folders
                                        @endif
                                    </div>
                                    <div class="tool dropdown float-right pt-1" style="display: inline-block;">
                                        @if($activeFolder)
                                            <i class="tool fas fa-quote-right mr-4 cursor-pointer"
                                               wire:click="$emitSelf('toggleCite', true)"
                                               title="Generate References"
                                            ></i>
                                            <i class="tool fas fa-share-alt mr-4 cursor-pointer"
                                               wire:click="$emitSelf('toggleInvite', true)"
                                               title="Share & Invite"
                                            ></i>
                                            <i class="tool fas fa-cog mr-4 cursor-pointer"
                                               wire:click="$emitSelf('toggleSettings', true)"
                                               title="Folder Options"
                                            ></i>
                                        @endif
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
                                {{--@if(!empty($folderItems))
                                    {!! $folderItems->links() !!}
                                @endif--}}
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

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
@endpush


