<div>


        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-1">
                    @if($display == 'search')
                        <input type="checkbox"
                               class="resource-selection"
                               value="{{ $item['index'] }}:{{ $item['database'] }}:{{ $item['an'] }}"
                               data-index="{{ $item['index'] }}"
                               data-database="{{ $item['database'] }}"
                               data-an="{{ $item['an'] }}"
                               wire:click="$emit('select', $event.target.checked,'{{ $item['index'] }}', '{{ $item['database'] }}', '{{ $item['an'] }}')"
                        />
                    @endif
                    <a href="{{ $item['detail_link'] }}" class="">
                        <img src="{{ $item['thumbnail'] }}" class="img-fluid shadow" alt="" style="background:url({{ \App\Enums\Thumbnail::keyForName(\Illuminate\Support\Str::of($item['format'])->replace('/', '')->snake()) }}); background-size: cover; width: 100%; max-width: 98px; height: auto; min-height: 98px;">
                    </a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-11">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="mb-1 text-base uppercase">
                                <span class="cursor-pointer align-middle mr-1" wire:click="$emit('setFormatFacet', '{{ $item['format'] }}')" title="Filter to {{ $item['format'] }}">{{ $item['format'] }}</span>|<span class="cursor-pointer align-middle ml-1" wire:click="$emit('setContentProviderFacet', '{{ $item['database_label'] }}')" title="Filter to {{ $item['database_label'] }}">{{ $item['database_label'] }}</span>
                            </div>
                            <h3 class="card-title text-xl capitalize font-bold">
                                <a href="{{ $item['detail_link'] }}" class="meta title">{!! Str::of(html_entity_decode( $item['title'] ))->beforeLast(' / ')->replaceMatches('/\[electronic resource\]/', '') !!}</a>
                            </h3>
                        </div>
                        <div class="col-md-2 lg:text-right">
                            <i class="fas fa-heart cursor-pointer mr-2 cursor-pointer"
                               style="@if($item['liked']) color: red;@endif"
                               wire:click="toggleLike('{{ $item['index'] }}', '{{ $item['database'] }}', '{{ $item['an'] }}')"
                            ></i>

                            @livewire('modules.search.folder-dropdown', ['index' => $item['index'], 'database' => $item['database'], 'an' => $item['an']], key($item['an']))

                            <i class="fas fa-quote-right mr-2 cursor-pointer" wire:click="$emit('cite', '{{ $item['index'] }}', '{{ $item['database'] }}', '{{ $item['an'] }}')"></i>

                            <span class="dropdown">
                                <i class="fas fa-ellipsis-v mr-2 cursor-pointer"
                                   type="button"
                                   id="tools_{{ $item['an'] }}"
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                ></i>
                                <div class="dropdown-menu dropdown-menu-right"
                                     aria-labelledby="tools_{{ $item['an'] }}"
                                >
                                    <a href="http://www.refworks.com/express/ExpressImport.asp?vendor=McKay%20Library&filter=RIS%20Format&url={{ urlencode( route('export.refworks', ['records' => $item['index'] . ':' . $item['database'] . ':' . $item['an']])) }}"
                                       class="dropdown-item"
                                       target="export">
                                        Export to RefWorks
                                    </a>
                                    @if($item['database'] == 'cat03146a')
                                        <span wire:click="$emit('showMarcRecord', '{{ explode('.', $item['an'])[1] }}')"
                                              class="dropdown-item"
                                        >
                                            MARC Record
                                        </span>
                                    @endif
                                </div>
                            </span>
                        </div>
                    </div>

                    {{--{!! html_entity_decode($item['publication']) !!}--}}
                    <span class="meta author capitalize">
                        {!! Str::of(html_entity_decode( $item['author'] ))->replaceMatches('/<br \/>/', '; ')->title() !!}
                    </span>
                    @if($item['publication_date'])
                        / {{ $item['publication_date'] }}
                    @endif
                    <p class="card-text mt-2">
                        {!! \Illuminate\Support\Str::limit(html_entity_decode($item['abstract']), 800, '...') !!}
                    </p>

                    <div class="card-text my-2">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ html_entity_decode( $item['full_text_link']['url'] ) }}"
                                   class="btn btn-raspberry rounded-none"
                                   target="_blank"
                                >
                                    {{ $item['full_text_link']['label'] }}
                                </a>
                            </div>
                            <div class="col-md-8">
                                {!! $item['full_text_link']['info'] !!}
                            </div>
                        </div>
                    </div>
                </div>{{--
                <div class="col-sm-12 col-md-1">

                </div>--}}
            </div>


        </div>





</div>
