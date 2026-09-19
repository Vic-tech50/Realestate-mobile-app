<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Facades\Browser;

class About extends NativeComponent
{
    public function openDocs(): void
    {
        // Browser::inApp('https://nativephp.com/docs/mobile');
        $this->navigate('/service');
    }

    public function render(): View
    {
        return view('native.about');
    }
}
