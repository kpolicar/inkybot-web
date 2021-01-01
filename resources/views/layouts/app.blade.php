<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        @hasSection('title')@yield('title') -@endif Inkybot - Dofus Maging Bot
    </title>

    <meta name="description" content="Inkybot is a Dofus Maging Bot compatible with the latest version of the game. Configure the stats you want and let Inkybot do the rest.">
    <meta name="keywords" content="Dofus, Bot, Maging, Mage, Magus, Items, Cheat, Hack, Stats, Game, Automate, Program">
    <meta name="author" content="Inkybot">


    @section('og:title')
        <meta property="og:title" content="@hasSection('title')@yield('title') -@endif Inkybot - Dofus Maging Bot" />
    @show
    @section('og:description')
        <meta name="og:description" content="Inkybot is a Dofus Maging Bot compatible with the latest version of the game. Configure the stats you want and let Inkybot do the rest." />
    @show
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="en_us" />
    <meta property="og:url" content="/" />
    <meta property="og:site_name" content="Inkybot" />
    <meta property="og:image" content="{{ asset('logo_white_on_black.jpg') }}" />

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    @yield('head')
    @include('partials.onesignal')
</head>

<body class="leading-normal tracking-normal text-white gradient" style="font-family: 'Source Sans Pro', sans-serif;">

@section('nav')
    @include('partials.nav')
@show

<header>
    @yield('hero')
</header>

<main>
    @yield('content')
</main>

@section('footer')
    @include('partials.engage')
    @include('partials.footer')
@show

@include('partials.notification-download')

<script src="{{ mix('js/app.js') }}"></script>
@include('partials.analytics')
</body>

</html>
