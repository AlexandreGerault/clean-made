<?php

use App\Security\UserInterface\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('connexion', 'security.login')->name('login.show');
Route::post('connexion', LoginController::class)->name('login.post');
