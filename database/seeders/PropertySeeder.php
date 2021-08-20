<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = Feature::get();

        $properties = Property::factory()
            ->count(30)
            ->create([
                'user_id' => User::first()->id
            ])
            ->each(function ($property) use ($features) {

                $property->features()->attach(
                    $features
                        ->shuffle()
                        ->take(random_int(0, 5))
                        ->pluck('id')
                );
                $images = [];

                for ($i = 0; $i < rand(1, 10); $i++) {
                    $images[] = UploadedFile::fake()->image(Str::random(), '400', '400');
                }

                $property->attachImages($images);

            });
    }
}
