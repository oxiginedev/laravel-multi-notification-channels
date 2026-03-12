<?php

namespace App\NotificationChannels\SMS;

use App\NotificationChannels\SMS\Contracts\SmsNotification;
use App\NotificationChannels\SMS\Providers\SmsNotificationProviderContract;
use App\NotificationChannels\SMS\Providers\SmsNotificationProviderManager;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SmsChannel
{
    public function __construct(protected SmsNotificationProviderManager $smsNotificationManager) {}

    public function send(object $notifiable, Notification&SmsNotification $notification): void
    {
        if (! $to = $notifiable->routeNotificationFor('sms', $notification)) {
            Log::critical('Missing routeNotificationForSms method for notifiable', [
                'notifiable' => $notifiable,
            ]);

            return;
        }

        /** @var SmsNotificationProviderContract */
        $smsProvider = $this->smsNotificationManager->driver();

        $message = $notification->toSms($notifiable);
        $smsProvider->sendSms($to, $message->content);
    }
}
