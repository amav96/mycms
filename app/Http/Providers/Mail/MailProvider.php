<?php

namespace App\Http\Providers\Mail;


use Illuminate\Support\ServiceProvider;
use App\Services\Mail\Mail;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Mail::class, function($app){
            return new Mail();
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
