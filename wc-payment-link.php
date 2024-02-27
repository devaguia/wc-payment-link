<?php
/**
 * Plugin Name: WC Payment Links
 * Plugin URI:  https://github.com/devaguia/wc-payment-link
 * Description: Payment links for WooCommerce
 * Author:      Matheus Aguiar
 * Author URI:  https://github.com/devaguia/
 * Version: 1.0.0
 *
 * @link    https://github.com/devaguia/
 * @since   1.0.0
 * @package WCPaymentLink
 */

require_once __DIR__ . '/vendor/autoload.php';


if (version_compare(phpversion(), '7.4') < 0) {
	wp_die(
		sprintf(
			"%s <p>%s</p>",
			__("The WC Payment Links isn't compatible to your PHP version. ", 'wc-payment-link'),
			__('The PHP version has to be a less 7.4!', 'wc-payment-link')
		),
		'The WC Payment Links -- Error',
		['back_link' => true]
	);
}

new WCPaymentLink\Core\Boot;