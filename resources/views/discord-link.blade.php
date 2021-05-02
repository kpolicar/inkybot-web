@extends('layouts.hero')

@section('title', __('titles.discord-link'))
@section('meta:description', __('meta.discord_link_description'))

@push('head')
    <meta name="robots" content="noindex">
@endpush


@section('content')
    <x-main-hero>
        <div class="flex flex-col-reverse">
            <div class="flex justify-center lg:justify-between">
                <h1 class="my-4 text-3xl font-bold leading-tight">
                    {{ __('forms.discord-login_header') }}
                </h1>
                <i class="fab fa-discord text-4xl p-3"></i>
            </div>

            <h2 class="uppercase tracking-loose w-full">
                {{ __('forms.discord-login_subheader') }}
            </h2>
        </div>

        <div class="w-full mb-4">
            <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <p class="my-4">
            {{ __('forms.discord-login_description') }}
        </p>

        @include('partials/login-form')
    </x-main-hero>
@endsection
