<?php

namespace App\Sms;

class Sms
{
    static protected $availableProviders = [
        Fast2SmsProvider::class,
        MockProvider::class,
    ];

    static public function isValidProvider(int $value): bool {
        foreach (static::$availableProviders as $provider) {
            if ($value == $provider::getId()) {
                return true;
            }
        }

        return false;
    }
}
