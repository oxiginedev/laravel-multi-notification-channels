<?php

namespace App\NotificationChannels\SMS\Providers;

use Illuminate\Http\Client\PendingRequest;

interface SmsNotificationProviderContract
{
    /**
     * Send SMS
     *
     * @param  list<string>|string  $phone
     * @param  array<string, mixed>  $attributes
     */
    public function sendSms(array|string $phone, string $sms, array $attributes = []);

    public function getClient(): PendingRequest;
}
