@extends('layouts.fulltext')

@section('content')
    <iframe src="{{ $url }}" class="border-none h-full float-left" style="width: calc(100% - 40px);"></iframe>
    <div class="h-full float-left text-center" style="width: 40px;">
        <i class="fas fa-heart cursor-pointer cursor-pointer mt-2 p-2"
           style="@if($item['liked']) color: red;@endif"
           wire:click="toggleLike('{{ $item->index }}', '{{ $item->database }}', '{{ $item->an }}')"
        ></i>
        <br />
        <div class="pl-2">
            @livewire('modules.search.folder-dropdown', ['index' => $item->index, 'database' => $item->database, 'an' => $item->an], key($item->an))
        </div>
         <i class="fas fa-quote-right cursor-pointer" wire:click="$emit('cite', '{{ $item->index }}', '{{ $item->database }}', '{{ $item->an }}')"></i>
        <br />
        <span class="dropdown">
            <i class="fas fa-ellipsis-v cursor-pointer"
               type="button"
               id="tools_{{ $item->an }}"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false"
            ></i>
            <div class="dropdown-menu dropdown-menu-right"
                 aria-labelledby="tools_{{ $item->an }}"
            >
                <a href="http://www.refworks.com/express/ExpressImport.asp?vendor=McKay%20Library&filter=RefWorks%20Tagged%20Format&encoding=65001&url={{ urlencode( route('export.refworks', ['records' => $item->index . ':' . $item->database . ':' . $item->an])) }}"
                   class="dropdown-item"
                   target="export">
                    Export to RefWorks
                </a>
                @if($item['database'] == 'cat03146a')
                    <span wire:click="$emit('showMarcRecord', '{{ explode('.', $item->an)[1] }}')"
                          class="dropdown-item"
                    >
                        MARC Record
                    </span>
                @endif
            </div>
        </span>
    </div>
@endsection
