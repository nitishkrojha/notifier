<?php

namespace App\Sms;

class Fast2SmsProvider implements Provider
{
    static public function getId(): int
    {
        return 2;
    }

    static public function getName(): string
    {
        return 'fast2sms';
    }
}
