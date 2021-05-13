<section class="bg-gray-100 py-8 pb-12">

    <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">
        <div class="anchor" id="pricing"></div>

        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">{{ __('pricing.heading') }}</h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <p class="w-full my-2 text-xl leading-tight text-center text-gray-800">
            {{ __('pricing.description') }}<br>
            {{ __('pricing.description_thank_you') }}
        </p>

        <div class="flex flex-col flex-wrap sm:flex-row justify-center pt-12 my-12 sm:my-4 xl:-mx-10 mx-0">

            <div class="flex flex-col w-5/6 md:w-1/3 xl:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white">
                <div class="flex-1 bg-white text-gray-700 rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center border-b-4 border-gray-500">
                        {{ __('pricing.package_starter') }}
                    </div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">{{ __('pricing.package_feature_exos', ['number' => 5]) }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_maging_ai') }}</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="w-full pt-6 text-3xl text-gray-700 font-bold text-center leading-none mb-2">
                        €8 <small class="text-sm">/ {{ __('common.month') }}</small>
                    </div>
                    <div class="flex items-center justify-center">
                        <x-billing-button
                            plan="starter"
                            :incomplete-payment-redirect="false"
                            class="inline-block mx-auto lg:mx-0 gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg {{ Auth::check() ? '' : 'hover:underline' }}">
                        </x-billing-button>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-5/6 md:w-1/3 xl:w-1/4 mx-auto lg:mx-0 rounded-lg bg-white md:-my-4 my-2 shadow-lg z-10">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center">{{ __('pricing.package_standard') }}</div>
                    <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">{{ __('pricing.package_feature_exos', ['number' => 15]) }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_maging_ai') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_scripts') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_statistics') }}</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-10">
                    <div class="w-full pt-6 text-3xl font-bold text-center leading-none mb-2">
                        €15 <small class="text-sm">/ {{ __('common.month') }}</small>
                    </div>
                    <div class="flex items-center justify-center">
                        <x-billing-button
                            plan="standard"
                            :incomplete-payment-redirect="false"
                            class="inline-block mx-auto lg:mx-0 gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg {{ Auth::check() ? '' : 'hover:underline' }}">
                        </x-billing-button>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-5/6 md:w-1/3 xl:w-1/4 mx-auto lg:mx-0 rounded-none lg:rounded-l-lg bg-white">
                <div class="flex-1 bg-white text-gray-700 rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center border-b-4 border-gray-500">
                        {{ __('pricing.package_unlimited') }}
                    </div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">{{ __('pricing.package_feature_exos_unlimited') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_maging_ai') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_scripts') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_statistics') }}</li>
                        <li class="border-b py-4">{!! __('pricing.package_feature_multiple_instances') !!}</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="w-full pt-6 text-3xl text-gray-700 font-bold text-center leading-none mb-2">
                        €20 <small class="text-sm">/ {{ __('common.month') }}</small>
                    </div>
                    <div class="flex items-center justify-center">
                        <x-billing-button
                            plan="unlimited"
                            :incomplete-payment-redirect="false"
                            class="inline-block mx-auto lg:mx-0 gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg {{ Auth::check() ? '' : 'hover:underline' }}">
                        </x-billing-button>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <p class="w-full my-4 leading-tight text-center text-gray-800">{{ __('pricing.package_feature_exos_description') }}</p>


</section>
