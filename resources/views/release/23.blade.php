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
    
<section class="features-section bg-gray-100 py-8 pb-12">

    <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
        {{ __('features.heading') }}
    </h2>
    <div class="w-full mb-4">
        <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
    </div>

    <div class="form-showcase flex justify-around items-center" style="gap: 120px; margin: 120px 0;">
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


</div>
@endsection
