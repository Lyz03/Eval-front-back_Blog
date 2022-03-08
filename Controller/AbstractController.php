<?php

namespace App\Controller;

abstract class AbstractController
{
    abstract public function default();

    /**
     * @param string $template
     * @param array $data
     * @return void
     */
    public function render(string $template, array $data = [])
    {
        ob_start();
        require __DIR__ . '/../View/' . $template . '.php';
        $html = ob_get_clean();
        require __DIR__ . '/../View/base.php';
    }

}