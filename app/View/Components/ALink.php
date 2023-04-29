<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ALink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $href;
     public $text;
     public $active;

    public function __construct($href, $text, $active = false)
    {
        $this->href = $href;
        $this->text = $text;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.a-link');
    }
}
