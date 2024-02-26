<?php

namespace WCPaymentLink\Controllers\Pages;

use DateTime;
use Exception;
use WCPaymentLink\Controllers\Render\AbstractRender;
use WCPaymentLink\Exceptions\ExpiredTokenException;
use WCPaymentLink\Repository\LinkRepository;
use WCPaymentLink\Services\WooCommerce\Logs\Logger;

class PaymentLink extends AbstractRender
{
    private array $fields = [];
    private LinkRepository $repository;
    private Logger $logger;

    public function __construct(private string $token)
    {
        $this->repository = new LinkRepository();
        $this->logger = new Logger();
    }

    private function fillCart(): void
    {
        global $woocommerce;

        try {
            $links = $this->repository->findBy('token', $this->token);
            
            if (!empty($links)) {
                $link = array_shift($links);
                
                if ($link->getExpireAt() <= new DateTime()) {
                    throw new ExpiredTokenException($link->getToken());
                }

                $woocommerce->cart->empty_cart();
                $products = $link->getProducts();

                foreach($products as $product) {
                    $woocommerce->cart->add_to_cart($product['product'], $product['quantity']);
                }

                if ($link->getCoupon()) {
                    $woocommerce->cart->apply_coupon($link->getCoupon());
                }

            } else {
                wp_redirect(home_url('/404'));
            }

        } catch (Exception $e) {
            $this->logger->add([
                'type'   => 'ACCESS PAYMENT LINK',
                'object' => [$e->getMessage()]
            ], 'error');

            wp_redirect(home_url('/404'));
        }
    }

    public function request(): void
    {
        $GLOBALS['post'] = get_post(get_option('woocommerce_checkout_page_id'));
        $this->fillCart();

        echo $this->render('Pages/checkout/index.php', $this->fields);

        exit;
    }
}
