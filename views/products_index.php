<!DOCTYPE html>
<html lang="en">
<head>
    <title>MVC</title>
    <meta charset="utf-8">
</head>
<body>
<h1>Products:</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li><?= htmlspecialchars($product['name']); ?></li>
        <li><?= htmlspecialchars($product['description']); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
