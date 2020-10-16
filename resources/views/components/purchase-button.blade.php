@if (optional(Auth::user())->hasVerifiedEmail())
    <a href="{{ $route }}" class="mx-auto cursor-pointer lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg">
        Purchase
    </a>

@elseif(Auth::check())
    <button class="mx-auto lg:mx-0 bg-gray-800 text-white font-bold rounded my-6 py-4 px-8 shadow-lg cursor-not-allowed opacity-50" disabled>
        Verify email
    </button>
@else
    <a class="mx-auto cursor-pointer lg:mx-0 hover:underline gradient text-white font-bold rounded my-6 py-4 px-8 shadow-lg"
        href="{{ route('register') }}">
        Sign up
    </a>
@endif
