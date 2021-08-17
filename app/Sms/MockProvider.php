<?php

namespace App\Sms;

class MockProvider implements Provider
{
    static public function getId(): int
    {
        return 1;
    }

    static public function getName(): string
    {
        return 'mock';
    }
}
