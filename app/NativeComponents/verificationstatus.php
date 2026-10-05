<?php

namespace App\NativeComponents;

use App\Models\User;
use App\Services\AuthStorage;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;

class verificationstatus extends NativeComponent
{
    public function render(): View
    {
        $authUser = AuthStorage::user() ?? [];

        $user = User::find($authUser['id'] ?? 0);

        return view('native.verificationstatus', [
            'user' => $user,
        ]);
    }

    public function addProperty(): void
    {
        $authUser = AuthStorage::user() ?? [];

        $user = User::find($authUser['id'] ?? 0);

        if (! $user || $user->verification_status !== 'verified') {
            return;
        }

        $this->navigate('/addproperty')
            ->transition(Transition::SlideFromBottom);
    }

    public function resubmit(): void
    {
        $this->navigate('/verifyagent')
            ->transition(Transition::SlideFromBottom);
    }
}
