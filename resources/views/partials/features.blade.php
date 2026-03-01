@php
    $featuresSetupRows = [
        ['stat' => 'stats.ap',                 'value' => 0,  'target' => 1, 'minimum' => '1', 'priority' => 11, 'exo' => 1],
        ['stat' => 'stats.vitality',           'value' => 210,  'target' => 250, 'minimum' => '-', 'priority' => 10],
        ['stat' => 'stats.strength',           'value' => 33,   'target' => 40,  'minimum' => '-', 'priority' => 8],
        ['stat' => 'stats.intelligence',       'value' => 11,   'target' => 40,  'minimum' => '-', 'priority' => 8],
        ['stat' => 'stats.chance',             'value' => 31,   'target' => 40,  'minimum' => '-', 'priority' => 8],
        ['stat' => 'stats.wisdom',             'value' => 30,   'target' => 40,  'minimum' => '-', 'priority' => 7],
        ['stat' => 'stats.summons',            'value' => 1,    'target' => 1,   'minimum' => '-', 'priority' => 5],
        ['stat' => 'stats.neutral_damage',     'value' => 8,    'target' => 10,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.earth_damage',       'value' => 9,    'target' => 10,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.fire_damage',        'value' => 10,   'target' => 10,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.water_damage',       'value' => 10,   'target' => 10,  'minimum' => '-', 'priority' => 6],
        ['stat' => 'stats.initiative',         'value' => 226,  'target' => 300, 'minimum' => '-', 'priority' => 0],
        ['stat' => 'stats.per_fire_resistance','value' => 1,    'target' => 6,   'minimum' => '-', 'priority' => 9],
    ];
@endphp
<div class="anchor" id="works"></div>
<section class="works-section bg-gray-100 py-8 pb-12 border-b">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('winforms.how_title') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>
    <div class="how-works flex justify-center">
        <div class="demo-dashboard">
            <div class="demo-offset">
                @include('partials.setup-form', ['setupRows' => $featuresSetupRows])
            </div>
            @include('partials.maging-table', ['showOcr' => true, 'streamHeight' => 180])
        </div>
        <div class="how-works__desc pl-8 pt-16 max-w-xs">
            <ul class="how-works__list space-y-6 text-gray-700 text-lg">
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
<section class="features-section bg-white py-8 pb-12 border-b">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('features.heading') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>

    <div class="form-showcase flex justify-around items-center">
        <div class="form-card">
            <div class="annotation-anchor">
                @include('partials.setup-form')

                <div class="annotation" data-hl="sf-cible">
                    <div class="annotation__title">{{ __('winforms.popup_sf_cible_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_sf_cible_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_sf_cible_example') }}</p>
                </div>

                <div class="annotation" data-hl="sf-priorite">
                    <div class="annotation__title">{{ __('winforms.popup_sf_priorite_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_sf_priorite_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_sf_priorite_example') }}</p>
                </div>

                <div class="annotation" data-hl="sf-minimum">
                    <div class="annotation__title">{{ __('winforms.popup_sf_minimum_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_sf_minimum_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_sf_minimum_example') }}</p>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="annotation-anchor">
                @include('partials.config-form')

                <div class="annotation annotation--top" data-hl="cf-use-runes">
                    <div class="annotation__title">{{ __('winforms.popup_cf_use_runes_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_cf_use_runes_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_cf_use_runes_example') }}</p>
                </div>

                <div class="annotation" data-hl="cf-max-rune">
                    <div class="annotation__title">{{ __('winforms.popup_cf_max_rune_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_cf_max_rune_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_cf_max_rune_example') }}</p>
                </div>

                <div class="annotation" data-hl="cf-threshold">
                    <div class="annotation__title">{{ __('winforms.popup_cf_threshold_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_cf_threshold_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_cf_threshold_example') }}</p>
                </div>

                <div class="annotation" data-hl="cf-script">
                    <div class="annotation__title">{{ __('winforms.popup_cf_script_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_cf_script_desc') }}</p>
                </div>

                <div class="annotation" data-hl="cf-presets">
                    <div class="annotation__title">{{ __('winforms.popup_cf_presets_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_cf_presets_desc') }}</p>
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="annotation-anchor">
                @include('partials.queue-form')

                <div class="annotation" data-hl="qf-queue">
                    <div class="annotation__title">{{ __('winforms.popup_qf_queue_label') }}</div>
                    <p class="annotation__desc">{{ __('winforms.popup_qf_queue_desc') }}</p>
                    <p class="annotation__example">{{ __('winforms.popup_qf_queue_example') }}</p>
                </div>
            </div>
        </div>
    </div>

</section>
