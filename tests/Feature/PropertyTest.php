<?php

namespace Tests\Feature;

use App\Models\Feature;
use App\Models\Property;
use App\Models\User;
use Database\Seeders\FeatureSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class PropertyTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    private $property;
    private $images = [];

    public function getPropertyDetails()
    {
        return [
            'address' => '20149 virginia  ashburn ave',
            'type' => 'single family home',
            'bedrooms' => 2,
            'bathrooms' => 2,
            'half_bathrooms' => 1,
            'space' => 200,
            'description' => 'hey we are here and wait you',
            'pets_allowed' => true,
            'available_at' => now()->addMonth(),
            'rental_period_in_months' => 24,
            'monthly_rent' => 2000,
            'features' => Feature::get()->shuffle()->take(4)->pluck('id')->toArray()
        ];
    }

    public function instantiatePropertyPictures()
    {
        for ($i = 0; $i < 5; $i++) {
            $image = UploadedFile::fake()->image("property-img-$i", '300', '300');
            $this->images[] = $image;
        }
    }

    protected function setUp(): void
    {
        parent::setUp();
//        Storage::fake('public');
        $this->seed(FeatureSeeder::class);
        $this->property = $this->getPropertyDetails();
        $this->instantiatePropertyPictures();
        $this->property['images'] = $this->images;
    }

    /**
     * @test
     */
    public function landlord_can_add_rentable_property()
    {
        $this->withoutExceptionHandling();
        $this->user = $this->actingAs($user = User::factory()->create());

        $response = $this->post(route('properties.store'), $this->property);

        $response->assertStatus(201);

        $this->assertDatabaseCount('properties', 1);

        $this->assertDatabaseCount('feature_property', 4);

        $property = Property::with(['features', 'user'])->first();

        $this->assertNotNull($property);

        $this->assertNotNull($property->user);

        $this->assertCount(1, $user->properties);

        $this->assertCount(4, $property->features);

        $response->assertRedirect(route('my-properties.index'));


        //assert if images exists

        $images = collect($property->getMedia('property-pictures'));

        $this->assertNotNull($images);
        $this->assertCount(5, $images);

        $images->each(function (Media $image) use ($property) {
            Storage::disk('public')->assertExists(
                Str::after($image->getUrl(),
                    'storage/'
                )
            );

            Storage::disk('public')->assertExists(
                Str::after(
                    $image->getResponsiveImageUrls('property-picture-conversion')[0],
                    'storage/'
                )
            );
        });

    }

//    /**
//     * @test
//     */
//    public function display_my_properties_with_appropriate_attributes()
//    {
//        $this->withoutExceptionHandling();
//        $this->user = $this->actingAs($user = User::factory()->create());
//
//        $this->post(route('properties.store'), $this->property);
//
//        $response = $this->get(route('my-properties.index'));
//
//        $response->assertStatus(200);
//    }


}
