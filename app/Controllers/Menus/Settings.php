<?php

namespace WCPaymentLink\Controllers\Menus;

use WCPaymentLink\Controllers\Render\AbstractRender;
use WCPaymentLink\Repository\LinkRepository;
use WP_Query;

class Settings extends AbstractRender
{
    private array $fields = [];

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

        $linkRepository = new LinkRepository();
        $links = $linkRepository->findAll(
            $orderBy,
            10,
            $page,
            $order,
            true
        );

        if (isset($links['rows'])) {
            $this->fields['links'] = $links['rows'];
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
