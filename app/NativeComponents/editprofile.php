<?php

namespace App\NativeComponents;

use App\Models\User;
use App\Services\AuthStorage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Native\Mobile\Attributes\On;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;
use Native\Mobile\Facades\Dialog;

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

    public string $avatarFilePath = '';

    public bool $isSaving = false;

    public string $errorMessage = '';

    public function mount(): void
    {
        $this->user = AuthStorage::user() ?? [];
        $this->name = $this->user['name'] ?? '';
        $this->email = $this->user['email'] ?? '';
        $this->phone = $this->user['phone'] ?? '';
        $this->avatarPreview = $this->resolveAvatarPath($this->user['avatar_path'] ?? null) ?? '';
        $this->avatarFilePath = $this->avatarPreview;
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
                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user['id'] ?? null),
                ],
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

            if ($this->avatarFilePath !== '') {
                $avatarPath = $this->resolveAvatarPath($this->avatarFilePath);

                if ($avatarPath && $avatarPath !== $user->avatar_path) {
                    $storedAvatarPath = Storage::disk('local')->putFileAs(
                        'avatars',
                        new File($avatarPath),
                        bin2hex(random_bytes(16)) . '.' . (pathinfo($avatarPath, PATHINFO_EXTENSION) ?: 'jpg')
                    );

                    if ($user->avatar_path && Storage::disk('local')->exists($user->avatar_path)) {
                        Storage::disk('local')->delete($user->avatar_path);
                    }

                    $user->avatar_path = $storedAvatarPath;
                    $this->avatarPreview = Storage::disk('local')->path($storedAvatarPath);
                }
            }

            if ($this->password !== '') {
                $user->password = Hash::make($this->password);
            }

            $user->save();

            $this->user = $user->toArray();
            AuthStorage::save(
                AuthStorage::accessToken() ?? '',
                AuthStorage::refreshToken() ?? '',
                $this->user
            );

            // Clear password fields
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            Dialog::toast('Changes Saved successfully.');
            $this->navigate('/agentprofile');
        } finally {

            $this->isSaving = false;
        }
    }

    public function selectAvatar(): void
    {
        Camera::pickImages('avatar', false);
    }

    #[On(MediaSelected::class)]
    public function handleMediaSelected(
        bool $success,
        array $files = [],
        int $count = 0
    ): void {
        if (! $success || empty($files)) {
            return;
        }

        $file = $files[0] ?? null;
        $preview = $this->extractAvatarReference($file);
        $path = $this->resolveAvatarPath($file);

        if ($preview) {
            $this->avatarPreview = $preview;
        }

        if ($path) {
            $this->avatarFilePath = $path;
        }
    }

    public function render(): View
    {
        return view('native.editprofile', [
            'user' => $this->user,
            'avatarPreview' => $this->avatarPreview,
        ]);
    }

    private function resolveAvatarPath(mixed $file): ?string
    {
        if (is_array($file)) {
            foreach (['path', 'uri', 'url', 'file', 'localPath'] as $key) {
                if (isset($file[$key])) {
                    return $this->resolveAvatarPath($file[$key]);
                }
            }

            return null;
        }

        if (! is_string($file) || trim($file) === '') {
            return null;
        }

        $path = trim($file);

        if (str_starts_with($path, 'file://')) {
            $path = rawurldecode((string) parse_url($path, PHP_URL_PATH));
        }

        if (str_starts_with($path, 'content://') || str_starts_with($path, 'http')) {
            return null;
        }

        if (is_file($path) && is_readable($path)) {
            return $path;
        }

        $storagePath = Storage::disk('local')->path($path);

        return is_file($storagePath) && is_readable($storagePath)
            ? $storagePath
            : null;
    }

    private function extractAvatarReference(mixed $file): ?string
    {
        if (is_array($file)) {
            foreach (['path', 'uri', 'url', 'file', 'localPath'] as $key) {
                if (isset($file[$key])) {
                    return $this->extractAvatarReference($file[$key]);
                }
            }

            return null;
        }

        return is_string($file) && trim($file) !== ''
            ? trim($file)
            : null;
    }
}
