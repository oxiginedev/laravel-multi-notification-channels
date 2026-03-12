<?php

namespace App\NotificationChannels\SMS\Providers;

use Illuminate\Support\Manager;

class SmsNotificationProviderManager extends Manager
{
    protected function createTermiiDriver(): SmsNotificationProviderContract
    {
        return new TermiiSmsNotificationProvider;
    }

    public function getDefaultDriver(): string
    {
        return config('providers.sms');
    }
}
