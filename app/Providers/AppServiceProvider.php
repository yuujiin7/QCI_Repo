<?php

namespace App\Providers;

use App\Models\Tsg;
use Illuminate\Contracts\View\View;


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        

    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
        view()->share('title', 'TSG Service Report System');

        view()->composer('tsg.index', function ($view) {
            $view->with('tsg', Tsg::all());
            
        });
    }
}
