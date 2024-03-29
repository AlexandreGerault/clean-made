<?php

declare(strict_types=1);

namespace App\Security\UserInterface\AskNewPassword;

use App\Security\Domain\UseCases\AskNewPassword\AskNewPassword;
use App\Security\Domain\UseCases\AskNewPassword\AskNewPasswordRequest;
use App\Shared\UserInterface\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AskNewPasswordController extends Controller
{
    public function __construct(private readonly AskNewPassword $askNewPassword)
    {
    }

    public function __invoke(Request $request): Response
    {
        /** @var string $email */
        $email = $request->get('email');

        $input = new AskNewPasswordRequest(to: $email);
        $presenter = new AskNewPasswordHtmlPresenter();

        $this->askNewPassword->executes($input, $presenter);

        return $presenter->response();
    }
}
