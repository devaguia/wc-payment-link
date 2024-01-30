<?php

declare(strict_types=1);

if (!function_exists('wplConfig')) {
    function wplConfig()
    {
        return new \WCPaymentLink\Core\Config();
    }
}

if (!function_exists('wplUtils')) {
    function wplUtils()
    {
        return new \WCPaymentLink\Core\Utils();
    }
}
