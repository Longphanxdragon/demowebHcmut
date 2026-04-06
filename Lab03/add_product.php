<?php
include 'config.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$image = $_POST['image'];

$stmt = $pdo->prepare("INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$name, $description, $price, $image])) {
    echo "Product added successfully!";
} else {
    echo "Error adding product.";
}
?>