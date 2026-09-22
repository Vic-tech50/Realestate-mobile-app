<?php

namespace App\NativeComponents;

use App\Models\Property;
use App\Services\AuthStorage; // to get the auth data
use Illuminate\View\View;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;
use Native\Mobile\Events\Alert\ButtonPressed;
use Native\Mobile\Facades\Dialog;

class agentdashboard extends NativeComponent
{
    public function addProperty(): void
    {
        $this->navigate('/addproperty')->transition(Transition::SlideFromBottom);
    }

    public function editProperty(int $id): void
    {
        $this->navigate('/editproperty/'.$id)->transition(Transition::SlideFromBottom);
    }

    public function confirmDelete(int $id): void
    {
        Dialog::alert(
            'Delete Property',
            'Are you sure you want to delete this property? This action cannot be undone.',
            [
                ['label' => 'Cancel', 'style' => 'cancel'],
                ['label' => 'Delete', 'style' => 'destructive'],
            ]
        )
            ->id('delete-property-'.$id)
            ->show();
    }

    /**
     * Handle the native dialog button
     */
    // #[OnNative(ButtonPressed::class)]
    // public function handleDeleteConfirmation($index, string $label, $id = null): void
    // {
    //     // Make sure this event belongs to our delete dialog
    //     if (!str_starts_with($id ?? '', 'delete-property-')) {
    //         return;
    //     }

    //     // Only delete when Delete is pressed
    //     if ($label !== 'Delete') {
    //         return;
    //     }

    //     // Get property ID from:
    //     // delete-property-25
    //     $propertyId = (int) str_replace(
    //         'delete-property-',
    //         '',
    //         $id
    //     );

    //     $this->deleteProperty($propertyId);
    // }

    public function deleteProperty(int $id): void
    {
        $property = Property::findOrFail($id);
        $property->delete();
        Dialog::toast('Property deleted successfully.');
        $this->back();
    }

    // public function agentprofile(): void
    // {
    //     $this->navigate('/agentprofile')->transition(Transition::SlideFromBottom);
    // }

    public function render(): View
    {
        $user = AuthStorage::user() ?? [];
        $userId = (int) ($user['id'] ?? 0);

        $properties = Property::query()
            ->when($userId > 0, fn ($query) => $query->where('agent_id', $userId))
            ->latest()
            ->get();

        return view('native.agentdashboard', [
            'properties' => $properties,
            'user' => $user,
        ]);
    }
}
