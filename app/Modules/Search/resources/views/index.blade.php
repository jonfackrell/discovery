@extends('Search::layouts.app')

@section('content')

    @livewire('modules.search.index')

@endsection

@push('scripts')
    <script type="text/javascript">
        $(function(){
            $('.subject-links searchlink').each(function (i, val) {
                var $link = $(this);
                $link.replaceWith([
                    '<a class="subject-link" href={{ route('search') }}?mode=all&field=KW&term=' + $link.attr('fieldcode') + '%20' + $link.attr('term') + '>',
                    $link.text().trim(';'),
                    '</a>'
                ].join("\n"));
            });
        });

        document.addEventListener("livewire:load", function(event) {
            window.livewire.hook('beforeDomUpdate', () => {
                // Add your custom JavaScript here.
            });

            window.livewire.hook('afterDomUpdate', () => {
                $('.subject-links searchlink').each(function (i, val) {
                    var $link = $(this);
                    $link.replaceWith([
                        '<a class="subject-link" href={{ route('search') }}?mode=all&field=KW&term=' + $link.attr('fieldcode') + '%20' + $link.attr('term') + '>',
                        $link.text().trim(';'),
                        '</a>'
                    ].join("\n"));
                });
            });
        });
    </script>
@endpush
