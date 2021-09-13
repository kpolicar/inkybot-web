<section class="bg-white border-b py-8">


    <div class="container mx-auto pt-4 pb-12">
        <div class="anchor" id="whyus"></div>

        <h2 class="w-full my-2 text-5xl font-bold leading-tight text-center text-gray-800">
            Why us?
        </h2>
        <div class="w-full mb-4">
            <div class="h-1 mx-auto gradient w-64 opacity-25 my-0 py-0 rounded-t"></div>
        </div>

        <div class="-mx-3 flex flex-wrap">
            <x-feature-card icon="shield-alt">
                <x-slot name="title">
                    {{ __('features.ocr') }}
                </x-slot>
                {!! __('features.ocr_details') !!}
            </x-feature-card>

            <x-feature-card icon="mouse-pointer">
                <x-slot name="title">
                    {{ __('features.human_like') }}
                </x-slot>
                {!! __('features.human_like_details') !!}
            </x-feature-card>

            <x-feature-card icon="chart-bar">
                <x-slot name="title">
                    {{ __('features.statistics') }}
                </x-slot>
                {!! __('features.statistics_details') !!}
            </x-feature-card>

            <x-feature-card icon="sync">
                <x-slot name="title">
                    {{ __('features.updates') }}
                </x-slot>
                {!! __('features.updates_details') !!}
            </x-feature-card>

            <x-feature-card icon="code">
                <x-slot name="title">
                    {{ __('features.scriptless') }}
                </x-slot>
                {!! __('features.scriptless_details') !!}
            </x-feature-card>

            <x-feature-card icon="bell">
                <x-slot name="title">
                    {{ __('features.notifications') }}
                </x-slot>
                {!! __('features.notifications_details') !!}
            </x-feature-card>

        </div>
    </div>

</section>
