<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'address' => $this->faker->address,
            'type' => $this->faker->randomElement(config('property.types')),
            'bedrooms' => $this->faker->numberBetween(0, 5),
            'bathrooms' => $this->faker->numberBetween(0, 5),
            'half_bathrooms' => $this->faker->numberBetween(0, 5),
            'space' => $this->faker->numberBetween(100, 500),
            'description' => $this->faker->paragraph,
            'pets_allowed' => $this->faker->boolean,
            'available_at' => $this->faker->dateTimeBetween(now()->addDay(), now()->addYear()),
            'rental_period_in_months' => $this->faker->numberBetween(3, 36),
            'monthly_rent' => $this->faker->numberBetween(300, 5000)
        ];
    }
}
