<?php

namespace App\Providers;

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
        $this->app->bind(
            'App\Repositories\Contracts\LojaInterface',
            'App\Repositories\Eloquent\LojaRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\ProdutoInterface',
            'App\Repositories\Eloquent\ProdutoRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
