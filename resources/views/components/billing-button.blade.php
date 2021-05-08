@guest
    <a href="{{ route('register') }}"
       @if($class) class="{{ $class }}" @endif>
        {{ trim($slot) ?: __('common.signup') }}
    </a>
@else

    @php($willRedirectToIncompletePaymentPayPage = Auth::user()->hasIncompletePayment() && $incompletePaymentRedirect)
    @php($disabled = !Auth::user()->hasVerifiedEmail() || !$willRedirectToIncompletePaymentPayPage && Auth::user()->hasIncompletePayment())

    <a href="{{ route('subscribe', array_filter(compact('plan'))) }}"
       @if(!$willRedirectToIncompletePaymentPayPage && Auth::user()->hasIncompletePayment())
       onclick="event.preventDefault()" title="You must first finish an incomplete payment."
       @elseif(!Auth::user()->hasVerifiedEmail())
       onclick="event.preventDefault()" title="You must first verify your email address."
       @endif
       class="group @if($disabled) cursor-not-allowed @endif {{ $class }}">

        @if (trim($slot))
            {{ $slot }}
        @elseif (Auth::user()->can('purchase-subscription') || !\Auth::user()->hasVerifiedEmail() && !\Auth::user()->subscribed())
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

        <i class="fas fa-angle-right text-lg ml-2 -mr-2 @if(!$disabled) transform group-hover:translate-x-2 duration-100 @endif"></i>
    </a>
@endguest
