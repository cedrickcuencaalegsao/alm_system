<?php

namespace App\Providers;

use App\Domain\Book\BookRepository;
use App\Domain\User\UserRespository;
use App\Infrastructure\Persistance\Eloquent\Book\EloqeuntBookRepository;
use App\Infrastructure\Persistance\Eloquent\User\EloquentUserRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
