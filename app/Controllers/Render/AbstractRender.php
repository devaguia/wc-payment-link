<?php


namespace WCPaymentLink\Controllers\Render;

abstract class AbstractRender implements InterfaceRender
{
    protected bool $hasEnqueue = true;

    protected function enqueueScripts(array $script): void
    {
        $link = isset($script['external']) ? $script['external'] : wplConfig()->distUrl($script['file']);
        wp_enqueue_script($script['name'], $link);
    }

    protected function enqueueStyles(array $style): void
    {
        $link = isset($style['external']) ? $style['external'] : wplConfig()->distUrl($style['file']);
        wp_enqueue_style($style['name'], $link);
    }

    private function enqueueDefault(): void
    {
        if ($this->hasEnqueue) {
            $this->enqueueScripts(
                [
                    'name' => 'fontawesome',
                    'external' => 'https://kit.fontawesome.com/b1ffd29fea.js'
                ]
            );

            $this->enqueueStyles(['name' => 'tailwind', 'file' => 'styles/app.css']);
        }
    }

    public function render(string $file, array $data): string
    {
        $this->enqueueDefault();
        return wplUtils()->render($file, $data);
    }
}
