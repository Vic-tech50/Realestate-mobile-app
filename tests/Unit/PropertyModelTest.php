<?php

use App\Models\Property;

it('accepts both a thumbnail and multiple property images for mass assignment', function () {
    $property = new Property([
        'agent_id' => 1,
        'title' => 'Sunset Villa',
        'type' => 'House',
        'listing_type' => 'For Sale',
        'address' => '10 Palm Drive',
        'city' => 'Lagos',
        'state' => 'Lagos State',
        'price' => 25000000,
        'price_period' => 'total',
        'property_id' => 'PV-10001',
        'bedrooms' => 4,
        'bathrooms' => 3,
        'garage' => 2,
        'description' => 'A beautiful seaside villa.',
        'thumbnail' => 'storage/property/thumbs/sunset-villa.jpg',
        'images' => [
            'storage/property/images/sunset-villa-1.jpg',
            'storage/property/images/sunset-villa-2.jpg',
        ],
        'status' => 'pending',
    ]);

    expect($property->thumbnail)->toBe('storage/property/thumbs/sunset-villa.jpg')
        ->and($property->images)->toBe([
            'storage/property/images/sunset-villa-1.jpg',
            'storage/property/images/sunset-villa-2.jpg',
        ]);
});

it('navigates to the selected property detail route using the property id', function () {
    $component = new class extends \App\NativeComponents\property
    {
        public string $lastNavigationUri = '';

        public function navigate(string $uri, array $data = []): static
        {
            $this->lastNavigationUri = $uri;

            return $this;
        }
    };

    $component->viewProperty(42);

    expect($component->lastNavigationUri)->toBe('/viewproperty/42');
});
