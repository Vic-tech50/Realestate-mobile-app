<?php

namespace App\NativeComponents;

use App\Models\Property;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Facades\Browser;
use Native\Mobile\Facades\Dialog;

class viewproperty extends NativeComponent
{
    public Property $property;

    public function mount(): void
    {
        $propertyId = (int) $this->param('id');
        $this->property = Property::with('user')
            ->findOrFail($propertyId);

        $this->property->increment('views_count');

        $this->property->refresh();
    }

    public function callAgent(): void
    {
        $property = $this->getContactProperty();

        if (! $property || ! $property->user?->phone) {
            Dialog::toast('Agent phone number is unavailable.');

            return;
        }

        $property->increment('call_clicks');

        $phone = preg_replace('/[^0-9+]/', '', $property->user->phone);

        Browser::open('tel:'.$phone);
    }

    public function whatsappAgent(): void
    {
        $property = $this->getContactProperty();

        if (! $property || ! $property->user?->phone) {
            Dialog::toast('Agent phone number is unavailable.');

            return;
        }

        $property->increment('whatsapp_clicks');

        // WhatsApp requires an international number without + or spaces.
        $phone = preg_replace('/\D/', '', $property->user->phone);

        // Convert a Nigerian local number such as 08012345678 to 2348012345678.
        if (str_starts_with($phone, '0')) {
            $phone = '234'.substr($phone, 1);
        }

        Browser::open('https://wa.me/'.$phone);
    }

    public function emailAgent(): void
    {
        $property = $this->getContactProperty();

        if (! $property || ! $property->user?->email) {
            Dialog::toast('Agent email address is unavailable.');

            return;
        }

        $property->increment('email_clicks');

        Browser::open('mailto:'.$property->user->email);
    }

    private function getContactProperty(): ?Property
    {
        $propertyId = (int) $this->param('id');

        if (! $propertyId) {
            return null;
        }

        return Property::with('user')->find($propertyId);
    }

    // public function whatsappAgent(): void
    // {
    //     $propertyId = (int) $this->param('id');
    //     $property = Property::find($propertyId) ?? Property::latest()->first();
    //     Browser::inApp('https://wa.me/' . $property->user?->phone);
    // }

    // public function callAgent(): void
    // {
    //     $propertyId = (int) $this->param('id');
    //     $property = Property::find($propertyId) ?? Property::latest()->first();
    //     Browser::open('tel:' . $property->user?->phone);
    // }

    // public function emailAgent(): void
    // {
    //     $propertyId = (int) $this->param('id');
    //     $property = Property::find($propertyId) ?? Property::latest()->first();
    //     Browser::open('mailto:' . $property->user?->email);
    // }

    public function render(): View
    {
        $propertyId = (int) $this->param('id');
        $property = Property::find($propertyId) ?? Property::latest()->first();

        return view('native.viewproperty', compact('property'));
    }
}
