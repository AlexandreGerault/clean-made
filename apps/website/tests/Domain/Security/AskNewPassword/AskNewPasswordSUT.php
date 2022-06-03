<?php

declare(strict_types=1);

namespace Tests\Domain\Security\AskNewPassword;

use App\Security\Domain\UseCases\AskNewPassword\AskNewPassword;
use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordRequest;

class AskNewPasswordSUT
{
    public AskNewPassword $askNewPassword;
    public InMemoryMailGateway $mailGateway;

    public function __construct()
    {
    }

    public function run(): self
    {
        $this->mailGateway = new InMemoryMailGateway();

        $askNewPassword = new AskNewPassword($this->mailGateway);
        $askNewPassword->executes(new AskNewPasswordRequest('user@email.fr'));

        return $this;
    }
}
