<?php

namespace App\NativeComponents;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class sample extends NativeComponent
{
    public string $email = '';

    public string $password = '';

    public string $errorMessage = '';

    public bool $isAuthenticating = false;

    public function authenticate(): void
    {
        if ($this->isAuthenticating) {
            return;
        }

        $this->isAuthenticating = true;
        $this->errorMessage = '';

        try {
            $validator = Validator::make(
                ['email' => $this->email, 'password' => $this->password],
                [
                    'email' => ['required', 'email'],
                    'password' => ['required', 'string'],
                ],
            );

            if ($validator->fails()) {
                $this->errorMessage = $validator->errors()->first();

                return;
            }

            if (! Auth::attempt($validator->validated())) {
                // Do not retain a password after an unsuccessful sign-in attempt.
                $this->password = '';
                $this->errorMessage = 'The email or password is incorrect.';

                return;
            }

            $this->navigate('/agentdashboard');
        } finally {
            $this->isAuthenticating = false;
        }
    }

    public function register(): void
    {

        $this->navigate('/agent');
    }

    public function render(): View
    {
        return view('native.login');
    }
}
