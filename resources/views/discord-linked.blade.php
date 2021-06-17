@extends('layouts.hero')

@section('title', __('titles.discord-link'))
@section('meta:description', __('meta.discord_link_description'))

@push('head')
    <meta name="robots" content="noindex">
@endpush

@section('content')
    <x-main-hero>
        <div class="flex flex-col-reverse">
            <div class="flex flex-col lg:flex-row justify-between">
                <h1 class="mb-0 text-5xl font-bold leading-tight">
                    {{ __('discord.main_header') }}
                </h1>
                <i class="fab fa-discord text-5xl p-2"></i>
            </div>

            <h2 class="uppercase tracking-loose w-full text-center lg:text-left">
                {{ __('discord.main_subheader') }}
            </h2>
        </div>

        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <p class="my-2">
            <strong>{{ __('discord.main_description_success') }}</strong><br>
            {{ __('discord.main_description_receiving') }}
        </p>
        <p class="my-2">
            {{ __('discord.main_description_receiving_failed') }}
        </p>
        <p class="my-2">
            {{ __('discord.main_description_result') }}
        </p>
        <p class="my-4">
            {!! __('discord.discord_id', ['id' => request()->user()->discord_id ?? '―']) !!}
        </p>
    </x-main-hero>
@endsection
