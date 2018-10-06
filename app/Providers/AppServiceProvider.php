<?php

namespace Triskelion\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Triskelion\Contracts\AuthContract', 'Triskelion\Services\AuthService');
        $this->app->bind('Triskelion\Contracts\UserContract', 'Triskelion\Services\UserService');
    }
}
