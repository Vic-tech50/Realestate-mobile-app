<?php

namespace App\NativeComponents;

use App\Services\AuthStorage;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class agentprofile extends NativeComponent
{
    public array $user = [];

    public function mount(): void
    {
        $this->user = AuthStorage::user() ?? [
            'name' => 'Agent User',
            'email' => 'agent@example.com',
            'phone' => '+234 800 000 0000',
            'role' => 'Property Agent',
        ];
    }

    public function edit(): void
    {

        $this->navigate('/editprofile');
    }

    public function logout(): void
    {
        AuthStorage::clear();

        $this->navigate('/login');
    }

    public function render(): View
    {
        return view('native.agentprofile', [
            'user' => $this->user,
        ]);
    }
}
