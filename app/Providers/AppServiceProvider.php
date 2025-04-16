<?php

namespace App\Providers;

use App\Domain\Book\BookRepository;
use App\Domain\Cart\CartRepository;
use App\Domain\User\UserRespository;
use App\Domain\Sale\SaleRepository;

use App\Infrastructure\Persistance\Eloquent\Book\EloqeuntBookRepository;
use App\Infrastructure\Persistance\Eloquent\Cart\EloquentCartRepository;
use App\Infrastructure\Persistance\Eloquent\User\EloquentUserRepository;
use App\Infrastructure\Persistance\Eloquent\Sale\EloquentSalesRepository;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Infrastructure\Persistance\Eloquent\Cart\CartModel;
use App\Infrastructure\Persistance\Eloquent\Sale\SaleModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(bookRepository::class, EloqeuntBookRepository::class);
        $this->app->bind(UserRespository::class, EloquentUserRepository::class);
        $this->app->bind(CartRepository::class, EloquentCartRepository::class);
        $this->app->bind(SaleRepository::class, EloquentSalesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('shared.layout.authenticated', function ($view) {
            $cartCount = 0;
            if (Auth::check()) {
                $cartCount = CartModel::where('userID', Auth::user()->userID)
                    ->where('isDeleted', false)
                    ->count();
                $userOrders = SaleModel::where('userID', Auth::user()->userID)
                    ->where('status', 'pending')
                    ->where('isDeleted', false)
                    ->count();
            }
            $view->with('cartCount', $cartCount);
            $view->with('userOrders', $userOrders);
        });
    }
}
