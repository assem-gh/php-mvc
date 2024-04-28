
<h1>Products:</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li><?= htmlspecialchars($product['name']); ?></li>
        <li><?= htmlspecialchars($product['description']); ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
