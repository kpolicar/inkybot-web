@extends('layouts.hero')

@section('title', __('titles.subscribe'))

@section('content')
    <x-main-hero>
        <p class="uppercase tracking-loose w-full">
            Payment method
        </p>
        <h1 class="my-4 text-5xl font-bold leading-tight mb-6">How would you like to pay?</h1>

        <p class="leading-normal text-lg mb-2 pr-10">
            Select a payment option below.<br>
            Cryptocurrency payments are encouraged and will grant you <strong>+1 day</strong> of subscription.
        </p>

        <div class="flex">

            <a href="{{ route('subscribe.stripe') }}" class="w-full text-center hover:underline bg-white text-gray-800 font-bold my-6 py-4 mr-2 shadow-lg rounded">
                <i class="far fa-credit-card text-4xl mb-1"></i><br>
                Card
            </a>

            <a href="{{ route('subscribe.coinbase') }}" class="w-full text-center hover:underline bg-white text-gray-800 font-bold my-6 py-4 ml-2 shadow-lg rounded relative">
                <i class="fab fa-bitcoin text-4xl mb-1"></i><br>
                Crypto
                <aside class="absolute top-0 right-0 pt-3">
                    <span class="p-2 bg-gray-200 rounded pr-4">+1 day</span>
                </aside>
            </a>
        </div>
    </x-main-hero>
@endsection
