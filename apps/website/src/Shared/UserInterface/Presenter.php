<?php

declare(strict_types=1);

namespace App\Shared\UserInterface;

interface Presenter
{
    public function viewModel(): ViewModel;
}
