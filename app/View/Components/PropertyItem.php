<?php

namespace App\View\Components;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\View\Component;

class PropertyItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function getPostedAt()
    {
        return $this->property->created_at->diffForHumans();
    }

    public function getAvailableAt()
    {
        return $this->property->available_at->toFormattedDateString();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property-item');
    }
}
