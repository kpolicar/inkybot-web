<?php

namespace App\View\Components;

use App\Billing;
use Auth;
use Illuminate\View\Component;

class BillingButton extends Component
{
    public $class = "";
    public $stripeKey = "";
    public $plan = "";
    public $incompletePaymentRedirect = true;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class="", $plan="", $incompletePaymentRedirect=true)
    {
        $this->class = $class;
        $this->plan = $plan;
        $this->incompletePaymentRedirect = $incompletePaymentRedirect;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.billing-button');
    }

    public function isUpgradedPlan()
    {
        if (!Auth::user()->subscribed())
            return true;
        switch ($this->plan) {
            case Billing::$starterPlanCode:
                return Auth::user()->subscribedToPlan(Billing::starterPlan());
            case Billing::$standardPlanCode:
                return !Auth::user()->subscribedToPlan(Billing::standardPlan()) &&
                    !Auth::user()->subscribedToPlan(Billing::unlimitedPlan());
            case Billing::$unlimitedPlanCode:
                return !Auth::user()->subscribedToPlan(Billing::unlimitedPlan());
        }
        if (Auth::user()->subscribedToPlan(Billing::starterPlan())) {
            return false;
        }

        return true;
    }
}
