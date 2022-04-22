<?php

declare(strict_types=1);

namespace App\Security\UserInterface\Register;

use App\Security\Domain\UseCases\Register\Register;
use App\Security\Domain\UseCases\Register\RegisterRequest;
use App\Security\UserInterface\Register\RegisterRequest as HttpRegisterRequest;
use App\Shared\UserInterface\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function __construct(private readonly Register $register)
    {
    }

    public function __invoke(HttpRegisterRequest $request)
    {
        $presenter = new HtmlRegisterPresenter();
        $request = new RegisterRequest('', $request->get('email'), $request->get('password'));
        $this->register->executes($presenter, $request);

        return $presenter->viewModel()->response();
    }
}
