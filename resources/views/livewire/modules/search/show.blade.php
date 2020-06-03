<div wire:init="loadItem">
    <div class="container-fluid mt-4">
        <div class="container">
    {{--{{ json_encode($item, JSON_PRETTY_PRINT) }}--}}
            @if(!is_null($item))
                <div class="summary card"
                    @if($item->database == 'cat03146a' && in_array($item->format, ['Book', 'Map']))
                        data-book="true"
                        data-bib="{{ explode('.', $item->an)[1] }}"
                    @endif
                >
                    @livewire('modules.search.summary', ['item' => $item, 'display' => 'detailed'], key($item->an))
                    <div class="card-body">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="summary-container"
                                     data-loaded="false"
                                     @if($item['database'] == 'cat03146a' && in_array($item->format, ['Book', 'Map']))
                                        id="{{ explode('.', $item['an'])[1] }}"
                                     @endif
                                ></div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    @if($map)
                        <div class="card-body">
                            <div class="row bg-gray-50">
                                <div class="col-md-2 pl-0">
                                    <div class="floor inline-block px-6 py-2 lg:px-12 lg:py-3">
                                        <div class="text-5xl text-white text-center">
                                            {{ explode(' ', $map->location)[0] }}
                                        </div>
                                        <div class="text-2xl text-white text-center">
                                            {{ explode(' ', $map->location)[1] }}
                                        </div>
                                    </div>
                                    <div class="code absolute bottom-0 left-0 hidden md:inline">
                                        <img src="{{ $qrLink }}"
                                             style="width: 165px; height: 165px;"/>
                                    </div>
                                </div>
                                <div class="col-md-4 p-4">
                                    <div class="font-bold text-xl text-black">
                                        {{ $map->collection }}
                                    </div>
                                    <div class="font-bold text-lg text-black">
                                        {{ $map->range_start }} - {{ $map->range_end }}
                                    </div>
                                    <div class="mt-4 text-lg text-black">
                                        {{ $map->description }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ $map->image }}" target="_blank">
                                        <img src="{{ $map->image }}"
                                             class="p-1 w-auto mx-auto"
                                             style="height: 295px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="details-container">
                        <h4 class="font-bold text-xl mb-2">
                            Details
                        </h4>
                        @foreach($item->details as $detail)
                            <div class="row @if($loop->odd) bg-gray-50 @endif p-2">
                                <div class="col-2">
                                    <span class="font-bold">
                                        {!! $detail['Label'] !!}
                                    </span>
                                </div>
                                <div class="col-10">
                                    @if($detail['Label'] == 'Content Notes')
                                        @foreach(explode(' -- ', $detail['Data']) as $data)
                                            {!! html_entity_decode($data) !!}<br />
                                        @endforeach
                                    @else
                                        {!! html_entity_decode($detail['Data']) !!}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        {{--<h2>
                            Additional Item Details
                        </h2>
                        <div class="row">
                            <div class="col-2">
                                Abstract
                            </div>
                            <div class="col-10">
                                {!! $item->abstract !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                OCLC
                            </div>
                            <div class="col-10">
                                {!! $item->oclc !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Accession Number
                            </div>
                            <div class="col-10">
                                {!! $item->an !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Database
                            </div>
                            <div class="col-10">
                                {!! $item->database_label !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Format
                            </div>
                            <div class="col-10">
                                {!! $item->format !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Language
                            </div>
                            <div class="col-10">
                                {!! $item->language !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Publication Date
                            </div>
                            <div class="col-10">
                                {!! $item->publication_date !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Publication Info
                            </div>
                            <div class="col-10">
                                {!! $item->publication_info !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Physical Description
                            </div>
                            <div class="col-10">
                                {!! $item->physical_description !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Document Type
                            </div>
                            <div class="col-10">
                                {!! $item->document_type !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Subjects
                            </div>
                            <div class="col-10">
                                @foreach($item->subjects as $subject)
                                    {!! $subject !!}<br />
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Person Subjects
                            </div>
                            <div class="col-10">
                                {!! html_entity_decode($item->person_subjects) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Content Notes
                            </div>
                            <div class="col-10">
                                {!! $item->content_notes !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                Notes
                            </div>
                            <div class="col-10">
                                {!! $item->notes !!}
                            </div>
                        </div>--}}
                    </div>
                    </div>
                </div>
            @endif

            <div id="loading-container" class="card-body loading-placeholder" style="min-height: 600px; width: 100%;" wire:loading>

                <div class="summary card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-1">
                                <input type="checkbox" class="resource-selection-placeholder"/>
                                <div class="image">
                                    <div class="embed-responsive embed-responsive-16by9"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-11">
                                <div class="row">
                                    <div class="col-md-10">
                                        <span class="category text link"></span>
                                        <h4 class="text"></h4>
                                    </div>
                                    <div class="col-md-2 lg:text-right">
                                        <i class="fas fa-heart mr-2 cursor-pointer"
                                        ></i>
                                        <i class="fas fa-folder mr-2 cursor-pointer"
                                           class="btn btn-secondary"
                                           type="button"
                                        ></i>
                                        <i class="fas fa-quote-right mr-2 cursor-pointer"
                                        ></i>
                                        <i class="fas fa-ellipsis-v mr-2 cursor-pointer"
                                           type="button"
                                        ></i>
                                    </div>
                                </div>
                                <div class="text line"></div>
                                <div class="text line"></div>
                                <div class="text line"></div>
                                <p class="card-text">
                                    <a href="#" class="btn btn-raspberry rounded-none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        window.livewire.hook('afterDomUpdate', function () {
            var $parent;
            $('.details-container link').each(function (i, val) {
                var $link = $(this);
                $parent = $link.parent();
                $link.replaceWith([
                    '<a class="underline hover:text-black" href=' + $link.attr('linkterm') + ' target=' + $link.attr('linkwindow') + '>',
                    $link.parent().contents().filter(function(){
                        return this.nodeType == 3;
                    }).text().split('CLICK HERE for online access;')[i+1],
                    '</a>'
                ].join("\n"));
            });
            if($parent){
                $parent.contents().filter(function(){
                    return this.nodeType == 3;
                }).remove();
            }

            $('.details-container searchlink').each(function (i, val) {
                var $link = $(this);
                $link.replaceWith([
                    '<a class="underline hover:text-black" href={{ route('search') }}?mode=all&field=KW&term=' + $link.attr('fieldcode') + '%20' + $link.attr('term') + '>',
                    $link.text(),
                    '</a>'
                ].join("\n"));
            });
        });
    </script>
@endpush
