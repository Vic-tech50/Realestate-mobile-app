<?php

namespace App\NativeComponents;

use App\Services\AuthStorage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class login extends NativeComponent
{
    public string $email = '';

    public string $password = '';

    public bool $isAuthenticating = false;

    public string $errorMessage = '';

    public function authenticate(): void
    {
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

                $this->isAuthenticating = false;

                return;
            }
            $baseUrl = config('services.api.url');

            // Ensure the URL has a scheme. If not, default to http.
            if (! preg_match('~^https?://~i', $baseUrl)) {
                $baseUrl = 'http://'.$baseUrl;
            }

            $url = rtrim($baseUrl, '/').'/api/auth/login';

            Log::info('Mobile login request', [
                'url' => $url,
                'email' => $this->email,
            ]);

            $response = Http::acceptJson()
                ->timeout(30)
                ->post(
                    $url,
                    [
                        'email' => $this->email,
                        'password' => $this->password,
                        'device_name' => 'NativePHP Mobile',
                    ]
                );

            if ($response->successful()) {

                $data = $response->json();

                AuthStorage::save(
                    $data['access_token'] ?? '',
                    $data['refresh_token'] ?? '',
                    $data['user'] ?? []
                );

                $this->navigate('/agentdashboard');

                $this->isAuthenticating = false;

                return;
            }

            // Log non-success responses to help diagnose connection/server issues
            Log::error('Mobile login HTTP failure', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->status() === 422) {
                $this->errorMessage = 'Invalid email or password.';
                $this->isAuthenticating = false;

                return;
            }

            if ($response->status() === 403) {
                $this->errorMessage = $response->json('message')
                    ?? 'You are not authorized to use this application.';

                $this->isAuthenticating = false;

                return;
            }

            $this->errorMessage = 'Unable to login. Please try again.';
        } catch (\Throwable $e) {

            Log::error('Mobile login failed', [
                'message' => $e->getMessage(),
            ]);

            $this->errorMessage =
                'Unable to connect to the server.';
        } finally {
            $this->isAuthenticating = false;
        }
    }

    public function register(): void
    {

        $this->navigate('/agent');
    }
     public function property(): void
    {
        $this->navigate('/');
    }

    public function render(): View
    {
        return view('native.login');
    }
}
