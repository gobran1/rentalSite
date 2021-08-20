<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PetsCheckboxes extends Component
{
    public $availablePets;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->availablePets = [
            [
                'type' => 'dogs',
                'value' => 'dog'
            ],
            [
                'type' => 'cats',
                'value' => 'cat'
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pets-checkboxes');
    }
}
