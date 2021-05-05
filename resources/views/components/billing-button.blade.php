@guest
    <a href="{{ route('register') }}"
       @if($class) class="{{ $class }}" @endif>
        {{ trim($slot) ?: __('common.signup') }}
    </a>
@else

    <a href="{{ route('subscribe', array_filter(compact('plan'))) }}"
       @unverified onclick="event.preventDefault()" title="You must first verify your email address." @endunverified
       class="group @unverified cursor-not-allowed @endunverified {{ $class }}">

        @if (trim($slot))
            {{ $slot }}
        @elseif (Auth::user()->can('purchase-subscription') || !\Auth::user()->hasVerifiedEmail())
            {{ __('common.purchase') }}
        @elseif($plan && Auth::user()->subscribedToPlan(\App\Billing::resolvePlan($plan)))
            {{ __('common.manage') }}
        @else
            @if ($isUpgradedPlan())
                {{ __('common.upgrade') }}
            @else
                {{ __('common.downgrade') }}
            @endif
        @endif

        <i class="fas fa-angle-right text-lg ml-2 -mr-2 @verified transform group-hover:translate-x-2 duration-100 @endverified"></i>
    </a>
@endguest
