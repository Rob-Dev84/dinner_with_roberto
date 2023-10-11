<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ALinkCallToAction extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $href;
     public $text;
     public $title;
     public $active;

    public function __construct($href, $text, $title, $active = false)
    {
        $this->href = $href;
        $this->text = $text;
        $this->title = $title;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.a-link-call-to-action');
    }
}
