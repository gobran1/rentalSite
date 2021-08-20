<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PropertyItems extends Component
{

    public $properties;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $properties)
    {
        $this->properties = $properties;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property-items');
    }
}
