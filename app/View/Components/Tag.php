<?php

namespace App\View\Components;

use Illuminate\View\Component;


class Tag extends Component
{
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tags)
    {
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $tags = $this->tags;
        return view('components.tag', compact('tags'));
    }
}
