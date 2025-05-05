<?php

use App\Http\Controllers\Auth\Web\WebAuthController;
use App\Http\Controllers\Cart\Web\CartWebController;
use App\Http\Controllers\Dashboard\WEB\DashboardWEBController;
use App\Http\Controllers\Home\Web\HomeWebController;
use App\Http\Controllers\ManageBooks\WEB\ManageBooksWEBController;
use App\Http\Controllers\ManageOrders\WEB\ManageOrdersWEBController;
use App\Http\Controllers\ManageReports\WEB\ManageReportsWEBController;
use App\Http\Controllers\ManageUser\WEB\ManageUserWEBController;
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
    Route::get('/images/login', function () {
        $path = public_path('assets/images/guess/login_image.jpg');

        if (! file_exists($path)) {
            $path = public_path('assets/images/guess/login_image.jpg');

            if (! file_exists($path)) {
                return redirect('https://placehold.co/800x600?text=Welcome');
            }
        }

        return response()->file($path);
    })->name('login.image');

    Route::get('/images/default', function () {
        $path = public_path('assets/images/default/default.jpg');

        if (! file_exists($path)) {
            $path = public_path('assets/images/default/default.jpg');

            if (! file_exists($path)) {
                return null;
            }
        }

        return response()->file($path);
    })->name('default.image');

    Route::get('guest/images/books/{filename}',function($filename){
        $path = public_path('assets/images/books/'.$filename);
        if (! file_exists($path)) {
            return response()->file(public_path('assets/images/default/default.jpg'));
        }
        return response()->file($path, ['Content-Type' => 'image/jpeg']);

    })->name('guest.book.image');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeWebController::class, 'index'])->name('view.home');
    Route::get('/search', [HomeWebController::class, 'search'])->name('search');
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
    Route::get('/cart/{userID}', [CartWebController::class, 'index'])->name('view.cart');
    Route::get('/profile/{userID}', [UserWebController::class, 'index'])->name('view.profile');
    Route::post('/profile', [UserWebController::class, 'updateProfile'])->name('update.profile');
    Route::get('/orders/{userID}', [OrderWEBController::class, 'index'])->name('view.orders');
    
    Route::post('/add-to-cart', [CartWebController::class, 'addToCart'])->name('add.to.cart');
    Route::post('/remove-from-cart/{cartID}', [CartWebController::class, 'softDelete'])->name('remove.from.cart');

    Route::get('/checkout/{bookID}', [OrderWEBController::class, 'viewCheckout'])->name('view.checkout');

    Route::post('/checkout-item-directly', [OrderWEBController::class, 'checkoutItemDrectly'])->name('checkout.item.directly');

    Route::post('/checkout-multiple-items', [OrderWEBController::class, 'checkoutMultipleItems'])->name('checkout.multiple.items');

    Route::post('/mark-as-delivered',[ManageOrdersWEBController::class, 'updateStatus'])->name('mark.as.delivered');

    Route::get('/images/users/{filename}', function ($filename) {
        $path = public_path('assets/images/users/'.$filename);

        if (! file_exists($path)) {
            return response()->file(public_path('assets/images/default/default.jpg'));
        }

        return response()->file($path);
    })->name('user.image');

    Route::get('/images/books/{filename}',function($filename){
        $path = public_path('assets/images/books/'.$filename);

        if (! file_exists($path)) {
            return response()->file(public_path('assets/images/default/default.jpg'));
        }
        return response()->file($path, ['Content-Type' => 'image/jpeg']);

    })->name('book.image');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardWEBController::class, 'index'])->name('view.dashboard');
    Route::get('/manage-user', [ManageUserWEBController::class, 'index'])->name('view.manage.user');
    Route::get('/manage-books', [ManageBooksWEBController::class, 'index'])->name('view.manage.books');
    Route::get('/manage-orders', [ManageOrdersWEBController::class, 'index'])->name('view.manage.orders');
    Route::get('/manage-reports', [ManageReportsWEBController::class, 'index'])->name('view.manage.reports');
    Route::get('/manage-books/new', [ManageBooksWEBController::class, 'newBookIndex'])->name('view.new.book');
    Route::post('/manage-books/create', [ManageBooksWEBController::class, 'createNewBook'])->name('create.new.book');
    Route::get('/manage-books/restock/{bookID}', [ManageBooksWEBController::class, 'restockIndex'])->name('view.restock');
    Route::post('/manage-books/restock', [ManageBooksWEBController::class, 'restockBook'])->name('restock.book');
    Route::get('/admin-create-user', [ManageUserWEBController::class, 'adminCreateUser'])->name('view.admin.create.user');
    Route::post('/admin-create-user', [ManageUserWEBController::class, 'createUser'])->name('admin.create.user');
    Route::get('/admin-edit-user/{userid}', [ManageUserWEBController::class, 'adminEditUser'])->name('admin.edit.user');
    Route::post('/admin-save-edit-user', [ManageUserWEBController::class, 'saveEditUser'])->name('save.edit.user');
    Route::post('/admin-delete-user/{userid}', [ManageUserWEBController::class, 'deleteUser'])->name('delete.user');
    Route::get('/admin-edit-book/{bookID}', [ManageBooksWEBController::class, 'editBook'])->name('admin.edit.book');
    Route::post('/admin-save-edit-book', [ManageBooksWEBController::class, 'saveEditedBook'])->name('save.edit.book');
    Route::post('/admin-deelete-book',[ManageBooksWEBController::class,'deleteBook'] )->name('delete.book');
    Route::post('/manage-orders/update-status', [ManageOrdersWEBController::class, 'updateStatus'])->name('update.order.status');
    Route::post('/manage-orders/update-status', [ManageOrdersWEBController::class, 'updateStatus'])->name('update.order.status');
});
