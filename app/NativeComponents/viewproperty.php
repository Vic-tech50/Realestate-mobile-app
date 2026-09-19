<?php

namespace App\NativeComponents;

use App\Models\Property;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Facades\Browser;

class viewproperty extends NativeComponent
{
    
   

    public function whatsappAgent(): void
    {
        $propertyId = (int) $this->param('id');
        $property = Property::find($propertyId) ?? Property::latest()->first();
        Browser::inApp('https://wa.me/' . $property->user?->phone);
    }

    public function callAgent(): void
    {
         $propertyId = (int) $this->param('id');
        $property = Property::find($propertyId) ?? Property::latest()->first();
        Browser::open('tel:'. $property->user?->phone);
    }

    public function emailAgent(): void
    {
         $propertyId = (int) $this->param('id');
        $property = Property::find($propertyId) ?? Property::latest()->first();
        Browser::open('mailto:'. $property->user?->email);
    }

    public function render(): View
    {
        $propertyId = (int) $this->param('id');
        $property = Property::find($propertyId) ?? Property::latest()->first();

        return view('native.viewproperty', compact('property'));
    }
}
