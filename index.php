<?php

$dns = "mysql:host=127.0.0.1;dbname=mvc;charset=utf8;port=3306";
$pdo = new PDO($dns, "admin", "password", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$stmt = $pdo->query("SELECT * FROM product");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>MVC</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Products</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li><?= htmlspecialchars($product['name']); ?></li>
        <li><?= htmlspecialchars($product['description']); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>