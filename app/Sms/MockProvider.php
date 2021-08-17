<?php

namespace App\Sms;

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
}
