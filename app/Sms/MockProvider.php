<?php

namespace App\Sms;

use Illuminate\Support\Facades\Http;

use App\Models;

class MockProvider implements Provider
{
    public static function getId(): int
    {
        return 1;
    }

    public static function getName(): string
    {
        return 'mock';
    }

    public static function getDefaultSenderId(): string
    {
        return 'TXTIND';
    }

    public function send(Models\Sms $sms)
    {
        $response = Http::timeout(3)
        ->post(env('SMS_MOCKPROVIDER_URL'), [
            'provider_sender_id' => $sms->getProviderSenderId(),
            'text' => $sms->text,
            'phone' => $sms->phone,
        ]);

        $response->throw();
    }
}
