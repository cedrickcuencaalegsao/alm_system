<?php

namespace App\Providers;

use App\Domain\Book\BookRepository;
use App\Infrastructure\Persistance\Eloquent\Book\EloqeuntBookRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(bookRepository::class, EloqeuntBookRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
