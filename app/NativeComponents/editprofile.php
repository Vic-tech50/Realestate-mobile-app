<?php

namespace App\NativeComponents;

use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;
use App\Services\AuthStorage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class editprofile extends NativeComponent
{

    public array $user = [];
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $bio = '';

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public string $avatarPreview = '';

    public bool $isSaving = false;

    public string $errorMessage = '';

    public function mount(): void
    {
        $this->user = AuthStorage::user();
    }

    public function save(): void
    {
        $this->isSaving = true;
        $user = $this->user;

        try {
            $validator = Validator::make([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                // 'bio' => $this->bio,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ], [
                'name' => ['required', 'string', 'min:3', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'phone' => ['required', 'string', 'min:10', 'max:20'],
                // 'bio' => ['required', 'string', 'min:10', 'max:20'],
                'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            ]);


            if ($validator->fails()) {
                $this->errorMessage = $validator->errors()->first();
                return;
            }

            if ($this->password !== '') {

                if (! Hash::check($this->current_password, $user['password'])) {
                    $this->errorMessage = 'The current password is incorrect.';
                    return;
                }
            }

            $user = User::findOrFail($user['id']);
            $user->name = $this->name;
            $user->email = $this->email;
            $user->phone = $this->phone;

            if ($this->password !== '') {
                $user->password = Hash::make($this->password);
            }

            $user->save();



            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'password' => bcrypt($this->password),
            ]);
            $user->save();

            // Clear password fields
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';


            $this->navigate('/agentprofile');
        } finally {

            $this->isSaving = false;
        }
    }

    public function render(): View
    {
        return view('native.editprofile', [
            'user' => $this->user,
        ]);
    }
}
