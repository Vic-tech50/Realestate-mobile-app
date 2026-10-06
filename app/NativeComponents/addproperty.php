<?php

namespace App\NativeComponents;

use App\Models\Property;
use App\Models\User;
use App\Services\AuthStorage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Attributes\On;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

class addproperty extends NativeComponent
{
    public string $title = '';

    public string $property_type = '';

    public string $listing_type = '';

    public string $address = '';

    public string $city = '';

    public string $state = '';

    public string $country = 'Nigeria';

    public string $landmark = '';

    public string $bedrooms = '';

    public string $bathrooms = '';

    public string $toilets = '';

    public string $parking = '';

    public string $size = '';

    public string $size_unit = 'sqm';

    public string $price = '';

    public string $price_period = 'Total Price';

    public string $description = '';

    public ?string $thumbnail = null;

    public array $images = [];

    public array $amenities = [];

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

    public bool $isSaving = false;

    public string $errorMessage = '';

    public function save(): void
    {
        $this->isSaving = true;
        $this->errorMessage = '';

        try {
            $user = AuthStorage::user() ?? [];
            $agentId = (int) ($user['id'] ?? 0);
            $agent = User::find($agentId);

            if (! $agent || $agent->role !== 'agent' || $agent->verification_status !== 'verified') {
                $this->errorMessage = 'A verified agent account is required to publish a property.';

                return;
            }

            $validator = Validator::make([
                'title' => $this->title,
                'property_type' => $this->property_type,
                'listing_type' => $this->listing_type,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'landmark' => $this->landmark,
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
                'property_type' => ['required', 'in:House,Duplex,Apartment,Flat,Bungalow,Land,Office,Shop,Warehouse'],
                'listing_type' => ['required', 'in:For Sale,For Rent,For Lease'],
                'address' => ['required', 'string', 'max:255'],
                'city' => ['required', 'string', 'max:255'],
                'state' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:100'],
                'landmark' => ['nullable', 'string', 'max:255'],
                'bedrooms' => ['nullable', 'integer', 'min:0'],
                'bathrooms' => ['nullable', 'integer', 'min:0'],
                'toilets' => ['nullable', 'integer', 'min:0'],
                'parking' => ['nullable', 'integer', 'min:0'],
                'size' => ['required', 'integer', 'min:1'],
                'size_unit' => ['required', 'in:sqm,sqft,plot,acre'],
                'price' => ['required', 'integer', 'min:0'],
                'price_period' => ['required', 'in:Total Price,Per Month,Per Year'],
                'description' => ['required', 'string', 'min:20'],
            ]);

            if ($validator->fails()) {
                $this->errorMessage = $validator->errors()->first();

                return;
            }

            $payload = [
                'agent_id' => $agentId,
                'title' => $this->title,
                'type' => $this->property_type,
                'listing_type' => $this->listingTypeValue(),
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
                'landmark' => $this->landmark !== '' ? $this->landmark : null,
                'property_id' => 'PROP-' . strtoupper(bin2hex(random_bytes(6))),
                'bedrooms' => $this->bedrooms !== '' ? (int) $this->bedrooms : 0,
                'bathrooms' => $this->bathrooms !== '' ? (int) $this->bathrooms : 0,
                'toilets' => $this->toilets !== '' ? (int) $this->toilets : 0,
                'garage' => $this->parking !== '' ? (int) $this->parking : 0,
                'size' => (int) $this->size,
                'size_unit' => $this->size_unit,
                'price' => (int) $this->price,
                'price_period' => $this->pricePeriodValue(),
                'description' => $this->description,
                'status' => 'pending',
                'amenities' => $this->selectedAmenities(),
            ];

            if (! empty($this->images)) {
                $payload['thumbnail'] = $this->images[0];
                $payload['images'] = $this->images;
            }

            Property::create($payload);
            Dialog::toast('Property added successfully.');
            $this->navigate('/agentdashboard');
        } finally {
            $this->isSaving = false;
        }
    }

    public function selectImages(): void
    {
        Camera::pickImages('images', true);
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

    #[On(MediaSelected::class)]
    public function handleMediaSelected(
        bool $success,
        array $files = [],
        int $count = 0
    ): void {
        if (! $success || empty($files)) {
            return;
        }

        $this->images = array_values(array_filter(array_map(
            fn(mixed $file): ?string => is_array($file)
                ? ($file['path'] ?? $file['uri'] ?? null)
                : (is_string($file) ? $file : null),
            $files
        )));

        $this->thumbnail = $this->images[0] ?? null;
    }

    public function render(): View
    {
        $authUser = AuthStorage::user() ?? [];

        $user = User::find($authUser['id'] ?? 0);

        if (! $user || $user->verification_status !== 'verified') {
            // $this->navigate('/verificationstatus');

            return view('native.verificationstatus', [
                'user' => $user,
            ]);
        }

        return view('native.addproperty', [
            'images' => $this->images,
            'errorMessage' => $this->errorMessage,
            'isSaving' => $this->isSaving,
        ]);
    }
}
