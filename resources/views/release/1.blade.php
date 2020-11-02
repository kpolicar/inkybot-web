@extends('layouts.app')

@section('title', 'v0.1 Beta - Release Notes')


@section('hero')
    <x-main-hero>

        <h2 class="tracking-loose text-xl w-full font">v0.1 BETA</h2>
        <h1 class="mb-4 text-5xl font-bold leading-tight">Release notes</h1>
        <p class="leading-normal text-lg mb-2">
            Welcome to the first release of Inkybot! We did it!
        </p>
        <p class="leading-normal text-lg mb-2">
            Below you will find important information regarding this version of the bot client.
            Read the release notes carefully so you know what to watch out for.
        </p>
        <p class="leading-normal text-lg mb-8">
            Bear in mind this is an early release, therefore it may be unstable and rather restrictive.
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
                        <span class="pt-1"><strong>Simple maging AI</strong> mages until the desired stats are achieved.
                            The stats will never go over the defined limits and the appropriate rune (SM, PA, RA) for the current
                            stat value will be used.<br>
                            <a href="#ai" class="text-gray-600">Read more</a>
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Stats configurator</strong> allows you to specify what stats you want on your item</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Error detection</strong> will stop the mage if an unexpected stat landed (this may happen
                        if you run out of runes or due to poor internet connection)</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Error notifications</strong> will notify you when something went wrong - this will
                        happen often as this version is not very stable</span>
                    </li>
                </ul>

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">Upcoming</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Support usage of the bot in <strong>any resolution</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Allow the bot to run when the window is in <strong>minimized mode</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>user input interference</strong> with the bot's input</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Detailed logs</strong> for errors, warnings and simply maging information</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1"><strong>French translation</strong> to allow running Dofus in English & French</span>
                    </li>
                </ul>

            </div>
            <div class="mx-auto flex flex-col w-full lg:w-2/5 p-6">

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">Limitations</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <h3 class="text-black text-xl font-bold"><i class="fas fa-vector-square text-3xl mr-3"></i> 1920x1080</h3>
                <p class="text-black my-3">
                    You can use this version of Inkybot in 1920x1080 resolution maximized window mode.<br>
                    <small class="text-sm italic">
                        If you have a screen with <strong>lower</strong> resolution, you will not be able to run the bot.<br>
                        If your screen has a <strong>higher</strong> resolution, refer to
                        <a href="#ocr-bounds" class="font-bold text-gray-600">fitting OCR bounds</a>.<br>
                    </small>
                    This process will be improved in the near future.
                </p>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-shield-alt text-3xl mr-3"></i> Administrator mode</h2>
                <p class="text-black my-3">
                    The bot must be run in administrator mode.<br>
                    <small class="text-sm italic">
                        Windows does not allow simulating mouse clicks in normal mode.
                    </small>
                </p>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-mouse-pointer text-3xl mr-3"></i> Run in background</h2>
                <p class="text-black my-3">
                    You must not hover your mouse over the Dofus client while maging.<br>
                    You can have other windows over Inkybot, however Inkybot must not be minimized.<br>
                </p>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-wifi text-3xl mr-3"></i> Stable internet connection</h2>
                <p class="text-black my-3">
                    You should use Inkybot with a stable internet connection to avoid unexpected issues.
                </p>

            </div>
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
                    1. Open Inkybot and Login
                </h3>
                <p class="text-base">You will need to login to your Inkybot account to gain access to the Dofus client. From there on
                    you can login to your Dofus account as you would normally.</p>
            </div>

            <img src="{{ asset('images/releases/login.jpg') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="">

            <div class="anchor" id="ocr-bounds"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    2. Ensure the OCR indicators cover the appropriate bounds
                </h3>
                <p class="text-base">
                    You can view the OCR bounds by pressing the "Debug" button on the sidebar.
                    The bot is configured to run in 1920x1080 resolution simply because it's the most common resolution,
                    thus if you are running in this resolution you will not encounter issues. Run the bot in full-screen mode
                    and make sure your Windows display settings are not scaled over 100%.
                </p>
            </div>

            <img src="{{ asset('images/releases/ocr.jpg') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="">

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    3. Configure your stats and begin maging!
                </h3>
                <p class="text-base">
                    You can access the stats configurator by pressing the "Stats" button on the sidebar.
                    You will know the bot is finished when it removes the item from the maging table.
                </p>
                <p class="text-base">Make sure you do not have any runes on the maging table when you begin.</p>
            </div>

            <img src="{{ asset('images/releases/stats.gif') }}" class="shadow-lg rounded-t rounded-b-xl my-4" alt="">
        </div>

    </section>


    <div class="anchor" id="ai"></div>
    <section class="bg-white py-8 pb-32 border-t">

        <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Basic Maging AI</h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex lg:flex-row flex-col px-6 lg:px-0">
                <i class="text-center lg:text-left fas fa-robot text-6xl lg:mr-10 mr-0 pb-3"></i>
                <div>

                    <p class="text-base mt-2">
                        The simple Dofus maging AI will mage your items to the configured stats. The target is treated
                        as a <strong>limit</strong>, thus it will never attempt to go over it.
                    </p>
                    <p class="text-base">
                        For example, if you target vitality
                        to 390 and the current value is 362, the bot will not try to mage any further (the RA vitality rune
                        would make the stat land at 412, which is over the limit).
                    </p>
                    <p class="text-base mt-2">
                        Stats are <strong>prioritized</strong> by how many runes are required to reach the target.
                    </p>
                    <p class="text-base mt-2">
                        Once a stat reaches a certain threshold, it will change <strong>strengths</strong> (from SM to PA to RA). These thresholds
                        are not yet configurable, but they are reasonably declared.
                    </p>
                    <p class="text-base mt-2">
                        You must make sure you always have <strong>enough runes</strong> for maging. If you run out of a rune,
                        the bot will warn you only after it discovers this.
                    </p>
                    <p class="text-base mt-2">
                        The Basic Maging AI does not yet make use of <strong>sink</strong>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-8 pb-32 border-t">

        <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Final notes</h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="lg:px-32 px-10">
                <p class="text-center text-black mt-10 mb-2">
                    Please keep in mind this is the very first release of Inkybot, so do not expect things to work without fault.
                </p>
                <p class="text-center text-black mb-2">
                    You should definitely supervise the bot to prevent unexpected behavior that may lead to ruined items.
                </p>
                <p class="text-center text-black mb-2">
                    Depending on how beefy your computer is, Inkybot might run rather slow.
                    OCR can be a rather resource intensive operation to perform, however we are working to improve this.
                </p>
                <p class="text-center text-xl font-bold text-black mt-6">
                    Thank you for trying Inkybot and we hope you will stick around for the official release. <i class="fas fa-heart text-2xl"></i>
                </p>
            </div>
        </div>
    </section>

@endsection
