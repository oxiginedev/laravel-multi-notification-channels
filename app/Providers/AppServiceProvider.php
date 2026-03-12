<?php

namespace App\Providers;

use App\NotificationChannels\SMS\Providers\SmsNotificationProviderManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            SmsNotificationProviderManager::class,
            SmsNotificationProviderManager::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
