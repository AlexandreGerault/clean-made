<?php

declare(strict_types=1);

use App\Security\UserInterface\AskNewPassword\AskNewPasswordController;
use App\Security\UserInterface\Login\LoginController;
use App\Security\UserInterface\Register\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('connexion', 'security.login')->name('login.show');
    Route::post('connexion', LoginController::class)->name('login.post');

    Route::view('inscription', 'security.register')->name('register.show');
    Route::post('inscription', RegisterController::class)->name('register.post');

    Route::view('demande-nouveau-mot-de-passe', 'security.ask-new-password')->name('ask-new-password.show');
    Route::post('demande-nouveau-mot-de-passe', AskNewPasswordController::class)->name('ask-new-password.post');
});
