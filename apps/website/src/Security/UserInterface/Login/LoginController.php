<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Login;

use App\Security\Domain\UseCases\Login\Login;
use App\Security\Domain\UseCases\Login\LoginRequest;
use App\Security\UserInterface\Login\LoginRequest as HttpLoginRequest;
use App\Shared\UserInterface\Http\Controllers\Controller;
use App\Shared\UserInterface\Http\HttpResponseViewModel;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct(private readonly Login $login)
    {
    }

    public function __invoke(HttpLoginRequest $request): Response
    {
        $presenter = new HtmlLoginPresenter();
        $this->login->executes($presenter, new LoginRequest($request->get('email'), $request->get('password')));

        if (!$presenter->viewModel() instanceof HttpResponseViewModel) {
            throw new \RuntimeException('This code should not be executed');
        }

        return $presenter->viewModel()->response();
    }
}
