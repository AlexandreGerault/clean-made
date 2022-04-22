<?php

declare(strict_types=1);

namespace App\Shared\UserInterface\Http;

use App\Shared\UserInterface\ViewModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response as LaravelResponse;
use Symfony\Component\HttpFoundation\Response;

class HttpResponseViewModel implements ViewModel
{
    private Response $response;

    public function __construct(Response|View $response)
    {
        if ($response instanceof View) {
            $response = new LaravelResponse($response);
        }

        $this->response = $response;
    }

    public function response(): Response
    {
        return $this->response;
    }
}
