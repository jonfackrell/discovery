<?php

namespace App\Modules\Search\Providers;

use App\Modules\Search\Console\Commands\Retrieve;
use App\Modules\Search\Console\Commands\Search;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::addNamespace('Search', app_path() . '/Modules/Search/resources/views');
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
                Retrieve::class,
                Search::class,
            ]);
        }

    }
}
