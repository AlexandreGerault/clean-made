<?php

use App\Security\UserInterface\Login\LoginController;
use App\Security\UserInterface\Register\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::view('connexion', 'security.login')->name('login.show');
    Route::post('connexion', LoginController::class)->name('login.post');

    Route::view('inscription', 'security.register')->name('register.show');
    Route::post('inscription', RegisterController::class)->name('register.post');
});
