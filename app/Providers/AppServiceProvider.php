<?php

namespace App\Providers;

use App\Repository\Album\AlbumRepository;
use App\Repository\Album\AlbumRepositoryInterface;
use App\Repository\Artist\ArtistRepository;
use App\Repository\Artist\AtistRepositoryInterface;
use App\Repository\Auth\AuthRepository;
use App\Repository\Auth\AuthRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AtistRepositoryInterface::class, ArtistRepository::class);
        $this->app->bind(AlbumRepositoryInterface::class, AlbumRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
