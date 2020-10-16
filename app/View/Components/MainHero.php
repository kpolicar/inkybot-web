<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainHero extends Component
{
    public $invert;

    /**
     * Create a new component instance.
     *
     * @param bool $invert
     */
    public function __construct(bool $invert=false)
    {
        $this->invert = $invert;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.main-hero');
    }
}
