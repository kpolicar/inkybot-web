@extends('layouts.app')

@section('title', 'v1.0 - Release Notes')


@section('hero')
    <x-main-hero>

        <h2 class="tracking-loose text-xl w-full font">v1.0</h2>
        <h1 class="mb-0 text-5xl font-bold leading-tight">Release notes</h1>
        <h2 class="mb-4 font-bold tracking-loose text-lg w-full font">1st January 2021</h2>

        <p class="leading-normal text-lg mb-2">
            Welcome to the official release of Inkybot!
        </p>
        <p class="leading-normal text-lg mb-2">
            Below you will find important information regarding this version of the bot client.
            Read the release notes carefully so you know what to watch out for.
        </p>

    </x-main-hero>
@endsection

@section('content')


    <section class="bg-white py-8 border-b">


        <div class="container mx-auto flex flex-col lg:flex-row pt-4 pb-12">

            <div class="mx-auto flex flex-col w-full lg:w-3/5 p-6">

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">What's new</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added basic <strong>analytics</strong> (exo attempts), visible on Profile page
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fixed AI's <strong>sink calculation</strong>, added safeguards to prevent incorrect AI behavior
                            if sink is ever incorrectly interpreted
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            <strong>Rune quantity checking</strong> and send notification when run out of runes
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added support for <strong>weapons maging</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added a popup <strong>confirmation dialog</strong> for when starting the bot might ruin an item
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Various <strong>UI improvements</strong>:
                            scaling for high DPI screens,
                            configuration tooltips,
                            prevent crashes due to unexpected user behavior,
                            warn the user for unsupported items
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>performance</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improvements for users with an <strong>unstable internet connection</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            <strong>Maintain user settings</strong> (eg. presets) throughout version upgrades
                        </span>
                    </li>
                </ul>

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">The road so far</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Exo maging</strong> with proper sink usage</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Perfect item maging</strong> with proper sink usage</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Overmaging</strong> <u>without</u> proper sink usage</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Safe & stable</strong> maging without fear of ruining items</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Configurable AI behavior</strong> so users can decide which runes to use and when</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Basic data gathering</strong> so users know how much they're making/losing</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-check text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Notifications</strong> to inform the user for when the bot has stopped</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-times text-3xl mr-3"></i>
                        <span class="pt-1">Cannot mage items that have more stats than Dofus can display at once</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-times text-3xl mr-3"></i>
                        <span class="pt-1">Does not make use of transcendence runes</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-times text-3xl mr-3"></i>
                        <span class="pt-1">Does not expose the possibility of scripting</span>
                    </li>
                </ul>

            </div>

            <x-limitations :restrictions="['administrator', 'minimized']" />
        </div>

    </section>

    <div class="anchor" id="usage"></div>
    <section class="bg-gray-100 py-8 pb-12">

        <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">How to use</h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    1. Open Inkybot as administrator and Login
                </h3>
                <p class="text-base">You will need to login to your Inkybot account to gain access to the Dofus client. From there on
                    you can login to your Dofus account as you would normally.</p>
            </div>

            <img src="{{ asset('images/releases/login.jpg') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="">

            <div class="anchor" id="full-screen"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    2. Assign the appropriate in-game settings
                </h3>
                <p class="text-base">
                    It is essential you put your <strong>graphics settings as high</strong> as possible, especially <strong>anti-aliasing</strong>.
                    In general, if you can see the text better, so can Inkybot. Remember, we use OCR to gather in-game information.
                </p>
                <p class="text-base">
                    Also, make sure you turn off <strong>Full screen mode</strong> as it will mess up Inkybot's OCR bounds.
                    You may have to restart Inkybot after changing this setting.
                </p>
            </div>
            <div class="flex flex-wrap">
                <img src="{{ asset('images/ingame_settings.png') }}" class="lg:w-1/2 w-full shadow-lg rounded-t rounded-b-xl my-4 object-contain" alt="">
                <img src="{{ asset('images/ingame_settings_menu.png') }}" class="lg:w-1/2 w-full shadow-lg rounded-t rounded-b-xl my-4 object-contain" alt="">
            </div>

            <div class="anchor" id="ocr-bounds"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    3. Ensure the OCR indicators cover the appropriate bounds
                </h3>
                <p class="text-base">
                    You can view the OCR bounds by pressing the "Debug" button on the sidebar. The OCR bounds adjust
                    according to the window.
                </p>
                <p class="text-base">
                    We <strong>highly recommend</strong> you run Inkybot <strong>maximized</strong> as this will
                    improve OCR results, thus minimizing error.
                </p>
            </div>

            <img src="{{ asset('images/releases/2.58_ocrindicators.png') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="">

            <div class="anchor" id="advanced-mode"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    4. Activate Advanced Mode
                </h3>
                <p class="text-base">
                    Make sure you enable "Advanced Mode" in-game. You can find this option on the maging table under the item stats.
                </p>
            </div>
            <img src="{{ asset('images/releases/advanced_mode.png') }}" class="shadow-lg rounded my-4" alt="">

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    5. Configure your stats and begin maging!
                </h3>
                <p class="text-base">
                    You can access the stats configurator by pressing the "Stats" button on the sidebar.
                    You will know the bot is finished when it removes the item from the maging table. Voilà!
                </p>
            </div>

            @include('partials.from_to')
        </div>

    </section>

    @include('release.content.ai')

    @section('engage_comingfrom', '#FFFFFF')

@endsection
