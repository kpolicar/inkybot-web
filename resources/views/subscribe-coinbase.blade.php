@extends('layouts.hero')

@section('title', __('titles.subscribe-coinbase'))

@section('content')
    <x-main-hero>
        <div id="payment-form" class="stripe-payment-form" data-handler="{{ route('pay', ['paymentId' => '/']) }}">

            <div class="flex flex-col lg:flex-row justify-around items-center loader">
                <p class="text-xl my-8">{{ __('forms.subscribe_processing') }}</p>
                <i class="fas fa-spinner fa-spin text-6xl"></i>
            </div>

            <div class="flex justify-between items-end mb-4">
                <h1 class="text-left text-3xl font-bold leading-tight w-100">{{ __('forms.subscribe_header') }}</h1>

                <img class="w-1/3 bg-gray-300 px-3 py-2 rounded-lg" src="{{ asset('images/coinbase.svg') }}" alt="">
            </div>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <p class="text-gray-400 text-base mt-4 text-left my-4">
                {{ __('forms.subscribe_option', ['option' => 1]) }}<br>
                {!! __('forms.subscribe_duration', ['date' => Auth::user()->ExtendedSubscriptionDate(1)->format('d/m/Y')]) !!}<br>
                {{ __('forms.subscribe_thanks') }}
            </p>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <div class="flex justify-between text-xl">
                <p class="font-bold">{{ __('forms.basket_item') }}</p>
                <p class="text-lg">{{ __('forms.basket_option', ['option' => 1]) }}<small class="ml-2 text-gray-300 font-bold">(+1 day)</small></p>
            </div>
            <div class="flex justify-between text-xl">
                <p class="font-bold">{{ __('forms.basket_price') }}</p>
                <p class="text-lg">@money(config('app.price')/100)</p>
            </div>


            <p class="text-gray-400 text-base mt-4 text-left my-4">
                By clicking <b>Pay</b> you will be redirected to a checkout page hosted by Coinbase.
                Subscription will be added to your account once the transaction has been processed and
                received on our end.
            </p>

            @if ($errors->any())
                <p class="text-red-500 text italic message">Something went wrong!</p>
            @endif

            <form class="w-full" method="POST" action="{{ route('subscribe.coinbase.checkout') }}">
                @csrf
                <button class="mx-auto lg:mx-0 hover:underline font-bold rounded mt-2 py-4 px-8 shadow-lg cursor-pointer uppercase btn-color-secondary w-full"
                        type="submit">
                    {{ __('forms.subscribe_form_submit', ['price' => (config('app.price')/100).'€']) }}
                </button>
            </form>

            <p class="text-gray-200 font-bold text-base mt-4 text-left my-4">
                It is strongly recommended you pay using a cryptocurrency with a low network fee - Bitcoin's fees are high.
            </p>

        </div>
    </x-main-hero>
@endsection


@section('scripts')
    @parent
    <script src="{{ mix('js/stripe.js') }}"></script>
@endsection
