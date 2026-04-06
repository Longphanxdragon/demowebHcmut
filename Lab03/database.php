<?php
include 'config.php';

echo "<h1>Database Connection and Queries</h1>";

// Select all products
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h2>Products</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Image</th></tr>";
foreach ($products as $product) {
    echo "<tr>";
    echo "<td>" . $product['id'] . "</td>";
    echo "<td>" . $product['name'] . "</td>";
    echo "<td>" . $product['description'] . "</td>";
    echo "<td>" . $product['price'] . "</td>";
    echo "<td><img src='" . $product['image'] . "' width='100'></td>";
    echo "</tr>";
}
echo "</table>";
?>