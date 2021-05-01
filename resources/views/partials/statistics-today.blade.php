@php($magings = \Auth::user()->maging()->todays()->latest()->get())

<div class="p-8">
    <div class="md:flex flex-wrap">
        <div class="md:w-1/5 pr-8">
            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 md:text-left text-center">
                {{ __('profile.activity') }}
            </label>
        </div>
        <div class="md:w-4/5">
            @forelse($magings as $maging)
                @include('partials/statistics', ['maging' => $maging, 'first' => $loop->first, 'active' => $loop->first])
            @empty
                empty
            @endforelse
        </div>
    </div>
</div>
