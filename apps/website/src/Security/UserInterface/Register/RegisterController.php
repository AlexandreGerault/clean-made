<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Register;

use App\Security\Domain\UseCases\Register\Register;
use App\Security\Domain\UseCases\Register\RegisterRequest;
use App\Security\UserInterface\Register\RegisterRequest as HttpRegisterRequest;
use App\Shared\UserInterface\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function __construct(private readonly Register $register)
    {
    }

    public function __invoke(HttpRegisterRequest $request): Response
    {
        /** @var string $email */
        $email = $request->get('email');
        /** @var string $password */
        $password = $request->get('password');

        $presenter = new RegisterHtmlPresenter();
        $request = new RegisterRequest('', $email, $password);

        $this->register->executes($presenter, $request);

        return $presenter->response();
    }
}
