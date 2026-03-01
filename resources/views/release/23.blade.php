@extends('layouts.release')

@section('date', '25th February 2026')
@section('welcome', 'Welcome to the second release of this series!')

@section('content')

    <section class="bg-white py-8 border-b">


        <div class="container mx-auto flex flex-col lg:flex-row pt-4 pb-12">

            <div class="mx-auto flex flex-col w-full lg:w-3/5 p-6">

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800">What's changed</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>speed and stability</strong> of the bot
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Improved <strong>accuracy</strong> of the OCR which collects information about the item you're maging
                        </span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-plus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Inkybot <strong>can run fully in the background</strong> again and doesn't take control of your mouse and keyboard, allowing you to use your computer for other tasks while Inkybot is running
                        </span>
                    </li>
                </ul>

                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">What's broken</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-minus text-3xl mr-3"></i>
                        <span class="pt-1">
                            Removed the <strong>average kamas consumption</strong> tracker, due to a change in the Dofus interface
                        </span>
                    </li>
                </ul>


                <h2 class="w-full my-2 text-5xl font-bold leading-tight text-gray-800 mt-10">Upcoming</h2>
                <div class="w-full mb-4">
                    <div class="h-1 gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
                </div>

                <ul class="text-black">
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>support</strong> for lesser common items, such as some weapons that're not currently supported
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Bring back several <strong>safeguards</strong></span>
                    </li>
                    <li class="p-3 pl-0 flex">
                        <i class="fas fa-clock text-3xl mr-3"></i>
                        <span class="pt-1">Fix <strong>cryptocurrency</strong> payments
                    </li>
                </ul>

            </div>

            <x-limitations :restrictions="['administrator', 'minimized', 'no-fullscreen']" />
        </div>

    </section>

    <div class="anchor" id="usage"></div>
    
<section class="bg-gray-100 py-8 pb-12" id="features-section">

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


</div>
@endsection
