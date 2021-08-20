<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'gobran',
            'email' => 'gobran@test.com',
        ]);
        $this->call(UserSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(PropertySeeder::class);
    }
}
