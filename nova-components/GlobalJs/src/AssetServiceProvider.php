<?php

namespace Rurbani\GlobalJs;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class AssetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('global-js', __DIR__.'/../dist/js/asset.js');
//            Nova::script('global-js', __DIR__.'/../../../public/js/sw.js');
//            Nova::script('global-js', __DIR__.'/../../../public/js/enable-push.js');
            Nova::style('global-js', __DIR__.'/../dist/css/asset.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
