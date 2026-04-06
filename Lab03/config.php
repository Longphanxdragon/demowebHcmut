<?php
// Database configuration for Lab03 - Using SQLite
$dbPath = __DIR__ . '/shop.db';

try {
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        description TEXT NOT NULL,
        price REAL NOT NULL,
        image TEXT NOT NULL
    )");

    // Insert sample data if empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("INSERT INTO products (name, description, price, image) VALUES
            ('Usb Kingston 3.0', 'USB Kingston siêu mỏng có hình thức nhỏ gọn và không nắp phù hợp với mọi phong cách năng động.', 42000, 'https://m.media-amazon.com/images/I/31UpGSJdmqL._AC_.jpg'),
            ('Ổ cứng di động External SSD', 'Dung lượng: 500GB, 1TB, 2TB Chống sốc, chống nước IP55 Thiết kế nhỏ gọn', 3000000, 'https://m.media-amazon.com/images/I/911ujeCkGfL._AC_UY436_FMwebp_QL65_.jpg'),
            ('RAM Laptop Samsung 8GB', 'Samsung là một thương hiệu hàng đầu trong việc sản xuất chip nhớ, RAM máy tính.', 750000, 'https://m.media-amazon.com/images/I/71cWL5j3FqL._AC_UY436_FMwebp_QL65_.jpg')");
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>