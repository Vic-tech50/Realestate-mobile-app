<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::latest()->get();

        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->propertyRules());
        $images = $this->storeImages($request);
        $agentId = $validated['user_id'] ?? $request->user()->getKey();

        $property = Property::create($this->propertyAttributes($validated, $images, $agentId) + [
            'property_id' => 'PROP-'.Str::upper(Str::random(12)),
        ]);

        return redirect()->route('properties.index')->with('message', 'Property added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property): View
    {
        $property->load('user');

        return view('admin.properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property): View
    {
        $agents = User::where('role', 'agent')->latest()->get();

        return view('admin.properties.edit', compact('property', 'agents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property): RedirectResponse
    {
        $validated = $request->validate($this->propertyRules());
        $images = $property->images ?? [];
        $newImages = $this->storeImages($request);

        if ($newImages !== []) {
            $images = [...$images, ...$newImages];
        }

        $agentId = $validated['user_id'] ?? $property->agent_id;
        $oldImages = $property->images ?? [];
        $property->update($this->propertyAttributes($validated, $images, $agentId));

        if ($newImages !== []) {
            $this->deleteStoredImages(array_diff($oldImages, $images));
        }

        return redirect()->route('properties.index')->with('message', 'Property updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $this->deleteStoredImages($property->images ?? []);
        $property->delete();

        return redirect()->route('properties.index')->with('message', 'Property deleted successfully.');
    }

    /**
     * @return array<string, array<int, string>>
     */
    private function propertyRules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:100'],
            'listing_type' => ['required', 'in:sale,rent,lease'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['required', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'toilets' => ['nullable', 'integer', 'min:0'],
            'parking_spaces' => ['nullable', 'integer', 'min:0'],
            'size' => ['required', 'integer', 'min:1'],
            'size_unit' => ['required', 'in:sqm,sqft,plot,acre'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['string', 'max:100'],
            'price' => ['required', 'integer', 'min:0'],
            'payment_period' => ['required', 'in:one_time,monthly,yearly'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'status' => ['required', 'in:pending,available,sold,rented'],
            'images' => ['nullable', 'array', 'max:20'],
            'images.*' => ['image', 'mimes:jpeg,jpg,png', 'max:5120'],
        ];
    }

    /**
     * @param  array<string, mixed>  $validated
     * @param  array<int, string>  $images
     * @return array<string, mixed>
     */
    private function propertyAttributes(array $validated, array $images, int $agentId): array
    {
        return [
            'agent_id' => $agentId,
            'title' => $validated['title'],
            'type' => $validated['type'],
            'listing_type' => $validated['listing_type'],
            'description' => $validated['description'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'] ?? 'Nigeria',
            'landmark' => $validated['landmark'] ?? null,
            'bedrooms' => $validated['bedrooms'] ?? 0,
            'bathrooms' => $validated['bathrooms'] ?? 0,
            'toilets' => $validated['toilets'] ?? 0,
            'garage' => $validated['parking_spaces'] ?? 0,
            'size' => $validated['size'],
            'size_unit' => $validated['size_unit'],
            'amenities' => $validated['amenities'] ?? [],
            'price' => $validated['price'],
            'price_period' => $validated['payment_period'],
            'status' => $validated['status'],
            'images' => $images,
            'thumbnail' => $images[0] ?? null,
        ];
    }

    /**
     * @return array<int, string>
     */
    private function storeImages(Request $request): array
    {
        $paths = [];

        foreach ($request->file('images', []) as $image) {
            $path = $image->store('properties', 'public');
            $paths[] = asset('storage/'.$path);
        }

        return $paths;
    }

    /**
     * @param  array<int, string>  $images
     */
    private function deleteStoredImages(array $images): void
    {
        $paths = collect($images)
            ->map(fn (string $image): string => Str::after(parse_url($image, PHP_URL_PATH) ?: '', '/storage/'))
            ->filter(fn (string $path): bool => Str::startsWith($path, 'properties/'))
            ->values()
            ->all();

        if ($paths !== []) {
            Storage::disk('public')->delete($paths);
        }
    }
}
