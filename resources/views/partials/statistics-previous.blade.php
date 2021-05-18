@php($maging = \Auth::user()->maging()->notTodays()->latest()->first())
@php($magingsOnSameDay = !$maging ? [] : \Auth::user()->maging()->whereDate('created_at', $maging->created_at)->latest()->get())

<div class="p-8">
    <div class="md:flex flex-wrap">
        <div class="md:w-1/5 pr-8">
            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 md:text-left text-center">
                {{ __('profile.activity_previous') }}
            </label>

            @if ($maging)
            <div class="w-1/2 md:w-full m-auto">
                <input type="date"
                       disabled
                       value="{{ $maging->created_at->format('Y-m-d') }}"
                       class="cursor-not-allowed mt-2 mb-4 inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-2 py-2 bg-white text-sm font-medium text-black hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" />

            </div>
            @endif
        </div>
        <div class="md:w-4/5">
            @forelse($magingsOnSameDay as $maging)
                @include('partials/statistics', ['maging' => $maging, 'chart' => true])
            @empty
                <p class="text-gray-800">
                    {{ __('profile.activity_none') }}
                </p>
            @endforelse
        </div>
    </div>
</div>
