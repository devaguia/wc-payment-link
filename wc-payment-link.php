<?php
/**
 * Plugin Name: WooCommerce Payment Link
 * Plugin URI:  https://github.com/devaguia/
 * Description: Initial setup for wordpress plugin
 * Author:      Matheus Aguiar
 * Author URI:  https://github.com/devaguia/
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
			__("The WooCommerce Payment Link isn't compatible to your PHP version. ", 'wc-payment-link'),
			__('The PHP version has to be a less 7.4!', 'wc-payment-link')
		),
		'The WooCommerce Payment Link -- Error',
		['back_link' => true]
	);
}

new WCPaymentLink\Core\Boot;