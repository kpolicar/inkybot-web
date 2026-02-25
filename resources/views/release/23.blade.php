@extends('layouts.release')

@section('date', '25th February 2026')
@section('welcome', 'Welcome to the second release of this series!')

@section('content')

    <section class="bg-white py-8 border-b">


        <div class="container mx-auto flex flex-col lg:flex-row pt-4 pb-12">

            <div class="mx-auto flex flex-col w-full lg:w-3/5 p-6">

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">What's changed</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>speed and stability</strong> of the bot
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>accuracy</strong> of the OCR which collects information about the item you're maging
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Inkybot <strong>can run fully in the background</strong> again and doesn't take control of your mouse and keyboard, allowing you to use your computer for other tasks while Inkybot is running
                        </span>
                    </li>
                </ul>

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">What's broken</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-minus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Removed the <strong>average kamas consumption</strong> tracker, due to a change in the Dofus interface
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
                        <span class="pt-1">Fix <strong>support</strong> for lesser common items, such as some weapons that're not currently supported
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Bring back several <strong>safeguards</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>cryptocurrency</strong> payments
                    </li>
                </ul>

            </div>

            <x-limitations :restrictions="['administrator', 'minimized', 'no-fullscreen']" />
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
