<?php

use App\Http\Controllers\Auth\Web\WebAuthController;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    return view('Page.home.home');
});

Route::get('/', [WebAuthController::class, 'viewLogin'])->name('login.page');

Route::get('/register', [WebAuthController::class, 'viewRegister'])->name('register.page');
