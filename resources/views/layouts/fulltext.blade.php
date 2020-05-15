<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fab6ddd2f.js" crossorigin="anonymous"></script>

    @livewireStyles

    @stack('styles')

</head>
<body>
    <div id="app"  style="height: calc(100% - 70px);">
        <nav class="navbar navbar-expand-md navbar-dark bg-black shadow-sm sticky-top p-0">
            <div class="container">
                <span class="navbar-brand-container">
                    <a class="navbar-brand m-0" href="http://www.byui.edu">
                        <img id="byui-logo" src="https://library.byui.edu/img/byui-logo-white.png" class="d-inline-block align-top" style="height: 60px; width: 72px;" alt="BYU-Idaho Home">
                    </a>
                    <a class="navbar-brand m-0" href="/" style="">
                        <img id="mckay-library-logo" src="https://library.byui.edu/img/mckay-library-logo-white.png" class="d-inline-block align-top" style="height: 60px; width: 245px;" alt="David O. McKay Library Home">
                    </a>
                </span>
                {{--<a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>--}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle uppercase" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    My Account <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right rounded-none" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('account.likes') }}">
                                        Liked
                                    </a>
                                    <a class="dropdown-item" href="{{ route('account.folders') }}">
                                        Folders
                                    </a>
                                    <a class="dropdown-item" href="">
                                        Preferences
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="h-full">
            @yield('content')
        </main>
    </div>

    <div class="modal fade" id="cite" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle">

        @livewire('modules.search.citations')

    </div>
    <div class="modal fade" id="communication" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle">

        @livewire('modules.communication.sms')

    </div>
    <div class="modal fade" id="marc" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle">

        @livewire('modules.search.marc')

    </div>

    <script id="summary-template" type="text/x-handlebars-template">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <td class="p-1">
                    Library
                </td>
                <td class="p-1">
                    Location
                </td>
                <td class="p-1">
                    Call Number
                </td>
                <td class="p-1">
                    Status
                </td>
            </tr>
            </thead>
            <tbody>
            @{{#each items}}
            <tr>
                <td class="p-1">
                    @{{ location }}
                </td>
                <td class="p-1">
                    @{{ collection }}
                </td>
                <td class="call-number p-1" data-call="@{{ call_number }}" data-collection="@{{ collection }}" data-item="@{{ item }}">
                    @{{ call_number }} @{{ copy }}
                    <i class="tool fas fa-mobile-alt"></i>
                </td>
                <td class="p-1">
                    @{{#unless due_at}}
                        @{{ status }}
                        <form class="remote-submit-pull-request-form" action="http://maclab.byui.edu/library/pull-request" method="GET" target="_blank" style="display: inline; margin-left: 16px;">
                            <button type="submit" class="btn btn-dark btn-sm rounded-none remote-pull-button" title="Delivery / Pickup">Delivery / Pickup</button>
                            <input type="hidden" name="title" value="">
                            <input type="hidden" name="author" value="">
                            <input type="hidden" name="location" value="@{{ location }}">
                            <input type="hidden" name="call_number" value="@{{ call_number }}">
                            <input type="hidden" name="platform" value="eds">
                        </form>
                    @{{/unless}}
                    @{{#if due_at}}
                        Due: @{{ due_at }}
                    @{{/if}}
                </td>
            </tr>
            @{{/each}}
            </tbody>
        </table>

    </script>

    @livewireScripts

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
    <script>
        function selectAll(e){
            var items=document.getElementsByClassName('resource-selection');
            var resources = {};
            for(var i=0; i<items.length; i++){
                if(e.checked == true){
                    items[i].checked=true;
                }else{
                    items[i].checked=false;
                }
                var $item = $(items[i]);
                resources[$item.data('index') + ':' + $item.data('database') + ':' + $item.data('an')] = {
                    'index': $item.data('index'),
                    'database': $item.data('database'),
                    'an': $item.data('an')
                };
            }
            window.livewire.emit('bulkSelect', e.checked, resources);
        }

        window.showSummary = function(bib, $container){
            var templateSource   = $("#summary-template").html();
            var summaryTemplate = Handlebars.compile(templateSource);

            $.ajax({
                url : "https://abish.byui.edu/horizon/api/index.cfm/summary/" + bib,
                jsonp: "callback",
                dataType: "jsonp",
                data: {'authorization': '{{ env('HORIZON_API_TOKEN') }}'},
                success: function(data){
                    if(data.hasOwnProperty('status') && data.status == 'success' && data.items.length > 0){
                        $container.html(summaryTemplate({'items': data.items}));
                        $container.data('loaded', true).show();
                    }
                }
            });
        }

        window.livewire.on('cite', function(){
            $('#cite').modal('show');
        });

        window.livewire.on('nocite', function(){
            $('#cite').modal('hide');
        });

        window.livewire.on('sms', function(){
            $('#communication').modal('show');
        });

        window.livewire.on('nocommunication', function(){
            $('#communication').modal('hide');
        });

        window.livewire.on('showMarcRecord', function(){
            $('#marc').modal('show');
        });

        window.livewire.on('hideMarcRecord', function(){
            $('#marc').modal('hide');
        });

        window.livewire.on('resetSelectAll', function(){
            $('.all-resource-selection').prop('checked', false);
        });

        document.addEventListener("livewire:load", function(event) {
            window.livewire.hook('beforeDomUpdate', () => {
                // Add your custom JavaScript here.
            });

            window.livewire.hook('afterDomUpdate', (component) => {
                $('.folders').each(function (i, val) {
                    var $folderDropdown = $(this);
                    if($folderDropdown.find('.fa-check-square').length > 0){
                        $folderDropdown.parents('.dropdown').find('.fa-folder').addClass('folder-yellow');
                    }else{
                        $folderDropdown.parents('.dropdown').find('.fa-folder').removeClass('folder-yellow');
                    }
                });
            });
        });

        $(function(){
            /*$(document).on('mouseenter', '.summary', function () {
                var $resource = $(this);
                if($resource.data('book') == true && $resource.find('.summary-container').data('loaded') == false){
                    showSummary($resource.data('bib'), $resource.find('.summary-container'));
                }
            });*/

            $('.folders').each(function (i, val) {
                var $folderDropdown = $(this);
                if($folderDropdown.find('.fa-check-square').length > 0){
                    $folderDropdown.parents('.dropdown').find('.fa-folder').addClass('folder-yellow');
                }else{
                    $folderDropdown.parents('.dropdown').find('.fa-folder').removeClass('folder-yellow');
                }
            });

            $(document).on('submit', '.remote-submit-pull-request-form', function (e) {
                var $form = $(this);
                $form.find('input[name="title"]').val($form.parents('.card[data-book="true"]').find('.meta.title').text());
                $form.find('input[name="author"]').val($form.parents('.card[data-book="true"]').find('.meta.author').text());
                return true;
            });

            $(document).on('click', '.call-number', function (e) {
                window.livewire.emit('sms', [{
                    'item': $(this).data('item'),
                    'call_number': $(this).data('call'),
                    'collection': $(this).data('collection'),
                    'title': $(this).parents('.card[data-book="true"]').find('.meta.title').text()
                }]);
            });

            /** Submenu dropdown **/
            /*!
             * Bootstrap 4 multi dropdown navbar ( https://bootstrapthemes.co/demo/resource/bootstrap-4-multi-dropdown-navbar/ )
             * Copyright 2017.
             * Licensed under the GPL license
             */

            $( '.dropdown-menu a.dropdown-toggle' ).on( 'click', function ( e ) {
                var $el = $( this );
                $el.toggleClass('active-dropdown');
                var $parent = $( this ).offsetParent( ".dropdown-menu" );
                if ( !$( this ).next().hasClass( 'show' ) ) {
                    $( this ).parents( '.dropdown-menu' ).first().find( '.show' ).removeClass( "show" );
                }
                var $subMenu = $( this ).next( ".dropdown-menu" );
                $subMenu.toggleClass( 'show' );

                $( this ).parent( "li" ).toggleClass( 'show' );

                $( this ).parents( 'li.nav-item.dropdown.show' ).on( 'hidden.bs.dropdown', function ( e ) {
                    $( '.dropdown-menu .show' ).removeClass( "show" );
                    $el.removeClass('active-dropdown');
                } );

                if ( !$parent.parent().hasClass( 'navbar-nav' ) ) {
                    $el.next().css( { "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4 } );
                }

                return false;
            } );

            /** **/
        });
    </script>


</body>
</html>
