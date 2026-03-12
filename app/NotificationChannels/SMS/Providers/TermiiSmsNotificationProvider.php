<?php

namespace App\NotificationChannels\SMS\Providers;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class TermiiSmsNotificationProvider implements SmsNotificationProviderContract
{
    public function sendSms(array|string $phone, string $sms, array $attributes = [])
    {
        try {
            $response = $this->getClient()->post('/api/sms/send', [
                'api_key' => config('services.termii.key'),
                'to' => $phone,
                'sms' => $sms,
                'from' => config('services.termii.sender'),
                'type' => 'plain',
                'channel' => $attributes['channel'] ?? 'generic',
            ]);

            if (! $response->successful()) {
                Log::error('Termii sendSms api failed with response', [
                    'response' => $response->json(),
                ]);

                return false;
            }

            return true;
        } catch (Throwable $exception) {
            Log::error('Termii sendSms failed with exception', [
                'exception' => $exception->getTraceAsString(),
            ]);

            return false;
        }
    }

    public function getClient(): PendingRequest
    {
        return Http::baseUrl(config('services.termii.url'))
            ->acceptJson()
            ->asJson()
            ->timeout(15);
    }
}
