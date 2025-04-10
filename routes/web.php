<?php

use App\Http\Controllers\Auth\Web\WebAuthController;
use App\Http\Controllers\Home\Web\HomeWebController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('Page.Landing.landing');
    });

    Route::get('/login', [WebAuthController::class, 'viewLogin'])->name('login.page');
    Route::post('/login', [WebAuthController::class, 'validateLogin'])->name('login');
    Route::get('/view-register', [WebAuthController::class, 'viewRegister'])->name('register.page');

});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeWebController::class, 'index'])->name('view.home');
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
});

Route::get('/images/login', function () {
    $path = public_path('assets/images/guess/login_image.jpg');

    // Return default image if the login image doesn't exist
    if (! file_exists($path)) {
        $path = public_path('assets/images/guess/login_image.jpg');

        // If even the default doesn't exist, return a placeholder
        if (! file_exists($path)) {
            return redirect('https://placehold.co/800x600?text=Welcome');
        }
    }

    return response()->file($path);
})->name('login.image');
