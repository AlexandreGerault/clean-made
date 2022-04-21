<?php

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows the login page', function () {
    get(route('security.login'))->assertSuccessful()->assertSee("Me connecter");
});

it('authenticates a user', function () {
    post(route('security.authenticate'), ['email' => 'user@email', 'password' => 'password'])->assertSuccessful();
    expect(auth()->check())->toBeTrue();
});
