<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Native\Mobile\Testing\Native;

it('signs a user in with a valid email and password', function () {
    $user = User::factory()->create([
        'email' => 'agent@example.com',
        'password' => 'correct-password',
    ]);

    Native::visit('/login')
        ->set('email', 'agent@example.com')
        ->set('password', 'correct-password')
        ->call('authenticate')
        ->assertNavigatedTo('/');

    expect(Auth::id())->toBe($user->id);
});

it('does not sign a user in with invalid credentials', function () {
    User::factory()->create([
        'email' => 'agent@example.com',
        'password' => 'correct-password',
    ]);

    Native::visit('/login')
        ->set('email', 'agent@example.com')
        ->set('password', 'wrong-password')
        ->call('authenticate')
        ->assertSee('The email or password is incorrect.');

    expect(Auth::check())->toBeFalse();
});
