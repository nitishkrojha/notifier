<?php

namespace App\Sms;

interface Provider
{
    public static function getID(): int;
    public static function getName(): string;
}
