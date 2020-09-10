<!-- This example requires Tailwind CSS v1.4.0+ -->
<div class="relative bg-black">
    <div class="flex justify-between items-center px-4 py-1 sm:px-6 md:space-x-10 container mx-auto">
        <div class="flex">
            <a class="navbar-brand m-0" href="http://www.byui.edu">
                <img id="byui-logo" src="https://library.byui.edu/img/byui-logo-white.png" class="d-inline-block align-top" style="height: 60px; width: 72px;" alt="BYU-Idaho Home">
            </a>
            <a class="navbar-brand m-0" href="{{ route('search') }}" style="">
                <img id="mckay-library-logo" src="https://library.byui.edu/img/mckay-library-logo-white.png" class="d-inline-block align-top" style="height: 60px; width: 245px;" alt="David O. McKay Library Home">
            </a>
        </div>
        <div class="-mr-2 -my-2 md:hidden">
            <button x-on:click="mobileNav = !mobileNav"
                    type="button" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <div class="hidden md:flex-1 md:flex md:items-center md:justify-between md:space-x-12">

            <nav class="flex space-x-10">
                {{--<a href="#" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150">
                    Pricing
                </a>--}}
            </nav>
            <div class="flex items-center space-x-8">
                @guest
                    <a href="{{ route('login') }}" class="text-base leading-6 font-medium text-gray-500 hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 uppercase">
                        {{ __('Login') }}
                    </a>
                @else
                    <div class="relative">
                        <!-- Item active: "text-gray-900", Item inactive: "text-gray-500" -->
                        <button  x-on:click="account = !account"
                                type="button" class="group text-white inline-flex items-center space-x-2 text-base leading-6 font-medium hover:text-gray-900 focus:outline-none focus:text-gray-900 transition ease-in-out duration-150 uppercase">
                            <span>@lang('My Account')</span>
                            <!-- Item active: "text-gray-600", Item inactive: "text-gray-400" -->
                            <svg class="text-gray-400 h-5 w-5 group-hover:text-gray-500 group-focus:text-gray-500 transition ease-in-out duration-150" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <!--
                            'More' flyout menu, show/hide based on flyout menu state.

                            Entering: "transition ease-out duration-200"
                              From: "opacity-0 translate-y-1"
                              To: "opacity-100 translate-y-0"
                            Leaving: "transition ease-in duration-150"
                              From: "opacity-100 translate-y-0"
                              To: "opacity-0 translate-y-1"
                          -->
                        <div x-show="account"
                             x-on:click.away="account = false"
                             class="absolute left-1/2 transform -translate-x-1/2 mt-3 px-2 w-screen max-w-xs sm:px-0 z-10">
                            <div class="shadow-lg">
                                <div class="shadow-xs overflow-hidden">
                                    <div class="z-20 relative grid gap-6 bg-white px-4 py-3 sm:gap-8 sm:p-3">
                                        <a href="" class="-m-3 p-3 block space-y-1 hover:bg-gray-50 transition ease-in-out duration-150">
                                            <p class="text-base leading-6 font-medium text-gray-900">
                                                {{ __('Liked') }}
                                            </p>
                                            <p class="text-sm leading-5 text-gray-500">
                                                {{ __('') }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endguest
            </div>

        </div>
    </div>

    <!--
      Mobile menu, show/hide based on mobile menu state.

      Entering: "duration-200 ease-out"
        From: "opacity-0 scale-95"
        To: "opacity-100 scale-100"
      Leaving: "duration-100 ease-in"
        From: "opacity-100 scale-100"
        To: "opacity-0 scale-95"
    -->
    <div x-show="mobileNav"
         class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
        <div class="rounded-lg shadow-lg">
            <div class="rounded-lg shadow-xs bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5 space-y-6">
                    <div class="flex items-center justify-between">
                        <div>
                            {{--<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Workflow">--}}
                        </div>
                        <div class="-mr-2">
                            <button x-on:click="mobileNav = !mobileNav"
                                    type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <nav class="grid gap-6">
                            @guest
                                <a href="{{ route('login') }}"  class="-m-3 p-3 flex items-center space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150 uppercase">
                                    @('Login')
                                </a>
                            @else
                                <a href="" class="-m-3 p-3 flex items-center space-x-4 rounded-lg hover:bg-gray-50 transition ease-in-out duration-150">
                                    <div class="flex-shrink-0 flex items-center justify-center h-10 w-10 rounded-md bg-indigo-500 text-white">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div class="text-base leading-6 font-medium text-gray-900">
                                        @lang('Likes')
                                    </div>
                                </a>
                            @endguest
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
