<?php

namespace App\Sms;

use App\Models;

interface Provider
{
    public static function getID(): int;
    public static function getName(): string;
    public static function getDefaultSenderId(): string;
    public function send(Models\Sms $sms);
}
