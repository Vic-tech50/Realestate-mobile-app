<?php

namespace App\NativeComponents;

use App\Models\Property as ModelProp;
use App\Models\Property as ModelsProperty;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class property extends NativeComponent
{
    /** @var Collection<int, ModelProp> */
    public Collection $properties;
    public string $search = '';

    public function mount(): void
    {
        $this->loadLatest();
    }

    public function loadLatest(): void
    {
        $this->properties = ModelProp::where('status', 'available')->latest()->with('user')->get();
    }

    public function agent(): void
    {

        $this->navigate('/welcome')->transition(Transition::SlideFromBottom);
    }

    public function askai(): void
    {

        $this->navigate('/aichat');
    }

    public function viewProperty(int $id): void
    {

        $this->navigate('/viewproperty/' . $id)->transition(Transition::SlideFromBottom);
    }

    public function updatedSearch(string $value): void
    {
        $this->search = $value;
        $this->search();
    }

    public function search(): void
    {
        $query = trim($this->search);

        if ($query === '') {
            $this->loadLatest();

            return;
        }

        $this->properties = ModelProp::where('status', 'available')
            ->with('user')
            ->where(function ($queryBuilder) use ($query) {
                $queryBuilder
                    ->where('title', 'like', "%{$query}%")
                    ->orWhere('address', 'like', "%{$query}%")
                    ->orWhere('city', 'like', "%{$query}%")
                    ->orWhere('state', 'like', "%{$query}%")
                    ->orWhere('type', 'like', "%{$query}%")
                    ->orWhere('property_id', 'like', "%{$query}%")
                    ->orWhereHas('user', function ($userQuery) use ($query) {
                        $userQuery
                            ->where('name', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%");
                    });
            })
            ->latest()
            ->get();
    }

    public function render(): View
    {
        return view('native.property', ['properties' => $this->properties]);
    }
}
