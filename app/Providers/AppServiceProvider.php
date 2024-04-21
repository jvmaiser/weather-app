<?php

namespace App\Providers;

use App\Services\API\FoursquareAPiClient;
use App\Services\API\OpenWeatherMapAPIClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(FoursquareAPiClient::class, function () {
            return new FoursquareAPIClient(
                env('FOURSQUARE_API_KEY'),
            );
        });

        $this->app->singleton(OpenWeatherMapAPIClient::class, function ($app) {
            return new OpenWeatherMapAPIClient(
                env('OPEN_WEATHER_API_KEY')
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
