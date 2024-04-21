<?php

namespace App\Providers;

use App\Services\API\FoursquareAPiClient;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
