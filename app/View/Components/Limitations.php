<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Limitations extends Component
{
    public $restrictions;

    /**
     * Create a new component instance.
     *
     * @param array $restrictions
     */
    public function __construct(array $restrictions)
    {
        $this->restrictions = $restrictions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.limitations');
    }
}
