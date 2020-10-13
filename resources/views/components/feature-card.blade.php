<div class="w-full md:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
    <div class="flex-1 bg-gray-200 rounded-xl overflow-hidden shadow py-4 @if ($tags) rounded-b-none @endif">
        <div class="w-full font-bold text-xl text-gray-800 px-6 mt-6">{{ $title }}</div>
        <p class="text-gray-600 text-base px-6 mb-5">
            {{ $slot }}
        </p>
    </div>
    @if ($tags)
        <div class="flex-none mt-auto bg-gray-200 rounded-b-xl rounded-t-none overflow-hidden shadow p-6">
            <div class="flex items-center justify-start">
                @foreach ($tags as $tag)
                    <span class="inline-block bg-gray-800 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2 mb-2">{{ $tag }}</span>
                @endforeach
            </div>
        </div>
    @endif
</div>
