<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\ValueObjects\Email;

it('should create a token and send an email when user exists', function () {
    $sut = new AskNewPasswordSUT();
    $sut->run();

    $user = $sut->userRepository->findByEmail(new Email('user@email.fr'));

    expect($sut->mailGateway->sent)->toBeTrue()
        ->and($sut->mailGateway->lastEmail->to->value)->toBe('user@email.fr')
        ->and($sut->mailGateway->lastEmail->subject)->toBe('New password')
        ->and($sut->mailGateway->lastEmail->body)->toContain('New password for user@email.fr')
        ->and($sut->presenter->response)->toBe('notificationSent')
        ->and($user->snapshot()->passwordToken)->not()->toBeNull();
});

it('should not send an email when user does not exists but presents the same response', function () {
    $sut = new AskNewPasswordSUT();
    $sut->whenEmailDoesNotMatchAnyUser();
    $sut->run();

    expect($sut->mailGateway->sent)->toBeFalse()
        ->and($sut->presenter->response)->toBe('notificationSent');
});
