<?php

namespace Weerd\ChronosEvents;

use Illuminate\Support\ServiceProvider;

class ChronosEventsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'chronos-events');

        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/chronos-events'),
            ], 'chronos-events-views');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(Http\Controllers\Admin\CalendarEventController::class);
    }
}
