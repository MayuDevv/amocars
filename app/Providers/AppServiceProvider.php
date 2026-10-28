<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (request()->getHost() === 'amocars.devmayu.it') {
            URL::forceScheme('https');
        }
    }
}
