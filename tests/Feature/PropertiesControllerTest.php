<?php

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

describe('property management', function () {
    it('creates a property from the admin form and stores its images', function () {
        Storage::fake('public');
        $admin = User::factory()->create();
        $agent = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('properties.store'), [
            'title' => 'Modern Duplex',
            'type' => 'house',
            'listing_type' => 'sale',
            'description' => 'A well maintained family home.',
            'address' => '15 Ikot Ekpene Road',
            'city' => 'Uyo',
            'state' => 'Akwa Ibom',
            'country' => 'Nigeria',
            'landmark' => 'Near the stadium',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'toilets' => 4,
            'parking_spaces' => 2,
            'size' => 500,
            'size_unit' => 'sqm',
            'amenities' => ['Security', 'Generator'],
            'price' => 25000000,
            'payment_period' => 'one_time',
            'user_id' => $agent->id,
            'status' => 'pending',
            'images' => [
                UploadedFile::fake()->image('front.jpg'),
                UploadedFile::fake()->image('kitchen.jpg'),
            ],
        ]);

        $response->assertRedirect(route('properties.index'));
        $this->assertDatabaseHas('properties', [
            'agent_id' => $agent->id,
            'title' => 'Modern Duplex',
            'price_period' => 'one_time',
            'garage' => 2,
            'country' => 'Nigeria',
            'landmark' => 'Near the stadium',
            'toilets' => 4,
            'size_unit' => 'sqm',
            'status' => 'pending',
        ]);

        $property = Property::where('title', 'Modern Duplex')->firstOrFail();

        expect($property->property_id)->not->toBeEmpty()
            ->and($property->amenities)->toBe(['Security', 'Generator'])
            ->and($property->images)->toHaveCount(2)
            ->and($property->thumbnail)->toBe($property->images[0]);

        Storage::disk('public')->assertCount('properties', 2);
    });

    it('returns validation errors without creating an incomplete property', function () {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('properties.store'), []);

        $response->assertSessionHasErrors(['title', 'type', 'listing_type', 'address', 'city', 'state', 'price', 'size']);
        $this->assertDatabaseCount('properties', 0);
    });

    it('redirects unauthenticated users away from property creation', function () {
        $this->post(route('properties.store'), [])->assertRedirect(route('login'));
    });

    it('updates a property and keeps its existing images', function () {
        Storage::fake('public');
        $admin = User::factory()->create();
        $agent = User::factory()->create();
        Storage::disk('public')->put('properties/existing.jpg', 'image-data');
        $property = Property::create([
            'agent_id' => $agent->id,
            'title' => 'Old Title',
            'type' => 'house',
            'listing_type' => 'sale',
            'address' => 'Old address',
            'city' => 'Uyo',
            'state' => 'Akwa Ibom',
            'price' => 10000000,
            'price_period' => 'one_time',
            'property_id' => 'PROP-OLD-001',
            'size' => 300,
            'thumbnail' => '/storage/properties/existing.jpg',
            'images' => ['/storage/properties/existing.jpg'],
        ]);

        $response = $this->actingAs($admin)->put(route('properties.update', $property), [
            'title' => 'Updated Duplex',
            'type' => 'house',
            'listing_type' => 'rent',
            'description' => 'Updated description.',
            'address' => '20 New Road',
            'city' => 'Lagos',
            'state' => 'Lagos',
            'country' => 'Nigeria',
            'landmark' => 'By the park',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'toilets' => 3,
            'parking_spaces' => 1,
            'size' => 350,
            'size_unit' => 'sqm',
            'amenities' => ['Parking'],
            'price' => 1500000,
            'payment_period' => 'monthly',
            'user_id' => $agent->id,
            'status' => 'available',
        ]);

        $response->assertRedirect(route('properties.index'));
        $property->refresh();

        expect($property->title)->toBe('Updated Duplex')
            ->and($property->price_period)->toBe('monthly')
            ->and($property->garage)->toBe(1)
            ->and($property->amenities)->toBe(['Parking'])
            ->and($property->images)->toBe(['/storage/properties/existing.jpg']);

        Storage::disk('public')->assertExists('properties/existing.jpg');
    });

    it('renders the property detail and edit pages', function () {
        $admin = User::factory()->create();
        $property = Property::create([
            'agent_id' => $admin->id,
            'title' => 'Viewable Home',
            'type' => 'house',
            'listing_type' => 'sale',
            'address' => '1 Main Street',
            'city' => 'Uyo',
            'state' => 'Akwa Ibom',
            'price' => 5000000,
            'price_period' => 'one_time',
            'property_id' => 'PROP-VIEW-001',
            'size' => 250,
        ]);

        $this->actingAs($admin)
            ->get(route('properties.show', $property))
            ->assertOk()
            ->assertSee('Viewable Home');

        $this->actingAs($admin)
            ->get(route('properties.edit', $property))
            ->assertOk()
            ->assertSee('Viewable Home');
    });

    it('deletes a property and its stored images', function () {
        Storage::fake('public');
        $admin = User::factory()->create();
        Storage::disk('public')->put('properties/delete-me.jpg', 'image-data');
        $property = Property::create([
            'agent_id' => $admin->id,
            'title' => 'Property to Delete',
            'type' => 'house',
            'listing_type' => 'sale',
            'address' => '1 Main Street',
            'city' => 'Uyo',
            'state' => 'Akwa Ibom',
            'price' => 5000000,
            'price_period' => 'one_time',
            'property_id' => 'PROP-DELETE-001',
            'size' => 250,
            'thumbnail' => '/storage/properties/delete-me.jpg',
            'images' => ['/storage/properties/delete-me.jpg'],
        ]);

        $response = $this->actingAs($admin)->delete(route('properties.destroy', $property));

        $response->assertRedirect(route('properties.index'));
        $this->assertModelMissing($property);
        Storage::disk('public')->assertMissing('properties/delete-me.jpg');
    });
});
