<?php

declare(strict_types=1);

use App\Shared\Infrastructure\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\get;
use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertCount;

it('shows the ask new password request page', function () {
    get('/demande-nouveau-mot-de-passe')
        ->assertSuccessful()
        ->assertSee('Demande de nouveau mot de passe');
});

it('sends a new password mail', function () {
    Mail::fake();

    UserFactory::new()->state(['email' => 'user@example.com'])->create();

    postJson('/demande-nouveau-mot-de-passe', ['email' => 'user@example.com'])
        ->assertSuccessful();

    Mail::assertSent(function (Mailable $mailable) {
        return in_array(['name' => null, 'address' => 'user@example.com'], $mailable->to, true) && 'New password' === $mailable->subject;
    });

    assertDatabaseMissing('users', ['email' => 'user@example.com', 'reset_password_token' => null]);
    assertCount(1, User::query()->whereNotNull('reset_password_token')->get());
});
