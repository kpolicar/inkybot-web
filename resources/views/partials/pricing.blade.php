<div class="anchor" id="pricing"></div>
<section class="bg-gray-100 py-8 pb-12">

    <div class="container mx-auto px-2 pt-4 pb-2 text-gray-800">

        <h1 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">{{ __('pricing.heading') }}</h1>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>
        <h2 class="w-full my-2 text-xl leading-tight text-center text-gray-800">
            {!! __('pricing.description_prerelease_free') !!}
            {{ __('pricing.description_prerelease_appreciated') }}<br>
            {{ __('pricing.description_prerelease_activated') }}<br>
            {{ __('pricing.description_thanks') }}
        </h2>

        <div class="flex flex-col sm:flex-row justify-center pt-12 my-12 sm:my-4">

            <div class="flex flex-col w-5/6 lg:w-1/3 mx-auto lg:mx-0 rounded-lg bg-white mt-4 sm:-mt-6 shadow-lg z-10">
                <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                    <div class="w-full p-8 text-3xl font-bold text-center">{{ __('pricing.package_free') }}</div>
                    <div class="h-1 w-full gradient my-0 py-0 rounded-t"></div>
                    <ul class="w-full text-center text-sm">
                        <li class="border-b py-4">{{ __('pricing.package_feature_unlimited_usage') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_simple_maging') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_over_maging') }}</li>
                        <li class="border-b py-4">{{ __('pricing.package_feature_exo_maging') }}</li>
                        <li class="border-b py-4"><strike>{{ __('pricing.package_feature_magus_leveling') }}</strike>*</li>
                    </ul>
                </div>
                <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                    <div class="w-full pt-6 text-3xl text-gray-600 font-bold text-center">€0</div>
                    <div class="flex items-center justify-center">
                        <a href="{{ asset($download_asset) }}"
                           download
                            class="inline-block mx-auto lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">
                            {{ __('common.download') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <h3 class="w-full my-2 leading-tight text-center text-gray-800">* {{ __('pricing.package_feature_in_development') }}</h3>


</section>
