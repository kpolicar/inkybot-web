@extends('layouts.app')

@push('head')
    <meta property="og:video" content="{{ asset('videos/inkybot_intro.mp4') }}" />
    <meta property="og:video:width" content="1920">
    <meta property="og:video:height" content="1080">
@endpush

@section('hero')
    <x-main-hero width-class="w-full lg:w-3/5">
        <h1 class="uppercase tracking-loose w-full">{{ __('messages.category') }}</h1>
        <h2 class="my-4 text-5xl font-bold leading-tight uppercase">{!! __('messages.heading') !!}</h2>

        <div class="w-4/5 md:mx-0 mx-auto">
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
        </div>
    </x-main-hero>
@endsection

@section('content')
    @include('partials.whyus')
    @include('partials.features')
    @include('partials.introvideo')
    @include('partials.pricing')
@endsection
