<?php

namespace WCPaymentLink\Controllers\Menus;

use WCPaymentLink\Controllers\Render\AbstractRender;
use WCPaymentLink\Model\LinkModel;
use WCPaymentLink\Repository\LinkRepository;
use WCPaymentLink\Services\WooCommerce\Logs\Logger;
use WP_Query;

class Settings extends AbstractRender
{
    private array $fields = [];
    private Logger $logger;
    private LinkRepository $linkRepository;

    public function __construct()
    {
        $this->linkRepository = new LinkRepository();
        $this->logger = new Logger();

        $this->saveLink();
    }

    private function saveLink(): void
    {
        $page = filter_input( INPUT_POST, 'page', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '';

        try {
            if ($page != 'wc-payment-link-settings') {
                return;
            }

            $fields = $this->getPostFields();
            $errors = $this->validateFields($fields);

            if (!empty($errors)) {
                $this->fields['errors'] = $errors;
                return;
            }

            //TODO: add validation on model for date and hour
            //TODO: add validation on model for token. Check if he is a valid uuid
            //TODO: throw an exception for invalid data on model. Catch on this function and show on page
            $date = new \DateTime($fields['expire_at']);
            $date->setTime(
                $fields['hour'] ?? 0,
                0
            );

            $link = new LinkModel(
                $fields['name'],
                $fields['token'],
                $date,
                [],
                $fields['coupon'],
            );

            $link->setId($fields['link_id'] ?? 0);

            $data = $this->linkRepository->save($link);

            if (!$data) {
                $this->fields['errors'] = [ __('Error message', 'wc-payment-link')];
                $this->logger->add([
                    'type'   => 'SAVE',
                    'object' => $fields
                ], 'error');

                wp_redirect(admin_url("admin.php?page={$page}"));
            }

            $this->fields['saved'] = true;
            return;

        } catch (\Exception $e) {
            $this->fields['errors'] = [__('Error message', 'wc-payment-link')];

            $this->logger->add([
                'type'   => 'SAVE',
                'object' => $e->getMessage()
            ], 'error');

            wp_redirect(admin_url("admin.php?page={$page}"));
        }
    }

    private function getPostFields(): array
    {
        return [
            'link_id'   => filter_input( INPUT_POST, 'link_id', FILTER_VALIDATE_INT ),
            'name'      => filter_input( INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '',
            'token'     => filter_input( INPUT_POST, 'token', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '',
            'expire_at' => filter_input( INPUT_POST, 'expire_at', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '',
            'coupon'    => filter_input( INPUT_POST, 'coupon', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '',
            'hour'      => filter_input( INPUT_POST, 'hour', FILTER_VALIDATE_INT ),
            'products'  => []
        ];
    }

    private function validateFields(array $fields): array
    {
        $errors = [];
        $needed = [
            'name'      => __('Name', 'wc-payment-link'),
            'token'     => __('Token', 'wc-payment-link'),
            'expire_at' => __('Expire Date', 'wc-payment-link'),
        ];

        foreach ($needed as $key => $value) {
            if (empty($fields[$key])) {
                $pattern = __('The field: <b>%s</b> is required!', 'wc-payment-link');
                $message = sprintf($pattern, $value);

                $errors[] = $message;
            }
        }

        return $errors;
    }
    public function enqueue(): void
    {
        $this->enqueueScripts(['name' => 'settings', 'file' => 'scripts/admin/menus/settings/index.js']);
    }

    public function getProducts(): void
    {
        $this->fields['products'] = [];

        $query = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => -1
        ]);

        $products = $query->get_posts();

        if ($products) {
            $this->fields['products'] = $products;
        }
    }

    public function getLinks(): void
    {
        $orderBy = filter_input( INPUT_GET, 'orderby', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '';
        $order = filter_input( INPUT_GET, 'order', FILTER_SANITIZE_SPECIAL_CHARS ) ?? '';
        $page  = filter_input( INPUT_GET, 'table-page', FILTER_SANITIZE_NUMBER_INT ) ?? 1;

        $this->fields['links'] = [];

        $links = $this->linkRepository->findAll(
            $orderBy,
            10,
            $page,
            $order,
            true
        );

        if (isset($links['rows'])) {
            $this->fields['links'] = $links['rows'];
            $this->fields['pagination'] = $links['pagination'] ?? [];
        }
    }

    public function request(): void
    {
        $this->enqueue();
        $this->getProducts();
        $this->getLinks();

        echo $this->render('Admin/menus/settings/index.php', $this->fields);
    }
}
