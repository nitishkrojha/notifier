<?php

namespace App\Sms;

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
}
