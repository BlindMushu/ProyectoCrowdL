<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['front.index', 'front.article'], 'App\Http\Composers\AsideComposer');
    }
    public function register()
    {
        //
    }
}
