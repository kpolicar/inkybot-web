@extends('layouts.hero')

@section('title', __('titles.subscribe-coinbase'))

@section('content')
    <x-main-hero>
        <div id="coinbase-form"
             data-price-url="{{ route('billing.price') }}"
             data-plan="{{ Request::get('plan', 'standard') }}"
             data-price="{{ \App\Billing::price(Request::get('plan', 'standard'), Request::user(), 1) / 100 }}"
             class="coinbase-payment-form"
             v-cloak>

            <a href="{{ route('subscribe') }}" class="group text-gray-500 hover:underline">
                <i class="fas fa-arrow-left mr-1 transform group-hover:-translate-x-1 duration-100"></i>
                {{ __('common.back') }}
            </a>
            <div class="flex justify-between items-end mb-4">
                <h1 class="text-left text-3xl font-bold leading-tight w-100">{{ __('forms.subscribe_header') }}</h1>

                <img class="w-1/3 bg-gray-300 px-3 py-2 rounded-lg" src="{{ asset('images/coinbase.svg') }}" alt="">
            </div>
            <div class="w-full mb-4">
                <div class="h-1 mx-auto bg-white opacity-25 my-0 py-0 rounded-t"></div>
            </div>

            <form class="w-full" method="POST" action="{{ route('subscribe.coinbase.checkout') }}">

                <div>
                    <label for="plan" class="mr-2">Subscription pack:</label>

                    <select name="plan" id="plan" class="text-gray-900 px-4 pl-3 py-1 rounded" v-model="plan">
                        <option value="starter">
                            {{ __('pricing.package_starter') }}
                        </option>
                        <option value="standard">
                            {{ __('pricing.package_standard') }}
                        </option>
                        <option value="unlimited">
                            {{ __('pricing.package_unlimited') }}
                        </option>
                    </select>
                </div>

                <div class="my-2" v-if="plan == 'unlimited'">
                    <label for="plan" class="mr-2">Concurrent instances:</label>
                    <input name="quantity"
                           class="text-gray-900 px-4 pl-3 py-1 rounded w-16"
                           type="number"
                           v-model="quantity"
                           min="1"
                           max="10">
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
                    <p class="text-lg">
                        {{ __('forms.basket_option', ['option' => 1]) }}
                        <small class="ml-2 text-gray-300 font-bold">
                            {{ __('forms.basket_option_bonus', ['option' => 1]) }}
                        </small>
                    </p>
                </div>
                <div class="flex justify-between text-xl">
                    <p class="font-bold">{{ __('forms.basket_price') }}</p>
                    <p class="text-lg"
                       v-show="priceRefreshRequestsCount <= 0"
                       v-text="$filters.currency(price, '{{ Auth::user()->preferredCurrency() }}')">
                    </p>
                    <div class="loader mx-2" v-show="priceRefreshRequestsCount > 0">
                        <i class="fas fa-spinner fa-spin"></i>
                    </div>
                </div>


                <p class="text-gray-400 text-base mt-4 text-left my-4">
                    {!! __('forms.subscribe_crypto_redirect') !!}
                </p>

                @if ($errors->any())
                    <p class="text-red-500 text italic message">{{ __('common.error_generic') }}</p>
                @endif

                @csrf
                <button class="group mx-auto lg:mx-0 font-bold rounded mt-2 py-4 px-8 shadow-lg cursor-pointer uppercase btn-color-secondary w-full"
                        v-bind:class="[priceRefreshRequestsCount > 0 ? 'opacity-75 cursor-not-allowed' : '']"
                        v-bind:disabled="priceRefreshRequestsCount > 0"
                        type="submit">
                    {{ __('forms.subscribe_form_submit') }}
                    <span v-text="$filters.currency(price, '{{ Auth::user()->preferredCurrency() }}', 0)"></span>
                    <i class="fas fa-angle-right text-lg ml-4 -mr-2"
                        v-bind:class="[priceRefreshRequestsCount <= 0 ? 'transform group-hover:translate-x-2 duration-100' : '']">
                    </i>
                </button>
            </form>

            <p class="text-gray-200 font-bold text-base mt-4 text-left my-4">
                {{ __('forms.subscribe_crypto_fees') }}
            </p>


            <div class="flex items-center">

                <i class="fas fa-exclamation-triangle text-5xl pl-0 px-4 py-3"></i>

                <p class="text-gray-200 font-bold text-base mt-4 text-left my-4">
                    {{ __('forms.subscribe_crypto_no_coinbase') }}
                </p>
            </div>

        </div>
    </x-main-hero>
@endsection


@section('scripts')
    @parent
    <script src="{{ mix('js/coinbase.js') }}"></script>
@endsection
