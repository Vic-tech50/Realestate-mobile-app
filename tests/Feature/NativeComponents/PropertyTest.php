<?php

use App\Models\Property;
use App\Models\User;
use App\NativeComponents\addproperty as AddPropertyScreen;
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
