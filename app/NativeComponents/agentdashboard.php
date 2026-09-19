<?php

namespace App\NativeComponents;

use App\Models\Property;
use App\Services\AuthStorage; // to get the auth data
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class agentdashboard extends NativeComponent
{
    public function addProperty(): void
    {
        $this->navigate('/addproperty')->transition(Transition::SlideFromBottom);
    }

    public function editProperty(int $id): void
    {

        $this->navigate('/editproperty/' . $id)->transition(Transition::SlideFromBottom);
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
            ->when($userId > 0, fn($query) => $query->where('agent_id', $userId))
            ->latest()
            ->get();

        return view('native.agentdashboard', [
            'properties' => $properties,
            'user' => $user,
        ]);
    }
}
