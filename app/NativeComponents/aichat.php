<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class aichat extends NativeComponent
{
     public string $message = '';

    public array $messages = [];

    public function mount(): void
    {
        $this->messages = [
            [
                'role' => 'assistant',
                'message' => 'Hello! I\'m your property assistant. Ask me anything about houses, land, prices, locations, property documents, or buying property.',
            ],
        ];
    }

    public function sendMessage(): void
    {
        $message = trim($this->message);

        if ($message === '') {
            return;
        }

        $this->messages[] = [
            'role' => 'user',
            'message' => $message,
        ];

        /*
         * Later, send $message to your AI API here.
         */

        $this->messages[] = [
            'role' => 'assistant',
            'message' => 'I can help you with property searches, land verification, property documents, prices, locations, and general real-estate questions.',
        ];

        $this->message = '';
    }

    public function ask(string $question): void
    {
        $this->message = $question;

        $this->sendMessage();
    }

    public function goBack()
    {
        $this->navigate('home');
    }
    public function render(): View
    {
        return view('native.aichat');
    }
}
