<?php

namespace Kingsley\References;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ReferencesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'../database/migrations');

        Route::bind(config('references.binding_name'), function ($hash) {
            return reference($hash);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        require_once __DIR__.'/Helpers.php');
    }
}
