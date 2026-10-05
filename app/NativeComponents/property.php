<?php

namespace App\NativeComponents;

use App\Models\Property as ModelProp;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class property extends NativeComponent
{

    /** @var Collection<int, ModelProp> */
    public Collection $properties;

    public function mount(): void
    {
        $this->loadLatest();
    }

    public function loadLatest(): void
    {
        $this->properties = ModelProp::latest()->get();
    }
    public function agent(): void
    {

        $this->navigate('/login');
    }

    public function askai(): void
    {

        $this->navigate('/aichat');
    }

    public function viewProperty(int $id): void
    {

        $this->navigate('/viewproperty/' . $id)->transition(Transition::SlideFromBottom);
    }

    public function render(): View
    {
        return view('native.property', ['properties' => $this->properties]);
    }
}
