@extends('layouts.app')

@push('head')
    <meta property="og:video" content="{{ asset('videos/inkybot_intro.mp4') }}" />
    <meta property="og:video:width" content="1920">
    <meta property="og:video:height" content="1080">
@endpush

@section('hero')
    <x-main-hero>
        <h2 class="uppercase tracking-loose w-full">{{ __('messages.category') }}</h2>
        <h1 class="my-4 text-5xl font-bold leading-tight">{{ __('messages.heading') }}</h1>
        <p class="leading-normal text-2xl mb-8">{{ __('messages.subheading') }}</p>
        <p class="leading-normal uppercase text-sm pb-2">
            {!! __('common.compatible', ['version' => $gameVersion]) !!}
        </p>
        <a href="{{ route('download') }}"
           data-download
           rel="nofollow"
           class="inline-block mx-auto lg:mx-0 hover:underline bg-white text-gray-800 font-bold rounded py-4 px-8 shadow-lg">
            {{ __('common.download') }}
        </a>
        <p class="my-2">
            <a href="{{ route('install') }}" class="text-gray-300 font-bold hover:underline">
                {{ __('messages.install_instructions') }}
            </a>
        </p>
    </x-main-hero>
@endsection

@section('content')
    @include('partials.features')
    @include('partials.introvideo')
    @include('partials.pricing')
@endsection
