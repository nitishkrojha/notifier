<?php

namespace App\Sms;

interface Provider
{
    static public function getID(): int;
    static public function getName(): string;
}
