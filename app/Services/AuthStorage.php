<?php

namespace App\Services;

use Native\Mobile\Facades\SecureStorage;

class AuthStorage
{
    private const ACCESS_TOKEN = 'auth_access_token';

    private const REFRESH_TOKEN = 'auth_refresh_token';

    private const USER = 'auth_user';

    public static function save(
        string $accessToken,
        string $refreshToken,
        array $user
    ): void {
        SecureStorage::set(
            self::ACCESS_TOKEN,
            $accessToken
        );

        SecureStorage::set(
            self::REFRESH_TOKEN,
            $refreshToken
        );

        SecureStorage::set(
            self::USER,
            json_encode($user)
        );
    }

    public static function accessToken(): ?string
    {
        return SecureStorage::get(
            self::ACCESS_TOKEN
        ) ?: null;
    }

    public static function refreshToken(): ?string
    {
        return SecureStorage::get(
            self::REFRESH_TOKEN
        ) ?: null;
    }

    public static function user(): ?array
    {
        $user = SecureStorage::get(
            self::USER
        );

        return $user
            ? json_decode($user, true)
            : null;
    }

    public static function clear(): void
    {
        SecureStorage::delete(
            self::ACCESS_TOKEN
        );

        SecureStorage::delete(
            self::REFRESH_TOKEN
        );

        SecureStorage::delete(
            self::USER
        );
    }
}
