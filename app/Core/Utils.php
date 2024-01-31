<?php

namespace WCPaymentLink\Core;

class Utils
{
    public function render(string $file, array $data): string
    {
        extract($data);
        ob_start();

        $template = get_template_directory() . "/". wplConfig()->baseFolder() ."/$file";

        if (!file_exists($template)) {
            $template = wplConfig()->viewsDir($file);
        }

        if (file_exists($template)) {
            require_once $template;
        }

        return ob_get_clean();
    }
}
