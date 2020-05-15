<?php

namespace App\Modules\Communication\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CommunicationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        View::addNamespace('Communication', app_path() . '/Modules/Communication/resources/views');
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
