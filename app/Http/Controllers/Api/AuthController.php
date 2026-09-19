<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RefreshToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private const ACCESS_TOKEN_MINUTES = 15;

    private const REFRESH_TOKEN_DAYS = 30;

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (
            ! $user ||
            ! Hash::check($credentials['password'], $user->password)
        ) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->role !== 'agent') {
            return response()->json([
                'message' => 'This mobile application is for agents only.',
            ], 403);
        }

        return DB::transaction(function () use ($user, $credentials) {

            $accessToken = $user->createToken(
                'native-mobile',
                ['agent'],
                now()->addMinutes(self::ACCESS_TOKEN_MINUTES)
            );

            $refreshToken = Str::random(96);

            $user->refreshTokens()->create([
                'token_hash' => hash('sha256', $refreshToken),
                'device_name' => $credentials['device_name'] ?? 'NativePHP Mobile',
                'expires_at' => now()->addDays(self::REFRESH_TOKEN_DAYS),
            ]);

            return response()->json([
                'user' => $user,
                'access_token' => $accessToken->plainTextToken,
                'token_type' => 'Bearer',
                'expires_in' => self::ACCESS_TOKEN_MINUTES * 60,
                'refresh_token' => $refreshToken,
                'refresh_expires_in' => self::REFRESH_TOKEN_DAYS * 24 * 60 * 60,
            ]);
        });
    }

    public function user(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function refresh(Request $request): JsonResponse
    {
        $request->validate([
            'refresh_token' => ['required', 'string'],
        ]);

        $hash = hash(
            'sha256',
            $request->refresh_token
        );

        $refreshToken = RefreshToken::with('user')
            ->where('token_hash', $hash)
            ->first();

        if (! $refreshToken || ! $refreshToken->isValid()) {
            return response()->json([
                'message' => 'Refresh token is invalid or expired.',
            ], 401);
        }

        $user = $refreshToken->user;

        if ($user->role !== 'agent') {
            $refreshToken->update([
                'revoked_at' => now(),
            ]);

            return response()->json([
                'message' => 'Account is not authorized.',
            ], 403);
        }

        return DB::transaction(function () use ($refreshToken, $user) {

            // Revoke current access token(s) for this device/session.
            $user->tokens()
                ->where('name', 'native-mobile')
                ->delete();

            // Rotate refresh token.
            $refreshToken->update([
                'revoked_at' => now(),
            ]);

            $newAccessToken = $user->createToken(
                'native-mobile',
                ['agent'],
                now()->addMinutes(self::ACCESS_TOKEN_MINUTES)
            );

            $newRefreshToken = Str::random(96);

            $user->refreshTokens()->create([
                'token_hash' => hash('sha256', $newRefreshToken),
                'device_name' => $refreshToken->device_name,
                'expires_at' => now()->addDays(self::REFRESH_TOKEN_DAYS),
            ]);

            return response()->json([
                'access_token' => $newAccessToken->plainTextToken,
                'token_type' => 'Bearer',
                'expires_in' => self::ACCESS_TOKEN_MINUTES * 60,
                'refresh_token' => $newRefreshToken,
                'refresh_expires_in' => self::REFRESH_TOKEN_DAYS * 24 * 60 * 60,
            ]);
        });
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->currentAccessToken()?->delete();

        $user->refreshTokens()
            ->whereNull('revoked_at')
            ->update([
                'revoked_at' => now(),
            ]);

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }
}
