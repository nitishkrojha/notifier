<?php

namespace App\Exceptions;

use Exception;

class ProviderNotFoundException extends Exception
{
    protected $message = 'Provider not found';
}
