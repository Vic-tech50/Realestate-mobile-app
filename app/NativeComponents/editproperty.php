<?php

namespace App\NativeComponents;

use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Facades\Dialog;

class editproperty extends NativeComponent
{
    public Property $property;

    public string $title = '';

    public string $property_type = '';

    public string $listing_type = '';

    public string $address = '';

    public string $city = '';

    public string $state = '';

    public string $bedrooms = '';

    public string $bathrooms = '';

    public string $parking = '';

    public string $size = '';

    public string $price = '';

    public string $price_period = 'total';

    public string $description = '';

    public bool $isSaving = false;

    public function mount(): void
    {
        $id = (int) $this->param('id');
        $this->property = Property::findOrFail($id);

        $this->title = $this->property->title ?? '';
        $this->property_type = $this->property->type ?? '';
        $this->listing_type = $this->property->listing_type ?? '';
        $this->address = $this->property->address ?? '';
        $this->city = $this->property->city ?? '';
        $this->state = $this->property->state ?? '';
        $this->bedrooms = (string) ($this->property->bedrooms ?? '');
        $this->bathrooms = (string) ($this->property->bathrooms ?? '');
        $this->parking = (string) ($this->property->parking ?? '');
        $this->size = $this->property->size ?? '';
        $this->price = (string) ($this->property->price ?? '');
        $this->price_period = $this->property->price_period ?? 'total';
        $this->description = $this->property->description ?? '';
    }

    public function save(): void
    {
        $validator = Validator::make([
            'title' => $this->title,
            'property_type' => $this->property_type,
            'listing_type' => $this->listing_type,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'parking' => $this->parking,
            'size' => $this->size,
            'price' => $this->price,
            'price_period' => $this->price_period,
            'description' => $this->description,
        ], [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'property_type' => ['required', 'string', 'max:255'],
            'listing_type' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'parking' => ['nullable', 'integer', 'min:0'],
            'size' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric', 'min:0'],
            'price_period' => ['required', 'string'],
            'description' => ['required', 'string', 'min:20'],
        ]);

        if ($validator->fails()) {
            return;
        }

        $this->property->update([
            'title' => $this->title,
            'type' => $this->property_type,
            'listing_type' => $this->listing_type,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'bedrooms' => $this->bedrooms !== '' ? (int) $this->bedrooms : null,
            'bathrooms' => $this->bathrooms !== '' ? (int) $this->bathrooms : null,
            'garage' => $this->parking !== '' ? (int) $this->parking : null,
            'size' => $this->size !== '' ? $this->size : null,
            'price' => (float) $this->price,
            'price_period' => $this->price_period,
            'description' => $this->description,
        ]);
        Dialog::toast('Changes Saved Successfully!');
        $this->navigate('/agentdashboard');
    }

    public function render(): View
    {
        return view('native.editproperty');
    }
}
