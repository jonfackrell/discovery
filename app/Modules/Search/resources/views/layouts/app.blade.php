<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->


    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fab6ddd2f.js" crossorigin="anonymous"></script>

    @livewireStyles

    @stack('styles')

    <style>
        [x-cloak]{
            display: none;
        }
    </style>

</head>
<body>
    <div id="app"
         x-data="{
            mobileMenu: false,
            showhiddenfilters: false,
            account: false,
            mobileNav: false,
            SourceType: true,
            CreationDate: true,
            SubjectEDS: false,
            Publisher: false,
            Journal: false,
            Language: false,
            SubjectGeographic: false,
            Category: false,
            LocationLibrary: false,
            CollectionLibrary: false,
            ContentProvider: false,
        }"
    >

        @include('Search::layouts.partials.top-nav')

        <main x-cloak>

            @yield('content')

        </main>

    </div>

    @livewireScripts

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/handlebars@latest/dist/handlebars.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')

    @include('layouts.partials.tracking')

</body>
</html>
