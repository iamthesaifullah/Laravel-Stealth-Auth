<?php

test('can generate and use token', function () {
    $user = \App\Models\User::factory()->create();
    $token = app(\StealthAuth\Services\StealthAuthManager::class)->forUser($user);

    $this->get('/stealth-login?token=' . $token)
        ->assertRedirect('/dashboard');
});
