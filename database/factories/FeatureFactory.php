<?php

namespace Database\Factories;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feature::class;

    private $featuresTypes = [
        'In_unit,Heating And Cooling',
        'In_unit,listing Features',
        'In_unit,Other',
        'Building,Building features',
        'Building,services',
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement($this->featuresTypes),
            'name' => $this->faker->word
        ];
    }
}
