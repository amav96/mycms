<?php

namespace App\Http\Providers\Files;

use Illuminate\Support\ServiceProvider;
use App\Services\Files\Delete;

class DeleteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Delete::class, function($app){
            return new Delete();
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
