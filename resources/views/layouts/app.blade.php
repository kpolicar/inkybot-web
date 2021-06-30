<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        @hasSection('title')@yield('title') - @endif{{ 'Inkybot - ' . __('titles.main') }}
    </title>

    <meta name="description" content="@yield('meta:description', __('meta.main_description'))">
    <meta name="keywords" content="Dofus, Bot, Maging, Mage, Magus, Profession, Kamas, Items, Cheat, Hack, Stats, Game, Automate, Program">
    <meta name="author" content="Inkybot">


    @section('og:title')
        <meta property="og:title" content="@hasSection('title')@yield('title') - @endif{{ 'Inkybot - ' . __('titles.main') }}" />
    @show
    @section('og:description')
        <meta name="og:description" content="@yield('meta:description', __('meta.main_description'))" />
    @show
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="{{ LaravelLocalization::getCurrentLocale() }}" />
    <meta property="og:url" content="/" />
    <meta property="og:site_name" content="Inkybot" />
    <meta property="og:image" content="{{ asset('logo_white_on_black.jpg') }}" />

    @section('link:alternate')
        <link rel="alternate"
              hreflang="x-default"
              href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getDefaultLocale(), null, [], true) }}" />
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <link rel="alternate"
                  hreflang="{{ $localeCode }}"
                  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" />
        @endforeach
    @show

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">

    @stack('head')
    @include('partials.onesignal')
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

@section('nav')
    @include('partials.nav')
@show

<header class="relative">
    <canvas id="gradient-canvas">
    </canvas>
    @yield('hero')
</header>

<main class="relative z-10">
    @yield('content')
</main>

@section('footer')
    @include('partials.engage')
    @include('partials.footer')
@show

<aside id="notification-discord" class="text-white pr-6 py-4 border-0 rounded-lg m-2 bg-black fixed bottom-0 right-0 w-auto z-10 opacity-75">
    <span class="inline-block align-middle mx-5 mr-8 font-bold max-w-xl">
        {{ __('common.discord_ban') }}

        <hr>
        @section('ban_link')
            <a href="{{ route('discord') }}" target="_blank" class="font-bold hover:underline">{{ __('common.discord_ban_new_server') }}</a>
        @endsection

        <span class="font-normal text-sm">
        {!! __('common.discord_ban_details', ['link' => View::getSection('ban_link')]) !!}
        </span>
    </span>
    <button id="notification-close" data-hide="#notification-discord"  class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
        <span>×</span>
    </button>
</aside>

@include('partials.notification-download')

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@show
@include('partials.analytics')
</body>

</html>
