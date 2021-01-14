<nav id="header" class="fixed w-full z-30 top-0 text-white flex justify-between">

    <div class="" style="flex-grow: 1;"></div>
    <div class="container flex flex-wrap flex-columns xl:items-center justify-between mt-0 py-2">

        <div class="flex justify-between lg:w-auto w-full">
            <div class="pl-4 flex items-center">
                <a class="toggleColour text-white no-underline hover:no-underline font-bold text-2xl lg:text-4xl"  href="{{ route('home') }}" aria-label="{{ __('common.home') }}">
                    <svg class="h-8 fill-current inline" xmlns="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34 34">
                        <rect class="fill-current" x="0" y="31" width="31" height="3" transform="matrix(1,0,0,1,0,0)" />
                        <path transform="translate(3 0)" d="M 25.875 0.0625 C 7.531 0.0625 8.78125 11.4375 8.78125 11.4375 C 8.2290994 12.246696 7.6995693 13.046426 7.25 13.84375 C 7.2192731 13.898245 7.1865288 13.94563 7.15625 14 L 4 14 A 1.0001 1.0001 0 0 0 3.90625 14 A 1.001098 1.001098 0 0 0 3.5 15.90625 L 3 16 C 1.343 16 0 17.344 0 19 L 0 23 C 0 24.656 1.343 26 3 26 L 13 26 C 14.657 26 16 24.656 16 23 L 16 19 C 16 17.344 14.657 16 13 16 L 12.46875 15.875 A 1.0001 1.0001 0 0 0 12 14 L 8.78125 14 C 9.3768313 12.98664 10.046844 11.978044 10.8125 10.96875 C 10.850157 10.925536 10.924518 10.804345 10.96875 10.75 C 11.312321 10.305889 11.682667 9.871631 12.0625 9.4375 C 12.206935 9.262417 12.364614 9.0972071 12.53125 8.90625 C 14.065329 7.2428175 15.90652 5.6997788 18.0625 4.40625 C 16.2125 6.10525 13.15425 9.5635 11.65625 12.1875 C 14.10025 12.4015 17.5465 11.016 19.9375 9 C 19.3975 8.939 16.875 8.48475 16.125 7.84375 C 17.563 7.95975 19.95325 7.97425 20.90625 7.90625 C 22.84525 6.47025 25.063 3.0785 25.875 0.0625 z"/>
                    </svg> INKYBOT
                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center p-1 text-gray-900 hover:text-gray-800 border-none">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>{{ __('common.menu') }}</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
        </div>

        <div class="flex-grow lg:flex justify-end lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white lg:bg-transparent lg:text-white text-black p-4 lg:p-0 z-20" id="nav-content">
            <ul class="list-reset lg:flex justify-end items-center">
                <li class="xl:mr-3 m-1">
                    <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" href="{{ route('install') }}">{{ __('common.installation') }}</a>
                </li>
                <li class="xl:mr-3 m-1">
                    <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" href="{{ route('release', ['version' => 'latest']) }}">{{ __('common.release_notes') }}</a>
                </li>
                <li class="xl:mr-3 m-1">
                    <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" target="_blank" href="https://discord.gg/ueutfe8">Discord</a>
                </li>
                <li class="xl:mr-3 m-1">
                    <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2"
                       title="Cheat-gam3.com"
                       target="_blank"
                       href="https://forum.cheat-gam3.com/forums/inkybot/">
                        {{ __('common.forum') }}
                    </a>
                </li>
                <li class="xl:mr-3 m-1">
                    @auth
                        <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" href="{{ route('profile') }}">{{ __('common.profile') }}</a>
                    @endauth

                    @guest
                        <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" href="{{ route('login') }}">{{ __('common.login') }}</a>
                    @endguest
                </li>
                <li class="xl:mr-3 m-1">
                    @auth
                        <form class="m-0" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="bg-transparent focus:outline-none inline-block no-underline hover:text-gray-500 hover:text-underline">
                                {{ __('common.signout') }}
                            </button>
                        </form>
                    @endauth

                    @guest
                        <a class="inline-block no-underline hover:text-gray-500 hover:text-underline xl:py-2 xl:px-4 p-2" href="{{ route('register') }}">{{ __('common.signup') }}</a>
                    @endguest
                </li>
            </ul>
            <div class="py-4">
                <a id="navAction" href="{{ asset($download_asset) }}" download class="mx-auto lg:mx-0 lg:mx-2 hover:underline bg-white text-gray-800 font-bold rounded mt-4 lg:mt-0 py-4 px-8 shadow opacity-75">
                    {{ __('common.download') }}
                </a>
            </div>
        </div>
    </div>
    <div style="flex: 1" class="text-right">
        <div class="p-2 pt-1 lg:pt-2 pl-0 mt-0 lg:mt-2">@include('partials.language')</div>
    </div>
</nav>
