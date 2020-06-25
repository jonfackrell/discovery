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
<body class="bg-gray-50">
    <div id="app">
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
                                    <a class="dropdown-item" href="{{ route('account.preferences') }}">
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

        <main class="">
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

    <div id="chat-button"
         class="fixed bottom-0 right-0 mr-2 mb-2 p-2 text-gray-500 border-gray-500 bg-white border-solid border-2 h-16 w-16 rounded-full flex-shrink-0 cursor-pointer"
         title="Sorry, we are currently offline, but you can send us an email and we'll get back to you as soon as possible."
    >
        <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor">
            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
    </div>

    <script id="summary-template" type="text/x-handlebars-template">
        <table class="table">
            <thead class="bg-gray-50 font-semibold uppercase">
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
                            <button type="submit" class="btn btn-raspberry btn-sm rounded-none remote-pull-button" title="Pickup / Delivery">Pickup / Delivery</button>
                            <input type="hidden" name="title" value="">
                            <input type="hidden" name="author" value="">
                            <input type="hidden" name="location" value="@{{ location }}">
                            <input type="hidden" name="call_number" value="@{{ call_number }}">
                            <input type="hidden" name="platform" value="eds">
                        </form>
                    @{{/unless}}
                    @{{#if due_at}}
                        Due: @{{ due_at }}
                        <a href="https://byui.ent.sirsi.net/client/en_US/beta/search/detailnonmodal/ent:$002f$002fSD_ILS$002f0$002fSD_ILS:@{{ bib }}/ada?"
                           class="btn btn-raspberry btn-sm rounded-none ml-4"
                           target="_blank"
                        >Place Hold</a>
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
        function updateChatStatus(){
            $.get("https://libraryh3lp.com/presence/jid/byuidahos-queue/chat.libraryh3lp.com/text", function(status){
                var $button = $('#chat-button');
                if(status == 'available'){
                    $button.removeClass('text-byuired-100 border-byuired-100');
                    $button.addClass('text-byuigreen-100 border-byuigreen-100');
                    $button.attr('title', 'We\'re online and available to chat!');
                    $button.find('svg').html('<svg fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"></path><path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path></svg>');
                    $button.on('click', function () {
                        window.location = 'https://library-byui-edu.byui.idm.oclc.org/library-chat#url=' + location.href;
                    });
                }else{
                    $button.removeClass('text-byuigreen-100 border-byuigreen-100');
                    $button.addClass('text-byuired-100 border-byuired-100');
                    $button.attr('title', 'Sorry, we are currently offline, but you can send us an email and we\'ll get back to you as soon as possible.');
                    $button.find('svg').html('<svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>');
                }
            });
            if(window.updateChatTimeout > 60){
                clearTimeout(window.chatStatusInterval);
            }
        }
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

        window.copy = function(id){
            /* Get the text field */
            var copyText = document.getElementById(id);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");
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

        window.livewire.on('clearFacets', function(){
            $('.facet input[type="checkbox"], .facet input[type="radio"]').prop('checked', false);
            $('.facet #date_range_').prop('checked', true);
        });

        window.livewire.on('folderShared', function(){
            $('.share-folder-select').prop('disabled', false);
            $('#share-folder-submit').prop('disabled', false);
        });

        window.livewire.on('scrollToTop', function(){
            $(document).scrollTop(0);
        });

        window.livewire.on('initInvite', function(){
            $('.share-folder-select').select2({
                delay: 750,
                ajax: {
                    url: '{{ route('user.search') }}',
                    dataType: 'json',
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    }
                }

            });
        });

        document.addEventListener("livewire:load", function(event) {
            window.livewire.hook('beforeDomUpdate', () => {
                // Add your custom JavaScript here.
            });

            window.livewire.hook('afterDomUpdate', (component) => {
                $('.summary[data-book="true"]').each(function (i, val) {
                    var $resource = $(this);
                    if($resource.find('#'+ $resource.data('bib')).data('loaded') == false){
                        setTimeout(function(){
                            showSummary($resource.data('bib'), $resource.find('#'+ $resource.data('bib')));
                        }, i * 200);
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
        });

        $(function(){
            if(window.self === window.top){
                window.updateChatTimeout = 0;
                updateChatStatus();
                window.chatStatusInterval = setInterval(function () {
                    updateChatStatus();
                    updateChatTimeout++;
                }, 120000);
            }else{
                $('#chat-button').remove();
            }

            /*$(document).on('mouseenter', '.summary', function () {
                var $resource = $(this);
                if($resource.data('book') == true && $resource.find('.summary-container').data('loaded') == false){
                    showSummary($resource.data('bib'), $resource.find('.summary-container'));
                }
            });*/

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
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-886315-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-886315-1');
    </script>
    <script type='text/javascript'>
        window.__lo_site_id = 115865;

        (function() {
            var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
            wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
        })();
    </script>
    <script>
        window.onUsersnapCXLoad = function(api) {
            api.init({
                user: {
                    user_id: "{{ optional(auth()->user())->id }}", // Id of the user
                    email: "{{ optional(auth()->user())->email }}" // Email address
                }
            });
        }
        var script = document.createElement('script');
        script.defer = 1;
        script.src = 'https://widget.usersnap.com/global/load/f0632680-0847-4e59-a7b5-88a1f9adf57d?onload=onUsersnapCXLoad';
        document.getElementsByTagName('head')[0].appendChild(script);
    </script>

</body>
</html>
