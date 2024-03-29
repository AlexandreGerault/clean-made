<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Login;

use App\Security\Domain\UseCases\Login\Login;
use App\Security\Domain\UseCases\Login\LoginRequest;
use App\Security\UserInterface\Login\LoginRequest as HttpLoginRequest;
use App\Shared\UserInterface\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct(private readonly Login $login)
    {
    }

    public function __invoke(HttpLoginRequest $request): Response
    {
        /** @var string $email */
        $email = $request->get('email');
        /** @var string $password */
        $password = $request->get('password');

        $presenter = new LoginHtmlPresenter();
        $this->login->executes($presenter, new LoginRequest($email, $password));

        if (!$presenter->response() instanceof Response) {
            throw new \RuntimeException('This code should not be executed');
        }

        return $presenter->response();
    }
}
