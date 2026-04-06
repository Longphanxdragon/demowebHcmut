<?php
include 'config.php';

$id = $_POST['id'];

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
if ($stmt->execute([$id])) {
    echo "Product deleted successfully!";
} else {
    echo "Error deleting product.";
}
?>