@extends('layouts.release')

@section('date', '1st June 2021')
@section('welcome', 'Welcome to the second major release of Inkybot!')

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
                            Added <strong>new priority setup option</strong>, so users may specify in what order stats should be improved
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added <strong>new configuration options</strong> to enable or disable the use of specific runes (SM, PA, RA)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved OCR accuracy on <strong>low & very high resolutions</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>user interfaces</strong>: added <strong>refresh</strong> buttons, <strong>hide advanced configuration</strong> options by default
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added <strong>run out of runes notification</strong> even when the option: "Monitor Rune Quantity" is not enabled
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added support for purchasing <strong>multiple instances</strong> on the same Inkybot account (check out your <a class="underline" href="{{ route('subscribe') }}">Subscription Page</a>)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added <strong>new statistic</strong>: count all the runes used during the bots operation (not just exo attempts) (check out your <a class="underline" href="{{ route('profile') }}#statistics">Profile Page</a>)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added preview of all <strong>successfully maged exos</strong> (check out your <a class="underline" href="{{ route('profile') }}#exos">Profile Page</a>)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added safeguard: it is <strong>no longer possible</strong> to use Inkybot on an item that has a <strong>high-value exo stat</strong> (AP, MP, Range, Summon). These items will need to be broken by hand first.
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fixed bug: the bot would be <strong>interrupted by a warning prompt</strong> when maging unsupported items (>= 13 stats)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fixed bug: the bot would <strong>keep trying to put an exo rune</strong>, even when user ran out of runes in inventory
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fixed bug: the <strong>client randomly crashes</strong> when opening statistics
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fixed bug: <strong>maging weapons</strong> was no longer possible (broken)
                        </span>
                    </li>
                </ul>


                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">Upcoming</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">More <strong>Bug fixes</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Publish a <strong>tutorial video</strong> explaining the basics as well as the advanced features of Inkybot</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Add official <strong>prebuilt item configurations</strong> # priced separately</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Begin work on <strong>Inkybot Retro</strong> # priced separately</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Begin work on <strong>Magus profession leveling bot</strong> # priced separately</span>
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

            <img src="{{ asset('images/releases/login.jpg') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="Login to your Dofus Account" height="1919" width="1040">

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
                <img src="{{ asset('images/ingame_settings.png') }}"
                     class="lg:w-1/2 w-full shadow-lg rounded-t rounded-b-xl my-4 object-contain"
                     alt="Assign the correct Performance settings in-game">
                <img src="{{ asset('images/ingame_settings_menu.png') }}"
                     class="lg:w-1/2 w-full shadow-lg rounded-t rounded-b-xl my-4 object-contain"
                     alt="Assign the correct Menu settings in-game">
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

            <img src="{{ asset('images/releases/2.58_ocrindicators.png') }}"
                 class="shadow-lg rounded-t rounded-b-xl my-4"
                 alt="Ensure that the OCR indicators are correctly positioned">

            <div class="anchor" id="advanced-mode"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    4. Activate Advanced Mode
                </h3>
                <p class="text-base">
                    Make sure you enable "Advanced Mode" in-game. You can find this option on the maging table under the item stats.
                </p>
            </div>
            <img src="{{ asset('images/releases/advanced_mode.png') }}"
                 class="shadow-lg rounded my-4"
                 alt="Activate advanced mode in the maging table">

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

@endsection
