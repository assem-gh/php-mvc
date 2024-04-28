<?php

namespace App\Models;


use App\Database;
use PDO;

class Product
{
    public function __construct(
        private readonly Database $database
    )
    {
    }

    public function getData(): false|array
    {
        $pdo = $this->database->getConnection();
        $stmt = $pdo->query("SELECT * FROM product");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}