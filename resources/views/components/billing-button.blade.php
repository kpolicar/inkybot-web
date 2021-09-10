@guest
    <a href="{{ route('register') }}"
       @if($class) class="{{ $class }}" @endif>
        {{ trim($slot) ?: __('common.signup') }}
    </a>
@else

    @php($willRedirectToIncompletePaymentPayPage = Auth::user()->hasIncompletePayment() && $incompletePaymentRedirect)
    @php($disabled = !Auth::user()->hasVerifiedEmail() || !$willRedirectToIncompletePaymentPayPage && Auth::user()->hasIncompletePayment() || (Auth::user()->subscribedDeprecated() && !Auth::user()->cashierSubscribed()))

    <a href="{{ route('subscribe', array_filter(compact('plan'))) }}"

       @if(!$willRedirectToIncompletePaymentPayPage && Auth::user()->hasIncompletePayment())
       title="{{ __('payment.not_allowed_incomplete') }}"
       @elseif(!Auth::user()->hasVerifiedEmail())
       title="{{ __('payment.not_allowed_verify') }}"
       @elseif(Auth::user()->subscribedDeprecated() && !Auth::user()->cashierSubscribed())
       title="{{ __('payment.not_allowed_notfinished') }}"
       @endif
       @if($disabled) onclick="event.preventDefault()" @endif

       class="group @if($disabled) cursor-not-allowed @endif {{ $class }}">

        @if (trim($slot))
            {{ $slot }}
        @elseif (Auth::user()->can('purchase-subscription') || !\Auth::user()->hasVerifiedEmail() && !\Auth::user()->subscribed())
            {{ __('common.purchase') }}
        @elseif($plan && (Auth::user()->subscribedToPlan(\App\Billing::resolvePlan($plan)) || ($plan == \App\Billing::$unlimitedPlanCode && Auth::user()->subscribedToPlan(\App\Billing::unlimitedWithQueuePlan()))))
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
