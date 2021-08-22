<?php

namespace App\Sms;

use Throwable;

use App\Models;
use App\Exceptions\ProviderNotFoundException;

class Service
{
    public static $availableProviders = [
        MockProvider::class,
        Fast2SmsProvider::class,
    ];

    public static function isValidProvider(int $id): bool
    {
        try {
            static::getProviderById($id);
            return true;
        } catch (ProviderNotFoundException $e) {
            return false;
        }
    }

    public static function getProviderById(int $id): Provider
    {
        foreach (static::$availableProviders as $provider) {
            if ($id == $provider::getId()) {
                return new $provider;
            }
        }

        throw new ProviderNotFoundException;
    }

    public function send(Models\Sms $sms)
    {
        $provider = static::getProviderById($sms->getProviderId());

        try {
            $provider->send($sms);
            $sms->status = Status::SUCCESS;
        } catch (Throwable $e) {
            $sms->status = Status::FAILED;
            throw $e;
        } finally {
            $sms->num_attempts++;
            $sms->save();
        }
    }
}
