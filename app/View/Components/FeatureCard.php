<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FeatureCard extends Component
{
    public $icon = "";
    public $tags = [];

    /**
     * Create a new component instance.
     *
     * @param array $tags
     */
    public function __construct($icon="", array $tags=[])
    {
        $this->icon = $icon;
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.feature-card');
    }
}
