<?php

namespace App\Providers;

use App\Domain\Book\BookRepository;
use App\Domain\Cart\CartRepository;
use App\Domain\Sale\SaleRepository;
use App\Domain\User\UserRespository;
use App\Infrastructure\Persistance\Eloquent\Book\BookModel;
use App\Infrastructure\Persistance\Eloquent\Book\EloqeuntBookRepository;
use App\Infrastructure\Persistance\Eloquent\Cart\CartModel;
use App\Infrastructure\Persistance\Eloquent\Cart\EloquentCartRepository;
use App\Infrastructure\Persistance\Eloquent\Sale\EloquentSalesRepository;
use App\Infrastructure\Persistance\Eloquent\Sale\SaleModel;
use App\Infrastructure\Persistance\Eloquent\User\EloquentUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
            $userOrders = 0;

            if (Auth::check()) {
                $cartCount = CartModel::where('userID', Auth::user()->userID)
                    ->where('isDeleted', false)
                    ->count();

                $userOrders = SaleModel::where('userID', Auth::user()->userID)
                    ->where('status', '!=', 'delivered')
                    ->where('status', '!=', 'cancelled')
                    ->where('isDeleted', false)
                    ->count();


            $view->with('cartCount', $cartCount);
            $view->with('userOrders', $userOrders);}
        });
        View::composer('name', function ($view) {
            $allBooks = BookModel::where('isDeleted', false)
                ->where('stocks', '>', 0)
                ->get();

            $bestSelling = $allBooks->sortByDesc('sales')->take(8);

            $byCategory = $allBooks->groupBy('bookcategory')->toArray();

            $books = [
                'allBooks' => $allBooks,
                'bestSelling' => $bestSelling,
                'byCategory' => $byCategory,
            ];

            $view->with('cartCount', $cartCount);
            $view->with('userOrders', $userOrders);
            $view->with('books', $books);
        });

        View::composer(['shared.layout.guess', 'Page.Landing.landing'], function ($view) {
            // Get top 8 bestselling books
            $bestSellingBooks = BookModel::select('tbl_books.*')
                ->leftJoin('tbl_sales', 'tbl_books.bookID', '=', 'tbl_sales.bookID')
                ->selectRaw('SUM(tbl_sales.quantity) as totalSold')
                ->where('tbl_books.isDeleted', false)
                ->where('tbl_books.stocks', '>', 0)
                ->groupBy('tbl_books.id',
                    'tbl_books.bookID',
                    'tbl_books.bookname',
                    'tbl_books.bookdetails',
                    'tbl_books.author',
                    'tbl_books.stocks',
                    'tbl_books.bookcategory',
                    'tbl_books.datepublish',
                    'tbl_books.image',
                    'tbl_books.bookprice',
                    'tbl_books.isDeleted',
                    'tbl_books.createdAt',
                    'tbl_books.updatedAt')
                ->orderByRaw('COALESCE(SUM(tbl_sales.quantity), 0) DESC')
                ->take(8)
                ->get();

            $view->with('bestSellingBooks', $bestSellingBooks);
        });
    }
}
