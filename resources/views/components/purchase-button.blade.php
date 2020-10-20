@if (Auth::check())
    <a href="{{ $route }}" class="mx-auto cursor-pointer lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">
        Purchase
    </a>
@else
    <a class="mx-auto cursor-pointer lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg"
        href="{{ route('register') }}">
        Sign up
    </a>
@endif
