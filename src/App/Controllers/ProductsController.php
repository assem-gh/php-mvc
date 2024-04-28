<?php

namespace App\Controllers;

use App\Models\Product;
use Framework\Renderer;

class ProductsController
{

    public function __construct(
       private readonly Renderer $renderer,
       private readonly Product $productModel
    )
    {
    }

    public function index(): void
    {
        $products = $this->productModel->getData();

        echo $this->renderer->render('shared/header.php');
        echo $this->renderer->render('Products/index.php', [
            'Products' => $products
        ]);
    }

    public function show(string $id): void
    {
        echo $this->renderer->render('shared/header.php');
        echo $this->renderer->render('Products/show.php', [
            'id' => $id
        ]);
    }
}