@php($single = $single ?? false)
@php($first = $first ?? $single ?? false)

<ul class="text-gray-800 flex flex-wrap tab">
    @if (!$single)
        <li class="w-full mb-4 text-sm text-gray-600 md:text-left text-center">
            <span class="hover:underline pr-2 relative inline-block cursor-pointer">
                <input class="absolute w-full h-full cursor-pointer opacity-0" type="checkbox" name="tab-todays" data-tab @if($first) checked @endif>
                <i class="{{ $first ? 'far fa-clock' : 'fas fa-history' }} text-gray-800 mr-1"></i> {{ $title ?? '' }}
                <i class="fas fa-angle-down pl-2"></i>
            </span>
        </li>
    @endif
    @if($maging->expended)
        <li class="w-full flex flex-wrap justify-center md:justify-start md:items-center py-2 mb-4 pt-0 m-auto m-0 sm:ml-2 @if(!($first)) hidden @endif">
            <div class="mr-6">
                <img src="{{ asset('images/icons/kamas.png') }}" alt="Kamas" class="rounded object-contain h-8"
                     title="Kamas"/>
            </div>
            <span class="font-bold">
                @if ($maging->expended >= 1000) {{ round($maging->expended / 1000000, 2) }}
                    mk @else {{ $maging->expended }} @endif
            </span>
        </li>
    @endif
    @forelse(Arr::only($maging->exo_attempts ?? [], ['ap', 'mp', 'range']) as $rune => $attempts)
        <li class="w-1/2 sm:w-1/3 flex flex-wrap items-center py-2 pt-0 m-0 sm:ml-2 mb-6 @if(!($first)) hidden @endif">
            <div class="mr-2 w-full">
                <img src="{{ asset('images/icons/'.$rune.'.png') }}" alt="" class="rounded object-contain h-10 md:m-0 m-auto"
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
        <li class="mb-6 @if(!($first)) hidden @endif">
            {{ __('profile.activity_none') }}
        </li>
    @endforelse
</ul>
