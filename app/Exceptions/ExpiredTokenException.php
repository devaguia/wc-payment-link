<?php

namespace WCPaymentLink\Exceptions;

class ExpiredTokenException extends \UnexpectedValueException
{
    public function __construct(string $token)
    {
        parent::__construct(
            sprintf(
                "%s({$token}) %s",
                __('The entered token', 'wc-payment-link'),
                __('is expired! Generate a new or update token expiration date', 'wc-payment-link'),
            )
        );
    }
}