<?php
include 'config.php';

echo "<h1>Simple Shop</h1>";

// Add product form
echo "<h2>Add Product</h2>";
echo "<form id='addProductForm'>";
echo "Name: <input type='text' name='name' required><br>";
echo "Description: <textarea name='description' required></textarea><br>";
echo "Price: <input type='number' name='price' step='0.01' required><br>";
echo "Image URL: <input type='url' name='image' required><br>";
echo "<button type='submit'>Add Product</button>";
echo "</form>";

// Display products
echo "<h2>Products</h2>";
echo "<div id='productsList'>";
displayProducts($pdo);
echo "</div>";

function displayProducts($pdo) {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        echo "<div style='border:1px solid #ccc; margin:10px; padding:10px;'>";
        echo "<h3>" . htmlspecialchars($product['name']) . "</h3>";
        echo "<p>" . htmlspecialchars($product['description']) . "</p>";
        echo "<p>Price: $" . $product['price'] . "</p>";
        echo "<img src='" . htmlspecialchars($product['image']) . "' width='200'><br>";
        echo "<button onclick='deleteProduct(" . $product['id'] . ")'>Delete</button>";
        echo "</div>";
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#addProductForm').submit(function(e) {
    e.preventDefault();
    $.ajax({
        url: 'add_product.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            alert(response);
            location.reload(); // Reload to show new product
        }
    });
});

function deleteProduct(id) {
    if (confirm('Are you sure?')) {
        $.ajax({
            url: 'delete_product.php',
            type: 'POST',
            data: {id: id},
            success: function(response) {
                alert(response);
                location.reload();
            }
        });
    }
}
</script>