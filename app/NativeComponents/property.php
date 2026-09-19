<?php

namespace App\NativeComponents;

use App\Models\Property as ModelProp;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class property extends NativeComponent
{
    public function agent(): void
    {

        $this->navigate('/login');
    }

    public function viewProperty(int $id): void
    {

        $this->navigate('/viewproperty/'. $id)->transition(Transition::SlideFromBottom);
    }

    public function render(): View
    {
        $properties = ModelProp::latest()->get();

        return view('native.property', compact('properties'));
    }
}
