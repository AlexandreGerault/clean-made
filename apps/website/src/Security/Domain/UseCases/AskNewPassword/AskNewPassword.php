<?php

declare(strict_types=1);

namespace App\Security\Domain\UseCases\AskNewPassword;

use App\Security\Domain\Gateways\MailGateway;
use App\Security\Domain\ValueObjects\Email;

class AskNewPassword
{
    public function __construct(private readonly MailGateway $mailGateway)
    {
    }

    public function executes(AskNewPasswordRequest $request): void
    {
        $this->mailGateway->send(new Email($request->to), 'New password', 'New password');
    }
}
