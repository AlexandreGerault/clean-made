<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

it('should send an email', function () {
    $sut = new AskNewPasswordSUT();
    $sut->run();

    expect($sut->mailGateway->sent)->toBeTrue();
    expect($sut->mailGateway->lastEmail->to->value)->toBe('user@email.fr');
    expect($sut->mailGateway->lastEmail->subject)->toBe('New password');
    expect($sut->mailGateway->lastEmail->body)->toContain('New password');
});
