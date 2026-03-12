<?php

namespace App\NotificationChannels\SMS\Contracts;

use App\NotificationChannels\SMS\Messages\SmsMessage;

interface SmsNotification
{
    public function toSms(object $notifiable): SmsMessage;
}
