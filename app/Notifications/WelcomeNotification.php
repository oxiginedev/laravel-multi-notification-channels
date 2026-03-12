<?php

namespace App\Notifications;

use App\NotificationChannels\SMS\Contracts\SmsNotification;
use App\NotificationChannels\SMS\Messages\SmsMessage;
use App\NotificationChannels\SMS\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification implements SmsNotification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', SmsChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the sms representation of the notification.
     */
    public function toSms(object $notifiable): SmsMessage
    {
        return (new SmsMessage)
            ->content('Welcome to Laravel!');
    }
}
