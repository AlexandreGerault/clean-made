<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use App\Security\Domain\Gateways\MailGateway;
use App\Security\Domain\Gateways\UserRepository;
use App\Security\Domain\Services\PasswordHasher;
use App\Security\Domain\Services\PasswordMail;
use App\Security\Domain\Services\ResetPasswordTokenGenerator;
use App\Security\Domain\UseCases\Login\Login;
use App\Security\UserInterface\Login\LoginController;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SecurityServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this
            ->app
            ->when(LoginController::class)
            ->needs(Login::class)
            ->give(function (Application $application) {
                /** @var WebCredentialsAuthenticator $authenticator */
                $authenticator = $application->make(WebCredentialsAuthenticator::class);

                return new Login($authenticator);
            });

        $this->app->bind(PasswordHasher::class, LaravelPasswordHasher::class);
        $this->app->bind(MailGateway::class, MailService::class);
        $this->app->bind(PasswordMail::class, PasswordMailable::class);
        $this->app->bind(ResetPasswordTokenGenerator::class, RandomResetPasswordTokenGenerator::class);
        $this->app->singleton(UserRepository::class, MysqlUserRepository::class);
    }

    public function boot(): void
    {
    }
}
