<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class JAPIServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        App::bind('japi', function() {
            return new \App\Helpers\API;
        });
    }
}
