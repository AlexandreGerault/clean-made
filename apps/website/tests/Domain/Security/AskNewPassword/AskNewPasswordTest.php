<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

it('should send an email when user exists', function () {
    $sut = new AskNewPasswordSUT();
    $sut->run();

    expect($sut->mailGateway->sent)->toBeTrue();
    expect($sut->mailGateway->lastEmail->to->value)->toBe('user@email.fr');
    expect($sut->mailGateway->lastEmail->subject)->toBe('New password');
    expect($sut->mailGateway->lastEmail->body)->toContain('New password for user@email.fr');
    expect($sut->presenter->response)->toBe('notificationSent');
});

it('should not send an email when user does not exists but presents the same response', function () {
    $sut = new AskNewPasswordSUT();
    $sut->whenEmailDoesNotMatchAnyUser();
    $sut->run();

    expect($sut->mailGateway->sent)->toBeFalse();
    expect($sut->presenter->response)->toBe('notificationSent');
});
