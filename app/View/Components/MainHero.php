<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MainHero extends Component
{
    public $invert;
    public $widthClass;

    /**
     * Create a new component instance.
     *
     * @param bool $invert
     * @param string $widthClass
     */
    public function __construct(bool $invert=false, string $widthClass='w-full lg:w-2/5')
    {
        $this->invert = $invert;
        $this->widthClass = $widthClass;
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
