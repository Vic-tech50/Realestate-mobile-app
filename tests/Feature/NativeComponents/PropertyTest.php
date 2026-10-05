<?php

use App\Models\Property;
use App\Models\User;
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