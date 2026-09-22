<?php

namespace App\NativeComponents;

use App\Models\Property;
use App\Services\AuthStorage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Attributes\OnNative;
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

    public string $bedrooms = '';

    public string $bathrooms = '';

    public string $parking = '';

    public string $size = '';

    public string $price = '';

    public string $price_period = 'total';

    public string $description = '';

    public ?string $thumbnail = null;

    public array $images = [];

    public bool $isSaving = false;

    public string $errorMessage = '';

    public function save(): void
    {
        $this->isSaving = true;

        try {
            $user = AuthStorage::user() ?? [];
            $agentId = (int) ($user['id'] ?? 0);

            if ($agentId <= 0) {
                $this->errorMessage = 'Please log in before creating a property.';

                return;
            }

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
                $this->errorMessage = $validator->errors()->first();

                return;
            }

            $payload = [
                'agent_id' => $agentId,
                'title' => $this->title,
                'type' => $this->property_type,
                'listing_type' => $this->listing_type,
                'address' => $this->address,
                'city' => $this->city,
                'state' => $this->state,
                'property_id' => (string) random_int(1000000, 9999999),
                'bedrooms' => $this->bedrooms !== '' ? (int) $this->bedrooms : null,
                'bathrooms' => $this->bathrooms !== '' ? (int) $this->bathrooms : null,
                'garage' => $this->parking !== '' ? (int) $this->parking : null,
                'size' => $this->size !== '' ? $this->size : null,
                'price' => (float) $this->price,
                'price_period' => $this->price_period,
                'description' => $this->description,
                'status' => 'pending',
            ];

            // if ($this->thumbnail) {
            //     $payload['thumbnail'] = $this->thumbnail;
            // }

            // if (! empty($this->images)) {
            //     $payload['images'] = json_encode($this->images);
            // }

            Property::create($payload);
            Dialog::toast('Property added successfully.');
            $this->navigate('/agentdashboard');
        } finally {
            $this->isSaving = false;
        }
    }

    // public function selectThumbnail(): void
    // {
    //     Camera::pickImages('thumbnail', false);
    // }

    // public function selectImages(): void
    // {
    //     Camera::pickImages('images', true);
    // }

    // #[OnNative(MediaSelected::class)]
    // public function handleMediaSelected(string $field, bool $success, array $files = [], int $count = 0): void
    // {
    //     if (! $success || empty($files)) {
    //         return;
    //     }

    //     if ($field === 'thumbnail') {
    //         $this->thumbnail = $files[0] ?? null;

    //         return;
    //     }

    //     if ($field === 'images') {
    //         $this->images = $files;
    //     }
    // }

    public function render(): View
    {
        return view('native.addproperty', [
            // 'thumbnail' => $this->thumbnail,
            // 'images' => $this->images,
            'errorMessage' => $this->errorMessage,
            'isSaving' => $this->isSaving,
        ]);
    }
}
