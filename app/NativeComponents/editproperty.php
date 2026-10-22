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

    public string $country = 'Nigeria';

    public string $landmark = '';

    public string $city = '';

    public string $state = '';

    public string $bedrooms = '';

    public string $bathrooms = '';

    public string $toilets = '';

    public string $parking = '';

    public string $size = '';

    public string $size_unit = 'sqm';

    public bool $amenityParking = false;

    public bool $amenitySwimmingPool = false;

    public bool $amenitySecurity = false;

    public bool $amenityGenerator = false;

    public bool $amenityBorehole = false;

    public bool $amenityElectricity = false;

    public bool $amenityAirConditioning = false;

    public bool $amenityFurnished = false;

    public bool $amenityGarden = false;

    public bool $amenityCctv = false;

    public bool $amenityInternet = false;

    public bool $amenityGate = false;

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
        $this->listing_type = match ($this->property->listing_type) {
            'sale' => 'For Sale',
            'rent' => 'For Rent',
            'lease' => 'For Lease',
            default => $this->property->listing_type ?? '',
        };
        $this->address = $this->property->address ?? '';
        $this->country = $this->property->country ?? 'Nigeria';
        $this->landmark = $this->property->landmark ?? '';
        $this->city = $this->property->city ?? '';
        $this->state = $this->property->state ?? '';
        $this->bedrooms = (string) ($this->property->bedrooms ?? '');
        $this->bathrooms = (string) ($this->property->bathrooms ?? '');
        $this->toilets = (string) ($this->property->toilets ?? '');
        $this->parking = (string) ($this->property->garage ?? '');
        $this->size = $this->property->size ?? '';
        $this->size_unit = $this->property->size_unit ?? 'sqm';
        $this->price = (string) ($this->property->price ?? '');
        $this->price_period = match ($this->property->price_period) {
            'one_time', 'total' => 'Total Price',
            'monthly' => 'Per Month',
            'yearly' => 'Per Year',
            default => $this->property->price_period ?? 'Total Price',
        };
        $this->description = $this->property->description ?? '';

        $amenities = $this->property->amenities ?? [];
        $this->amenityParking = in_array('Parking', $amenities, true);
        $this->amenitySwimmingPool = in_array('Swimming Pool', $amenities, true);
        $this->amenitySecurity = in_array('Security', $amenities, true);
        $this->amenityGenerator = in_array('Generator', $amenities, true);
        $this->amenityBorehole = in_array('Borehole', $amenities, true);
        $this->amenityElectricity = in_array('Electricity', $amenities, true);
        $this->amenityAirConditioning = in_array('Air Conditioning', $amenities, true);
        $this->amenityFurnished = in_array('Furnished', $amenities, true);
        $this->amenityGarden = in_array('Garden', $amenities, true);
        $this->amenityCctv = in_array('CCTV', $amenities, true);
        $this->amenityInternet = in_array('Internet', $amenities, true);
        $this->amenityGate = in_array('Gate', $amenities, true);
    }

    public function save(): void
    {
        $validator = Validator::make([
            'title' => $this->title,
            'property_type' => $this->property_type,
            'listing_type' => $this->listing_type,
            'address' => $this->address,
            'country' => $this->country,
            'landmark' => $this->landmark,
            'city' => $this->city,
            'state' => $this->state,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'toilets' => $this->toilets,
            'parking' => $this->parking,
            'size' => $this->size,
            'size_unit' => $this->size_unit,
            'price' => $this->price,
            'price_period' => $this->price_period,
            'description' => $this->description,
        ], [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'property_type' => ['required', 'string', 'max:255'],
            'listing_type' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:100'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'bedrooms' => ['nullable', 'integer', 'min:0'],
            'bathrooms' => ['nullable', 'integer', 'min:0'],
            'toilets' => ['nullable', 'integer', 'min:0'],
            'parking' => ['nullable', 'integer', 'min:0'],
            'size' => ['nullable', 'numeric'],
            'size_unit' => ['required', 'in:sqm,sqft,plot,acre'],
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
            'listing_type' => $this->listingTypeValue(),
            'address' => $this->address,
            'country' => $this->country,
            'landmark' => $this->landmark !== '' ? $this->landmark : null,
            'city' => $this->city,
            'state' => $this->state,
            'bedrooms' => $this->bedrooms !== '' ? (int) $this->bedrooms : null,
            'bathrooms' => $this->bathrooms !== '' ? (int) $this->bathrooms : null,
            'toilets' => $this->toilets !== '' ? (int) $this->toilets : 0,
            'garage' => $this->parking !== '' ? (int) $this->parking : null,
            'size' => $this->size !== '' ? $this->size : null,
            'size_unit' => $this->size_unit,
            'price' => (float) $this->price,
            'price_period' => $this->pricePeriodValue(),
            'amenities' => $this->selectedAmenities(),
            'description' => $this->description,
        ]);
        Dialog::toast('Changes Saved Successfully!');
        $this->navigate('/agentdashboard');
    }

    public function render(): View
    {
        return view('native.editproperty');
    }

    private function listingTypeValue(): string
    {
        return match ($this->listing_type) {
            'For Sale' => 'sale',
            'For Rent' => 'rent',
            'For Lease' => 'lease',
            default => $this->listing_type,
        };
    }

    private function pricePeriodValue(): string
    {
        return match ($this->price_period) {
            'Total Price' => 'one_time',
            'Per Month' => 'monthly',
            'Per Year' => 'yearly',
            default => $this->price_period,
        };
    }

    /**
     * @return array<int, string>
     */
    private function selectedAmenities(): array
    {
        return array_keys(array_filter([
            'Parking' => $this->amenityParking,
            'Swimming Pool' => $this->amenitySwimmingPool,
            'Security' => $this->amenitySecurity,
            'Generator' => $this->amenityGenerator,
            'Borehole' => $this->amenityBorehole,
            'Electricity' => $this->amenityElectricity,
            'Air Conditioning' => $this->amenityAirConditioning,
            'Furnished' => $this->amenityFurnished,
            'Garden' => $this->amenityGarden,
            'CCTV' => $this->amenityCctv,
            'Internet' => $this->amenityInternet,
            'Gate' => $this->amenityGate,
        ]));
    }
}
