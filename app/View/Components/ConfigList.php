<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ConfigList extends Component
{
    public $listHeader;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($listHeader)
    {
        $this->listHeader = $listHeader;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.config-list');
    }
}
