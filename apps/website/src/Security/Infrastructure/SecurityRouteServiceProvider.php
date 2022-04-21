<?php

declare(strict_types=1);

namespace App\Security\Infrastructure;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class SecurityRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->name('security.')
                ->group(base_path('routes/web/security.php'));
        });
    }
}
