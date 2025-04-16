<?php

use App\Http\Controllers\Auth\Web\WebAuthController;
use App\Http\Controllers\Cart\Web\CartWebController;
use App\Http\Controllers\Home\Web\HomeWebController;
use App\Http\Controllers\Order\WEB\OrderWEBController;
use App\Http\Controllers\User\Web\UserWebController;
use Illuminate\Support\Facades\Route;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('Page.Landing.landing');
    });

    Route::get('/login', [WebAuthController::class, 'viewLogin'])->name('login.page');
    Route::post('/login', [WebAuthController::class, 'validateLogin'])->name('login');
    Route::get('/view-register', [WebAuthController::class, 'viewRegister'])->name('register.page');
    Route::post('/register', [WebAuthController::class, 'validateRegister'])->name('register');

});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeWebController::class, 'index'])->name('view.home');
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
    Route::get('/cart/{userID}', [CartWebController::class, 'index'])->name('view.cart');
    Route::get('/profile/{userID}', [UserWebController::class, 'index'])->name('view.profile');
    Route::get('/orders', [OrderWEBController::class, 'index'])->name('view.orders');
    Route::post('/add-to-cart', [CartWebController::class, 'addToCart'])->name('add.to.cart');
    Route::post('/remove-from-cart/{cartID}', [CartWebController::class, 'softDelete'])->name('remove.from.cart');
    Route::get('/checkout/{bookID}', [OrderWEBController::class, 'viewCheckout'])->name('view.checkout');
    Route::post('/checkout-item-directly', [OrderWEBController::class, 'checkoutItemDrectly'])->name('checkout.item.directly');
    Route::post('/checkout-multiple-items', [OrderWEBController::class, 'checkoutMultipleItems'])->name('checkout.multiple.items');
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
