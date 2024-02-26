<?php

namespace WCPaymentLink\Exceptions;

class ExpiredTokenException extends \UnexpectedValueException
{
    public function __construct(string $token)
    {
        parent::__construct(
            __("The entered token({$token}) is expired! Generate a new or update token expiration date", 'wc-payment-link')
        );
    }
}