@extends('layouts.release')

@section('date', '22nd December 2024')
@section('welcome', 'Welcome to the first release of this series!')

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
                            Compatibility with <strong>Dofus 3</strong>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>consistency</strong> of operating system actions: screenshots, input events
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved compatibility to mage <strong>several more items</strong> within Dofus
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Adapted hall of fame screenshots to <strong>hide</strong> the underlying user's personal information
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>detaching</strong> of Inkybot from Dofus when the window is closed so you needn't restart Dofus to
                            exit Inkybot
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
                            Reduced <strong>OCR accuracy</strong> due to changes in fine-tuning for new Dofus interface
                            This includes: incorrect sink reading, minimum and maximum values. Current stat value readings
                            appear to be consistently correct.
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-minus text-3xl mr-3"></i>
                        <span class="pt-1">
                            The maging history is no longer parsed, which has <strong>weakened safeguards</strong> that verify
                            that Inkybot is behaving as expected
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-minus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Injected input commands no longer function, Inkybot now <strong>takes full control</strong> of your mouse and keyboard during operation
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-minus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Inkybot must always be attached to the Dofus window <strong>after you've logged in</strong> and selected your character, or the window freezes
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
                        <span class="pt-1">Improve <strong>OCR accuracy</strong> which will improve general behavior of the bot (fewer crashes, unexpected interrupts)</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Enable the use of Inkybot in the <strong>background</strong> (so it doesn't take control of your cursor)</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Bring back several <strong>safeguards</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Improve <strong>speed</strong> of Inkybot operation
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Rewrite <strong>usage instructions</strong> and rebrand website with Dofus 3 screenshots
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>cryptocurrency</strong> payments
                    </li>
                </ul>

            </div>

            <x-limitations :restrictions="['administrator', '1920x1080-recommend', 'mouse']" />
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
