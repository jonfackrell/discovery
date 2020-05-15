<?php

namespace App\Modules\Stackmaps\Providers;

use App\Modules\Search\Console\Commands\Retrieve;
use App\Modules\Search\Console\Commands\Search;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StackmapServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::addNamespace('Stackmaps', app_path() . '/Modules/Stackmaps/resources/views');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([

            ]);
        }
    }
}
