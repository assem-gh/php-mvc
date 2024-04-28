<?php

namespace App\Controllers;
use Framework\Renderer;

class HomeController
{
    public function __construct(
        private readonly Renderer $renderer
    )
    {
    }

    public function index()
    {
       echo $this->renderer->render('Home/index.php');
    }
}