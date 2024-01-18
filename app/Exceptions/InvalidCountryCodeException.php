<?php

namespace App\Exceptions;

use Throwable;

class InvalidCountryCodeException extends \RuntimeException
{
    /**
     * @param string $countryCode
     */
    public function __construct(string $countryCode)
    {
        $message = 'Country with give code ' . $countryCode . ' does not exists';

        parent::__construct($message);
    }
}
