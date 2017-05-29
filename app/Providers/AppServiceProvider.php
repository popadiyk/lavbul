<?php

namespace App\Providers;

use App\Http\Controllers\ManufactureTypeController;
use Illuminate\Support\ServiceProvider;
use TCG\Voyager\Http\Controllers\VoyagerBreadController;

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

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

       /* $this->app->bind(VoyagerBreadController::class, ManufactureTypeController::class);*/

    }
}
