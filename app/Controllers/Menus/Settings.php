<?php

namespace WCPaymentLink\Controllers\Menus;

use WCPaymentLink\Controllers\Render\AbstractRender;
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

    public function request(): void
    {
        $this->enqueue();
        $this->getProducts();

        echo $this->render('Admin/menus/settings/index.php', $this->fields);
    }
}
