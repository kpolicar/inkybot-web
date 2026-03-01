<div class="anchor" id="works"></div>
<section class="bg-gray-100 py-8 pb-12 border-b" id="works-section">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('winforms.how_title') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
    <div id="how-works-outer" class="flex justify-center">
        <div class="dashboard-container">
            <div class="setup-form-offset">
                @include('partials.setup-form')
            </div>
            @include('partials.maging-table', ['showOcr' => true, 'streamHeight' => 180])
        </div>
        <div class="how-works-desc pl-8 pt-16 max-w-xs">
            <ul class="how-works-list space-y-6 text-gray-700 text-lg">
                <li>
                    <span class="font-bold text-gray-900 block">{{ __('winforms.how_ocr_title') }}</span>
                    {{ __('winforms.how_ocr_desc') }}
                </li>
                <li>
                    <span class="font-bold text-gray-900 block">{{ __('winforms.how_mouse_title') }}</span>
                    {{ __('winforms.how_mouse_desc') }}
                </li>
                <li>
                    <span class="font-bold text-gray-900 block">{{ __('winforms.how_ai_title') }}</span>
                    {{ __('winforms.how_ai_desc') }}
                </li>
            </ul>
        </div>
    </div>
</section>

<div class="anchor" id="features"></div>
<section class="bg-white py-8 pb-12 border-b" id="features-section">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('features.heading') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>

    <div id="sf-annotated-wrapper" class="flex justify-around items-center" style="gap: 120px; margin: 120px 0;">
        <div class="sf-annotated">
            @include('partials.setup-form')

            <div class="sf-popup" data-hl="sf-cible" style="top: -100px; left: 150px;">
                <div class="sf-popup__label">{{ __('winforms.popup_sf_cible_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_sf_cible_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_sf_cible_example') }}</p>
            </div>

            <div class="sf-popup" data-hl="sf-priorite" style="top: 50px; right: -130px;">
                <div class="sf-popup__label">{{ __('winforms.popup_sf_priorite_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_sf_priorite_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_sf_priorite_example') }}</p>
            </div>

            <div class="sf-popup" data-hl="sf-minimum" style="bottom: -70px; left: 330px;">
                <div class="sf-popup__label">{{ __('winforms.popup_sf_minimum_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_sf_minimum_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_sf_minimum_example') }}</p>
            </div>
        </div>

        <div class="sf-annotated">
            @include('partials.config-form')

            <div class="sf-popup sf-popup--top" data-hl="cf-use-runes" style="top: -100px; left: -80px;">
                <div class="sf-popup__label">{{ __('winforms.popup_cf_use_runes_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_cf_use_runes_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_cf_use_runes_example') }}</p>
            </div>

            <div class="sf-popup" data-hl="cf-max-rune" style="top: -20px; right: -120px;">
                <div class="sf-popup__label">{{ __('winforms.popup_cf_max_rune_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_cf_max_rune_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_cf_max_rune_example') }}</p>
            </div>

            <div class="sf-popup" data-hl="cf-threshold" style="top: -80px; right: 200px;">
                <div class="sf-popup__label">{{ __('winforms.popup_cf_threshold_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_cf_threshold_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_cf_threshold_example') }}</p>
            </div>

            <div class="sf-popup" data-hl="cf-script" style="bottom: -60px; left: -120px;">
                <div class="sf-popup__label">{{ __('winforms.popup_cf_script_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_cf_script_desc') }}</p>
            </div>

            <div class="sf-popup" data-hl="cf-presets" style="bottom: -20px; right: -120px;">
                <div class="sf-popup__label">{{ __('winforms.popup_cf_presets_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_cf_presets_desc') }}</p>
            </div>
        </div>

        <div class="sf-annotated">
            @include('partials.queue-form')

            <div class="sf-popup" data-hl="qf-queue" style="top: 150px; left: -90px;">
                <div class="sf-popup__label">{{ __('winforms.popup_qf_queue_label') }}</div>
                <p class="sf-popup__desc">{{ __('winforms.popup_qf_queue_desc') }}</p>
                <p class="sf-popup__example">{{ __('winforms.popup_qf_queue_example') }}</p>
            </div>
        </div>
    </div>

</section>
