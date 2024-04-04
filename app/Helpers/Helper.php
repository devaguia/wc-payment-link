<?php

declare(strict_types=1);

if (!function_exists('wcplConfig')) {
    function wcplConfig()
    {
        return new \WCPaymentLink\Core\Config();
    }
}

if (!function_exists('wcplUtils')) {
    function wcplUtils()
    {
        return new \WCPaymentLink\Core\Utils();
    }
}
