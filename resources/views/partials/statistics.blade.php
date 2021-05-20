@php($first = $first ?? false)
@php($active = $active ?? false)
@php($htmlTabId = 'tab-'.$maging->id)
@php($htmlChartId = 'chart-'.$maging->id)
@php($chart=isset($chart) ? $chart : false)

<ul class="text-gray-800 flex flex-wrap">
    <li class="w-full mb-4 text-sm text-gray-600 md:text-left text-center">

        <div class="tab w-full">
            <input class="absolute opacity-0" id="{{ $htmlTabId }}" type="checkbox" name="tabs" @if($first) checked @endif>
            <div class="flex md:justify-start justify-center items-center tab-title">
                <div style="flex: 1;" class="border-gray-200 border-b-2 -mt-2 border-dashed mr-2 md:hidden"></div>


                <label class="sm:-mx-1 mx-0 block pb-2 leading-normal cursor-pointer hover:underline"
                       for="{{ $htmlTabId }}">
                    <span>
                        <i class="{{ $active ? 'far fa-clock' : 'fas fa-history' }} tab-rotate--360 text-gray-800 mr-1 transition duration-700"></i>
                        {{ __('profile.session_from', ['time' => $maging->created_at->format('H:i')]) }}
                        @if ($maging->label)
                            <strong> # {{ $maging->label }}</strong>
                         @endif
                        <i class="fas fa-angle-down pl-2"></i>
                    </span>
                </label>

                <div style="flex: 1;" class="border-gray-200 border-b-2 -mt-2 border-dashed ml-2 md:hidden"></div>
            </div>

            <div class="tab-content overflow-hidden md:border-l-2 border-l-0 border-dashed border-gray-200 leading-normal">
                @php($showChart = $chart && $maging->attempts)

                @if ($maging->expended || $maging->exo_attempts || !$showChart)
                <ul class="px-5 pt-5 text-gray-800 flex flex-wrap">
                    @if($maging->expended)
                        <li class="w-full flex flex-wrap justify-center md:justify-start items-center py-2 mb-4 pt-0 m-auto m-0 sm:ml-2">
                            <div class="mr-6">
                                <img src="{{ asset('images/icons/kamas.png') }}" alt="Kamas"
                                     class="rounded object-contain h-8"
                                     title="Kamas"/>
                            </div>
                            <span class="font-bold">
                                    @if ($maging->expended >= 1000) {{ round($maging->expended / 1000000, 2) }}
                                mk @else {{ $maging->expended }} @endif
                                </span>
                        </li>
                    @endif
                    @forelse(Arr::only($maging->exo_attempts ?? [], ['ap', 'mp', 'range', 'summons']) as $rune => $attempts)
                        <li class="w-1/2 sm:w-1/3 flex flex-wrap items-center py-2 pt-0 m-0 sm:ml-2 mb-6">
                            <div class="mr-2 w-full">
                                <img src="{{ asset('images/icons/'.$rune.'.png') }}" alt=""
                                     class="rounded object-contain h-10 md:m-0 m-auto"
                                     title="{{ __("runes.{$rune}") }}"
                                     style="background: no-repeat center center url('{{ asset('images/icons/rune_bg.jpg') }}');
                                         background-size: contain">
                            </div>
                            <span class="md:m-0 m-auto">
                                    {{ __('profile.exo_attempts', ['number' => $attempts]) }}
                                @if(array_key_exists($rune, $maging->exo_successes ?? []))
                                    <b class="mx-1">//</b>
                                    <strong>
                                            {{ __('profile.exo_successes', ['number' => $maging->exo_successes[$rune]]) }}
                                        </strong>
                                @endif
                                </span>
                        </li>
                    @empty
                        @if (!$showChart)
                            <li class="mb-6">
                                {{ __('profile.activity_none') }}
                            </li>
                        @endif
                    @endforelse
                </ul>
                @endif


                @php ($magingSummedByStat = collect($maging->attempts)->sortKeys()->mapWithKeys(function ($value, $key) { return [Str::title(__('runes.'.$key)) => collect($value)->sortKeysDesc()->mapWithKeys(function ($value, $key) { return [Str::title($key) => $value];})];  }))
                @if ($showChart)
                    <div class="relative max-w-lg">
                        <canvas id="{{ $htmlChartId }}"
                                class="data-chart hidden"
                                data-title="{{ __('profile.statistics_chart_title') }}"
                                data-dataset="{{ json_encode($magingSummedByStat) }}"></canvas>
                        @if ($first)
                            <aside class="text-xs mt-6 px-6 border-dashed">
                                <i class="fas fa-lightbulb text-gray-800 text-sm mr-1"></i>{{ __('profile.statistics_chart_tip') }}
                            </aside>
                        @endif
                    </div>
                @endif


            </div>
        </div>
    </li>
</ul>
