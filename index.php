<?php

require "src/controllers/ProductsController.php";

$productsController = new ProductsController();
$productsController->index();