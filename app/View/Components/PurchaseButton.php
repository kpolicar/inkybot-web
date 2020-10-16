<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Stripe\PaymentIntent;

class PurchaseButton extends Component
{
    public $route;

    /**
     * Create a new component instance.
     * @param string $route
     */
    public function __construct(string $route)
    {
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.purchase-button');
    }
}
