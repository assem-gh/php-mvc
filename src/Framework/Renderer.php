<?php

namespace Framework;

class Renderer
{
    public function render(string $view, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        ob_start();
        require "views/$view";
        return ob_get_clean();
    }
}