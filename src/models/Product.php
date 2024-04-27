<?php

class Product
{
public function getData()
{
    $dns = "mysql:host=127.0.0.1;dbname=mvc;charset=utf8;port=3306";
    $pdo = new PDO($dns, "admin", "password", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    $stmt = $pdo->query("SELECT * FROM product");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}