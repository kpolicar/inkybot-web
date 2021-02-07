@extends('layouts.release')

@section('date', '7th February 2021')
@section('welcome', 'Welcome to the third release of this series!')

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
                            Allow users to write custom <strong>maging scripts</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added <strong>Discord notifications</strong> & <strong>opt-out</strong> of notifications via profile page
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Fix bot <strong>stopping</strong> due to trying to make an <strong>impossible mage</strong> - cap at 100 sink overmage
                            (this issue can be common when maging items with stats near their limits)
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Added optional exo publishing to the
                            <a class="underline text-gray-600"
                               href="https://forum.cheat-gam3.com/forums/hall-of-fame.1714/"
                               target="_blank">
                                Hall of Fame
                                <i class="fas fa-external-link-alt text-xs align-top py-1"></i>
                            </a>
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
                        <span class="pt-1">
                            Configure parameters to stop the bot if a certain condition is met <i class="text-sm">(sink > x, vitality > y)</i>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Improve accuracy for <strong>Rune quantity checking</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Begin work on <strong>Magus profession leveling bot</strong></span>
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
