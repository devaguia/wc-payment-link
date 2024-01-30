<?php

namespace WCPaymentLink\Controllers\Menus;

use WCPaymentLink\Controllers\Render\AbstractRender;

class Settings extends AbstractRender
{
    private array $fields;

    public function enqueue(): void
    {
        $this->enqueueScripts(['name' => 'settings', 'file' => 'scripts/admin/menus/settings/index.js']);
        $this->enqueueStyles(['name' => 'settings', 'file' => 'styles/admin/menus/settings/index.css']);
    }

    public function request(): void
    {
        $this->enqueue();

        $this->fields = [];
        echo $this->render('Admin/menus/settings/index.php', $this->fields);
    }
}
