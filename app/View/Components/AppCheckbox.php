<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppCheckbox extends Component
{

    public $label, $name, $value, $type;
    public $containerClass = 'form-check',
        $inputClass = 'form-check-input',
        $labelClass = 'form-check-label';

    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct($label, $name, $value, $type = 'checkbox')
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app-checkbox');
    }
}
