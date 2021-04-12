@extends('layouts.hero')

@section('title', __('titles.subscribe-coinbase'))

@section('content')
    <x-main-hero>
        <div id="payment-form" class="stripe-payment-form" data-handler="{{ route('pay', ['paymentId' => '/']) }}">

            <div class="flex flex-col lg:flex-row justify-around items-center loader">
                <p class="text-xl my-8">{{ __('forms.subscribe_processing') }}</p>
                <i class="fas fa-spinner fa-spin text-6xl"></i>
            </div>

            <form>
                <div class="flex justify-between items-end mb-4">
                    <h1 class="text-left text-3xl font-bold leading-tight w-100">{{ __('forms.subscribe_header') }}</h1>

                    <img class="w-1/3 bg-gray-300 px-3 py-2 rounded-lg" src="{{ asset('images/coinbase.svg') }}" alt="">
                </div>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <p class="text-gray-400 text-base mt-4 text-left my-4">
                    {{ __('forms.subscribe_option', ['option' => 1]) }}<br>
                    {!! __('forms.subscribe_duration', ['date' => Auth::user()->ExtendedSubscriptionDate(true)->format('d/m/Y')]) !!}<br>
                    {{ __('forms.subscribe_thanks') }}
                </p>
                <div class="w-full mb-4">
                    <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <div class="flex justify-between text-xl">
                    <p class="font-bold">{{ __('forms.basket_item') }}</p>
                    <p class="text-lg">{{ __('forms.basket_option', ['option' => 1]) }} <small class="font-bold">(+1 day)</small></p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-bold">{{ __('forms.basket_price') }}</p>
                    <p class="text-lg">@money(config('app.price')/100)</p>
                </div>


                <div class="flex flex-wrap mt-3 -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               id="name" name="name" type="text" placeholder="{{ __('forms.subscribe_form_name') }}" required>
                    </div>
                    <div class="w-full md:w-1/2 pl-3 lg:pl-0 px-3">
                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               id="email" name="email" type="email" placeholder="{{ __('forms.email') }}" value="{{ Auth::user()->email }}" required>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 stripe-fields">
                    <div class="w-full md:w-3/5 px-3">
                        <div id="card-number" class="stripe-field"></div>
                    </div>
                    <div class="w-1/2 md:w-1/5 px-3 lg:px-0">
                        <div id="card-expiry" class="stripe-field"></div>
                    </div>
                    <div class="w-1/2 md:w-1/5 px-3">
                        <div id="card-cvc" class="stripe-field"></div>
                    </div>
                </div>

                <div class="error" role="alert">
                    <p class="text-red-500 text italic message"></p>
                </div>

                <button class="mx-auto lg:mx-0 hover:underline font-bold rounded mt-2 py-4 px-8 shadow-lg cursor-pointer uppercase btn-color-secondary w-full"
                        type="submit">
                    {{ __('forms.subscribe_form_submit', ['price' => (config('app.price')/100).'€']) }}
                </button>


                <div class="flex items-center">

                    <i class="fas fa-info-circle text-5xl px-4 py-3"></i>

                    <div>
                        <p class="text-gray-400 text-base mt-4 text-left">
                            {{ __('forms.subscribe_recurring') }}
                        </p>
                        <p class="text-gray-400 text-base text-left font-bold">
                            {{ __('forms.subscribe_info_saved') }}
                        </p>
                    </div>
                </div>
            </form>

            <div id="payment-response">
            </div>
        </div>
    </x-main-hero>
@endsection


@section('scripts')
    @parent
    <script src="{{ mix('js/stripe.js') }}"></script>
@endsection
