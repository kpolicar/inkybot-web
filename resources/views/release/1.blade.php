<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>v0.1Beta - Release notes - Inkybot - Dofus Maging Bot</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

<div class="gradient">
    @include('partials.nav')

    <x-main-hero>

        <h2 class="tracking-loose text-xl w-full font">v0.1 BETA</h2>
        <h1 class="mb-4 text-5xl font-bold leading-tight">Release notes</h1>
        <p class="leading-normal text-lg mb-2">
            Welcome to the first release of Inkybot! We did it!
        </p>
        <p class="leading-normal text-lg mb-2">
            Below you will find important information regarding this version of the bot client.
            Read the release notes carefully so you know what to expect and what to be careful for.
        </p>
        <p class="leading-normal text-lg mb-8">
            Bear in mind this is an early release, therefore it may be unstable and rather restrictive.
        </p>

    </x-main-hero>

    <section class="bg-white py-8 border-b">


        <div class="container mx-auto flex flex-col lg:flex-row pt-4 pb-12">

            <div class="mx-auto flex flex-col w-full lg:w-3/5 p-6">

                <h1 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">What's new</h1>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Simple maging AI</strong> mages until the desired stats are achieved</span>
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
                </ul>

                <h1 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">Upcoming</h1>
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
                        <span class="pt-1">Support usage of the bot when the window is in <strong>minimized mode</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>user input interfering</strong> with the bot's input</span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1"><strong>Detailed logs</strong> for errors, warnings and simply maging information</span>
                    </li>
                </ul>

            </div>
            <div class="mx-auto flex flex-col w-full lg:w-2/5 p-6">

                <h1 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">Limitations</h1>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-vector-square text-3xl mr-3"></i> 1920x1080</h2>
                <p class="text-black my-3">
                    You can use this version of Inkybot in 1920x1080 resolution maximized window mode.<br>
                    <small class="text-sm italic">
                        If you have a screen with <strong>lower</strong> resolution, you will not be able to run the bot.<br>
                        If your screen has a <strong>higher</strong> resolution, refer to
                        <a href="#" class="font-bold text-gray-600">fitting OCR bounds</a>.<br>
                    </small>
                    This process will be improved in the near future.
                </p>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-shield-alt text-3xl mr-3"></i> Administrator mode</h2>
                <p class="text-black my-3">
                    The bot must be run in administrator mode.<br>
                    <small class="text-sm italic">
                        Windows will not allow simulating mouse clicks in normal mode.
                    </small>
                </p>

                <h2 class="text-black text-xl font-bold"><i class="fas fa-mouse-pointer text-3xl mr-3"></i> Run in background</h2>
                <p class="text-black my-3">
                    You must not hover your mouse over the Dofus client while maging.<br>
                    You can have other windows over Inkybot, however Inkybot must not be minimized.<br>
                </p>

            </div>
        </div>

    </section>

    <div class="anchor" id="pricing"></div>
    <section class="bg-gray-100 py-8 pb-12">

        <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

            <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">How to use</h1>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>
        </div>

    </section>



    @include('partials.engage')

    @include('partials.footer')


</div>

</body>

<script src="{{ asset('js/app.js') }}"></script>

</html>
