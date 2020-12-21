@extends('layouts.app')

@section('head')
    <meta property="og:video" content="{{ asset('videos/inkybot_intro.mp4') }}" />
    <meta property="og:video:width" content="1920">
    <meta property="og:video:height" content="1080">
@show

@section('hero')
    <x-main-hero>
        <h2 class="uppercase tracking-loose w-full">The Dofus 2.0 Maging bot</h2>
        <h1 class="my-4 text-5xl font-bold leading-tight">Customize your items the way you want</h1>
        <p class="leading-normal text-2xl mb-8">Tell us what stats you want on your items and we'll do the rest.</p>
        <a href="{{ asset($download_asset) }}"
           download
           class="inline-block mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded mt-6 py-4 px-8 shadow-lg">Download</a>
        <p class="my-2">
            <a href="{{ route('install') }}" class="text-gray-300 font-bold hover:underline">Installation instructions</a>
        </p>
    </x-main-hero>
@endsection

@section('content')
    <div class="anchor" id="features"></div>
    @include('partials.features')
    <div class="anchor" id="presentation"></div>
    @include('partials.introvideo')
    <div class="anchor" id="pricing"></div>
    @include('partials.pricing')
@endsection
