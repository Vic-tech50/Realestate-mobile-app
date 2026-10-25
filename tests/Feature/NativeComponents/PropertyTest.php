<?php

use App\Models\Property;
use App\Models\User;
use App\NativeComponents\addproperty as AddPropertyScreen;
use App\NativeComponents\editproperty as EditPropertyScreen;
use App\NativeComponents\property as PropertyScreen;
use Native\Mobile\Testing\Native;

it('shows properties added after the screen loads when pulled to refresh', function () {
    $agent = User::factory()->create();

    Property::create([
        'agent_id' => $agent->id,
        'title' => 'Existing home',
        'type' => 'House',
        'listing_type' => 'For Sale',
        'address' => '1 Old Street',
        'city' => 'Lagos',
        'state' => 'Lagos',
        'price' => 1000000,
        'price_period' => 'total',
        'property_id' => 'PV-10001',
        'size' => 100,
    ]);

    $screen = Native::test(PropertyScreen::class)
        ->assertSee('Existing home');

    Property::create([
        'agent_id' => $agent->id,
        'title' => 'New home',
        'type' => 'House',
        'listing_type' => 'For Sale',
        'address' => '2 New Street',
        'city' => 'Lagos',
        'state' => 'Lagos',
        'price' => 2000000,
        'price_period' => 'total',
        'property_id' => 'PV-10002',
        'size' => 120,
    ]);

    $screen->call('loadLatest')
        ->assertSee('New home');
});

it('filters properties by title, location, and agent details', function () {
    $matchingAgent = User::factory()->create([
        'name' => 'Ada Okafor',
    ]);

    $otherAgent = User::factory()->create([
        'name' => 'John Smith',
    ]);

    Property::create([
        'agent_id' => $matchingAgent->id,
        'title' => 'Luxury Duplex',
        'type' => 'Duplex',
        'listing_type' => 'For Sale',
        'address' => '20 Lekki Road',
        'city' => 'Lekki',
        'state' => 'Lagos',
        'price' => 25000000,
        'price_period' => 'total',
        'property_id' => 'PV-SEARCH-001',
        'status' => 'available',
        'size' => 350,
        'size_unit' => 'sqm',
    ]);

    Property::create([
        'agent_id' => $otherAgent->id,
        'title' => 'Small Flat',
        'type' => 'Apartment',
        'listing_type' => 'For Rent',
        'address' => '14 Surulere Street',
        'city' => 'Surulere',
        'state' => 'Lagos',
        'price' => 800000,
        'price_period' => 'monthly',
        'property_id' => 'PV-SEARCH-002',
        'status' => 'available',
        'size' => 120,
        'size_unit' => 'sqm',
    ]);

    $screen = Native::test(PropertyScreen::class)
        ->set('search', 'ada')
        ->call('search');

    $screen->assertSee('Luxury Duplex')
        ->assertDontSee('Small Flat');
});

it('saves native property details with normalized listing and payment periods', function () {
    $agent = User::factory()->create([
        'role' => 'agent',
        'verification_status' => 'verified',
    ]);

    Native::fakeBridge()->respondTo('SecureStorage.Get', fn(array $params) => [
        'value' => $params['key'] === 'auth_user'
            ? json_encode(['id' => $agent->id])
            : '',
    ]);

    Native::test(AddPropertyScreen::class)
        ->set('title', 'Verified Family Duplex')
        ->set('property_type', 'Duplex')
        ->set('listing_type', 'For Sale')
        ->set('address', '10 Palm Avenue')
        ->set('city', 'Uyo')
        ->set('state', 'Akwa Ibom')
        ->set('bedrooms', '4')
        ->set('bathrooms', '3')
        ->set('toilets', '4')
        ->set('parking', '2')
        ->set('size', '500')
        ->set('size_unit', 'sqm')
        ->set('price', '25000000')
        ->set('price_period', 'Per Month')
        ->set('description', 'A spacious home close to schools and shopping.')
        ->set('country', 'Nigeria')
        ->set('landmark', 'Near the stadium')
        ->set('amenitySecurity', true)
        ->set('amenityGenerator', true)
        ->call('save')
        ->assertNavigatedTo('/agentdashboard');

    $property = Property::where('title', 'Verified Family Duplex')->firstOrFail();

    expect($property->agent_id)->toBe($agent->id)
        ->and($property->type)->toBe('Duplex')
        ->and($property->listing_type)->toBe('sale')
        ->and($property->price_period)->toBe('monthly')
        ->and($property->country)->toBe('Nigeria')
        ->and($property->landmark)->toBe('Near the stadium')
        ->and($property->toilets)->toBe(4)
        ->and($property->garage)->toBe(2)
        ->and($property->amenities)->toBe(['Security', 'Generator']);
});

it('rejects an incomplete native property form without saving it', function () {
    $agent = User::factory()->create([
        'role' => 'agent',
        'verification_status' => 'verified',
    ]);

    Native::fakeBridge()->respondTo('SecureStorage.Get', fn(array $params) => [
        'value' => $params['key'] === 'auth_user'
            ? json_encode(['id' => $agent->id])
            : '',
    ]);

    $screen = Native::test(AddPropertyScreen::class)
        ->set('title', 'Incomplete Home')
        ->call('save')
        ->assertSee('The property type field is required.');

    expect($screen->get('isSaving'))->toBeFalse()
        ->and(Property::where('title', 'Incomplete Home')->exists())->toBeFalse();
});

it('loads and saves the additional property fields when editing', function () {
    $agent = User::factory()->create();

    $property = Property::create([
        'agent_id' => $agent->id,
        'title' => 'Updated City Home',
        'type' => 'House',
        'listing_type' => 'sale',
        'address' => '10 Palm Avenue',
        'city' => 'Uyo',
        'state' => 'Akwa Ibom',
        'country' => 'Nigeria',
        'landmark' => 'Near the stadium',
        'price' => 25000000,
        'price_period' => 'monthly',
        'property_id' => 'PV-EDIT-10001',
        'bedrooms' => 4,
        'bathrooms' => 3,
        'toilets' => 4,
        'garage' => 2,
        'size' => 500,
        'size_unit' => 'sqm',
        'description' => 'A spacious home close to schools and shopping.',
        'amenities' => ['Security', 'Generator'],
    ]);

    $screen = Native::test(EditPropertyScreen::class, ['id' => $property->id])
        ->assertSet('country', 'Nigeria')
        ->assertSet('landmark', 'Near the stadium')
        ->assertSet('toilets', '4')
        ->assertSet('size_unit', 'sqm')
        ->assertSet('amenitySecurity', true)
        ->assertSet('amenityGenerator', true)
        ->set('country', 'Ghana')
        ->set('landmark', 'Opposite the park')
        ->set('toilets', '5')
        ->set('size_unit', 'sqft')
        ->set('amenityGenerator', false)
        ->set('amenityParking', true)
        ->call('save')
        ->assertNavigatedTo('/agentdashboard');

    $property->refresh();

    expect($property->country)->toBe('Ghana')
        ->and($property->landmark)->toBe('Opposite the park')
        ->and($property->toilets)->toBe(5)
        ->and($property->size_unit)->toBe('sqft')
        ->and($property->amenities)->toBe(['Parking', 'Security']);

    expect($property->listing_type)->toBe('sale')
        ->and($property->price_period)->toBe('monthly');
});
