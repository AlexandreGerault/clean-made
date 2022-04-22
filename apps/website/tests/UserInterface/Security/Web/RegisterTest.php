<?php

declare(strict_types=1);

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows the register page', function () {
    get(route('security.register.show'))->assertSuccessful()->assertSee('inscrire');
});

it('registers a user', function () {
    post(
        route('security.register.post'),
        [
            'email' => 'user@email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]
    )
        ->assertSessionHasNoErrors()
        ->assertRedirect();
});
