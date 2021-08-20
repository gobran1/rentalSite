<?php

namespace App\View\Components;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class PropertyFilters extends Component
{

    public $bedroomOptions;
    public $bathroomOptions;
    public $sortOptions;
    public $features;
    public $additionalFilters;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Collection $features)
    {
        $this->features = $features;

        $this->bedroomOptions = [
            [
                'title' => 'Studio',
                'value' => 'studio'
            ],
            [
                'title' => '1',
                'value' => 1
            ],
            [
                'title' => '2',
                'value' => 2
            ],
            [
                'title' => '3',
                'value' => 3
            ],
            [
                'title' => '4+',
                'value' => 4
            ],
        ];

        $this->bathroomOptions = [
            [
                'title' => '1+',
                'value' => 1
            ],
            [
                'title' => '2+',
                'value' => 2
            ],
            [
                'title' => '3+',
                'value' => 3
            ],
            [
                'title' => '4+',
                'value' => 4
            ],
            [
                'title' => '5+',
                'value' => 5
            ],
        ];

        $this->sortOptions = [
            [
                'title' => 'relevance',
                'value' => 'relevance'
            ],
            [
                'title' => 'posted at',
                'value' => 'created_at'
            ],
            [
                'title' => 'low price',
                'value' => 'low_price'
            ],
            [
                'title' => 'high price',
                'value' => 'high_price'
            ],
        ];

        $this->additionalFilters = [
            [
                'sectionName' => 'Type',
                'name' => 'build_type',
                'inputType' => 'checkbox',
                'values' => ['Apartment','Condo','House','Room','Other']
            ],
            [
                'sectionName' => 'Lease Length',
                'inputType' => 'checkbox',
                'name' => 'lease_length',
                'values' => ['long_term','short_term']
            ],
            [
                'sectionName' => 'Buildings',
                'inputType' => 'radio',
                'name' => 'Building',
                'values' => ['show_building','only_Building','Hide_building']
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.property-filters');
    }
}
