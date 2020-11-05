@extends('layouts.app')

@section('title', 'Installation')

@section('hero')
    <x-main-hero>

        <h2 class="uppercase tracking-loose w-full">Get up and running</h2>

        <div class="flex flex-col lg:flex-row justify-between">
            <h1 class="mb-0 text-5xl font-bold leading-tight">Installation</h1>
            <i class="fas fa-cloud-download-alt text-5xl p-2"></i>
        </div>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <p class="leading-normal text-lg mb-2">
            Welcome to the installation instructions for Inkybot.
        </p>
        <p class="leading-normal text-lg mb-2">
            If you've already installed Inkybot and are encounterring issues during maging, please refer to
            the <a class="font-bold text-gray-500" href="{{ route('release', ['version' => 'latest']) }}">Release Notes</a>.
        </p>
        <a href="{{ asset($download_asset) }}"
           class="inline-block mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded my-6 py-4 px-8 shadow-lg">Download</a>

    </x-main-hero>
@endsection

@section('engage_comingfrom', '#ffffff')
@section('content')

    <div class="anchor" id="usage"></div>
    <section class="bg-white py-8 pb-12">

        <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

            <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">Installation Steps</h2>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    1. Download
                </h3>

                <p class="text-base">
                    Download the latest version of Inkybot and place the downloaded file in a memorable location.
                </p>
            </div>

            <img src="{{ asset('images/installation/downloadfolder.png') }}" class="my-4" alt="">

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    1A. Add antivirus exception (if necessary)
                </h3>

                <p class="text-base mb-2">
                    Some antiviruses might detect Inkyvirus as a threat and delete the executable file (inkybot.exe).
                    If this happens you can rest assured, it is a false positive.<br>
                    We do not have any malware in our service. Make sure you download Inkybot through our official website
                    and you will be all clear.
                </p>
                <p class="text-base">
                    If you use <i>Avast Free Antivirus</i>, you can check out
                    <a class="font-bold text-gray-800" target="_blank" href="https://support.avast.com/en-ww/article/Mac-Security-scan-exclusions/">this article</a>
                    which describes how you can exclude Inkybot from antivirus scans.
                </p>
            </div>

            <div class="anchor" id="ocr-bounds"></div>
            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    2. Extract
                </h3>

                <p class="text-base">
                    Extract the contents of the zipped folder into any folder of your choice.
                </p>
            </div>

            <img src="{{ asset('images/installation/extracthere.png') }}" class="my-4" alt="">

            <div class="px-4 lg:px-0">
                <h3 class="mt-10 w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    3. Run application
                </h3>

                <p class="text-base">
                    Run the Inkybot executable file as an administrator.
                </p>
            </div>

            <img src="{{ asset('images/installation/runasadmin.png') }}" class="my-4" alt="">

            <div class="flex flex-col lg:flex-row mt-10">
                <div class="px-4 lg:px-0 lg:w-1/3 mr-4">
                    <h3 class="w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                        4. Select the path to your Dofus folder
                    </h3>
                    <p class="text-base">
                        The default installation folder for Dofus is:
                    </p>
                    <p class="text-sm text-gray-500">%APPDATA%\..\Local\Ankama\zaap\dofus\dofus.exe</p>
                    <p class="text-base">
                        You can find your Dofus install folder in the Ankama Launcher settings.
                    </p>

                    <img src="{{ asset('images/installation/selectpath.png') }}" class="my-4" alt="">
                </div>

                <div class="lg:w-2/3 ml-4">
                    <img src="{{ asset('images/installation/savelocation.png') }}" class="mb-4" alt="">
                </div>
            </div>

            <div class="px-4 lg:px-0">
                <h3 class=" w-full text-xl font-bold leading-tight text-gray-700 uppercase">
                    5. Congratulations!
                </h3>

                <p class="text-base">
                    You are now ready to begin your botting career! Log in with your Inkybot account and continue
                    as you would normally.
                </p>
            </div>

            <img src="{{ asset('images/installation/logindialogue.png') }}" class="my-4" alt="">

            <p class="text-xl">
                <i class="fas fa-caret-right"></i>
                Now comes the fun part. Learn
                <a class="font-bold text-gray-800" href="{{ route('release', ['version' => 'latest']) }}#usage">How to use</a>
                the latest version of Inkybot.
            </p>

        </div>

    </section>

@endsection
