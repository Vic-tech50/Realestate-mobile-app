<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Mobile/API authentication endpoints used by the NativePHP client
Route::prefix('auth')->group(function () {
    Route::post('/login', function (Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 422);
        }

        // Create a personal access token for this device
        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'access_token' => $token,
            // keep a refresh token key for compatibility — empty for now
            'refresh_token' => '',
            'user' => $user,
        ]);
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', function (Request $request) {
            return response()->json($request->user());
        });

        Route::post('/logout', function (Request $request) {
            // Revoke the token that was used to authenticate the current request
            $request->user()->currentAccessToken()->delete();

            return response()->json(['message' => 'Logged out']);
        });
    });
});

// Simple health check to verify the configured API base URL
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'api_url' => config('services.api.url'),
    ]);
});

// <?php

// use App\Http\Controllers\Api\AuthController;
// use Illuminate\Support\Facades\Route;

// Route::prefix('auth')->group(function () {

//     Route::post('/login', [
//         AuthController::class,
//         'login',
//     ]);

//     Route::post('/refresh', [
//         AuthController::class,
//         'refresh',
//     ]);

//     Route::middleware('auth:sanctum')->group(function () {

//         Route::get('/user', [
//             AuthController::class,
//             'user',
//         ]);

//         Route::post('/logout', [
//             AuthController::class,
//             'logout',
//         ]);
//     });
// });
