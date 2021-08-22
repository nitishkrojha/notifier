<?php

namespace App\Sms;

use Illuminate\Support\Facades\Http;

use App\Models;

class Fast2SmsProvider implements Provider
{
    public static function getId(): int
    {
        return 2;
    }

    public static function getName(): string
    {
        return 'fast2sms';
    }

    public static function getDefaultSenderId(): string
    {
        return 'TXTIND';
    }

    public function send(Models\Sms $sms)
    {
        $response = Http::timeout(3)->withHeaders([
             'Authorization' => env('SMS_FAST2SMS_AUTHORIZATION'),
             ])->post(env('SMS_FAST2SMS_URL'), [
                'route' =>'v3',
                'sender_id' =>$sms->getProviderSenderId(),
                'message' =>$sms->text,
                'language' =>'unicode',
                'flash' =>0,
                'numbers' =>$sms->phone,
            ]);

        $response->throw();
    }
}
