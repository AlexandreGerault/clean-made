<?php

declare(strict_types=1);

use Database\Factories\UserFactory;

use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('shows the login page', function () {
    get(route('security.login.show'))->assertSuccessful()->assertSee('Me connecter');
});

it('authenticates a user', function () {
    UserFactory::new()->state(['email' => 'user@email.fr'])->create();
    post(route('security.login.post'), ['email' => 'user@email.fr', 'password' => 'password'])->assertSessionHasNoErrors()->assertRedirect();
    expect(auth()->check())->toBeTrue();
});

it('fails to authenticate a user', function () {
    UserFactory::new()->state(['email' => 'user@email.fr'])->create();
    post(route('security.login.post'), ['email' => 'user@email.fr', 'password' => 'wrong'])->assertSessionHasErrors()->assertRedirect();
    expect(auth()->check())->toBeFalse();
});
