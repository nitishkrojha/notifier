<?php

namespace App\Sms;

class Sms
{
    public static $availableProviders = [
        MockProvider::class,
        Fast2SmsProvider::class,
    ];

    public static function isValidProvider(int $value): bool
    {
        foreach (static::$availableProviders as $provider) {
            if ($value == $provider::getId()) {
                return true;
            }
        }

        return false;
    }
}
