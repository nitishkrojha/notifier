<?php

namespace App\Sms;

class Sms
{
    protected static $availableProviders = [
        Fast2SmsProvider::class,
        MockProvider::class,
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
