<?php

namespace App\View\Components;

class AppCheckboxBtn extends AppCheckbox
{


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $value, $type = 'radio')
    {

        parent::__construct($label, $name, $value, $type);

        $this->containerClass = '';
        $this->inputClass = 'btn-check';
        $this->labelClass = 'btn mx-2 btn-outline-primary';
    }

}
