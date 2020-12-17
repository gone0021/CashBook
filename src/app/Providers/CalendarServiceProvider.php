<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Util\CalendarUtil;

class CalendarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CalendarUtil::class, CalendarUtil::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
