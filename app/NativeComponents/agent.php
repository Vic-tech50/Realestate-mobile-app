<?php

namespace App\NativeComponents;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Native\Mobile\Attributes\OnNative;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;

class agent extends NativeComponent
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $password = '';

    public string $password_confirmation = '';

    // public ?string $profileImage = null;

    public bool $isSaving = false;

    public string $errorMessage = '';

    public function save()
    {
        $this->isSaving = true;

        try {
            $validator = Validator::make([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ], [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['required', 'string', 'min:10', 'max:20'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            // if ($validator->fails()) {
            //     throw new ValidationException($validator);
            // }

            if ($validator->fails()) {
                $this->errorMessage = $validator->errors()->first();

                return;
            }

            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => bcrypt($this->password),
            ]);

            $this->navigate('/login');
        } finally {
            $this->isSaving = false;
        }
    }

    public function login(): void
    {

        $this->navigate('/login');
    }

    // public function camera(): void
    // {
    //     $this->selectProfileImage();
    // }

    // public function selectProfileImage(): void
    // {
    //     Camera::pickImages('profile_image', false);
    // }

    // #[OnNative(MediaSelected::class)]
    // public function handleMediaSelected(bool $success, array $files = [], int $count = 0): void
    // {
    //     if (! $success || empty($files)) {
    //         return;
    //     }

    //     $this->profileImage = $files[0] ?? null;
    // }

    public function property(): void
    {
        $this->navigate('/');
    }

    public function render(): View
    {
        return view('native.agent');
    }
}
