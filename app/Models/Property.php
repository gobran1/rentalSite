<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class Property extends Model implements HasMedia
{

    use HasFactory, InteractsWithMedia;

    protected $fillable =    [
        'user_id', 'address', 'type', 'bedrooms', 'bathrooms', 'half_bathrooms', 'space',
        'description', 'pets_allowed', 'available_at', 'rental_period_in_months', 'monthly_rent'
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFirstImageAttribute(): Media
    {
        return $this->media->first();
    }

    public function getImagesAttribute(): Media
    {
        return $this->media;
    }

    public function getLocationAttribute()
    {
        return 'Ashburn, Virginia';
    }


    public function attachImages($images): void
    {
        foreach ($images as $image) {
            $this->addMedia($image)
                ->toMediaCollection('property-pictures');
        }
    }

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('property-picture-conversion')
            ->width(1400)
            ->height(700)
            ->quality(80)
            ->withResponsiveImages();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('property-pictures')
            ->acceptsFile(function (\Spatie\MediaLibrary\MediaCollections\File $file) {
                return $file->size < (5 * 1024 * 1024);
            })
            ->acceptsMimeTypes(['image/jpg', 'image/jpeg', 'image/png'])
            ->onlyKeepLatest(15)
            ->useDisk('public');
    }

}
