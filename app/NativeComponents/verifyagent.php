<?php

namespace App\NativeComponents;

use App\Services\AuthStorage;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class verifyagent extends NativeComponent
{
    public array $user = [];

    public function mount(): void
    {
        $this->user = AuthStorage::user();
    }

    public function upload()
    {
        $this->navigate('/upload');
    }

    public function render(): View
    {
        return view('native.verifyagent', [
            'user' => $this->user,
        ]);
    }
}
