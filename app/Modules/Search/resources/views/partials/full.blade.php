<div>
    <div wire:click="$emit('show', '{{ $item['database'] }}', '{{ $item['an'] }}')"
         class="bg-white px-4 pt-5 pb-2 border-b border-gray-200 sm:px-6 hover:bg-gray-100">
        <div class="-ml-4 -mt-4 flex justify-between flex-wrap sm:flex-no-wrap">
            <div class="ml-4 mt-4">
                <div class="flex items-top">
                    <div class="flex-shrink-0">
                        <img class="h-auto min-h-16 w-16 rounded-sm"
                             src="{{ $item['thumbnail'] }}"
                             alt=""
                             style="background:url({{ \App\Enums\Thumbnail::keyForName(\Illuminate\Support\Str::of($item['format'])->replace('/', '')->snake()) }}); background-size: cover;">
                    </div>
                    <div class="ml-4">
                        <div class="-mt-2">
                            <span class="text-sm leading-6 text-gray-900 uppercase">
                                {{ $item['format'] }}
                            </span>
                            <span class="mx-2">|</span>
                            <span class="text-sm leading-6 text-gray-900 uppercase">
                                {{ $item['database_label'] }}
                            </span>
                        </div>
                        <p class="text-lg leading-5 font-medium text-gray-900">
                            {!! $item['title'] !!}
                        </p>

                        <p class="mt-1 text-sm leading-5 text-gray-600">
                            {!!  $item['author'] !!}
                        </p>

                        @if(in_array(setting('display'), ['standard', 'expanded']))
                            <p class="mt-1 text-md leading-5 text-black">
                                {!! Str::limit($item['abstract'], 800, '...') !!}
                            </p>
                        @endif

                        @if(in_array(setting('display'), ['expanded']))
                            <div class="subject-links mt-2">
                                {!! Str::of(html_entity_decode($item['subject']))->replace(';', '')->replace('<br />', '') !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="ml-4 mt-4 flex-shrink-0 flex items-top">
                <span class="inline-flex rounded-md shadow-sm">
                    <i class="fas fa-heart cursor-pointer mr-2"
                       style="@if($item['liked']) color: red; @endif"
                       wire:click.stop.debounce.500ms="$emitSelf('toggleLike', '{{ $item['database'] }}', '{{ $item['an'] }}')"
                    ></i>
                </span>
                <span class="inline-flex rounded-md shadow-sm">
                    <i class="fas fa-quote-right mr-2 cursor-pointer"
                       wire:click="$emit('cite', '{{ $item['database'] }}', '{{ $item['an'] }}')"
                    ></i>
                </span>
            </div>
        </div>
    </div>

</div>
