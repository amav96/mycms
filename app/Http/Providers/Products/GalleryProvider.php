<?php

namespace App\Http\Providers\Products;


use Illuminate\Support\ServiceProvider;
use App\Services\Products\Gallery;

class GalleryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Gallery::class, function($app){
            return new Gallery();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
