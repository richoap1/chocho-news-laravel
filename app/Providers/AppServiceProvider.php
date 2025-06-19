<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;    

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{

    View::composer('layouts.frontend', function ($view) {
        

        if (Schema::hasTable('categories')) {
            $view->with('categories', Category::all());
        } else {
            $view->with('categories', collect());
        }
    });
}
}