<?php
class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    private function __construct()
    {
        $dsn = 'sqlite:' . DB_PATH;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO($dsn, null, null, $options);
        $this->initDatabase();
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    private function initDatabase(): void
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL,
            role TEXT NOT NULL DEFAULT 'member',
            status TEXT NOT NULL DEFAULT 'active',
            avatar TEXT,
            created_at DATETIME NOT NULL
        );

        CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            description TEXT NOT NULL,
            price REAL NOT NULL,
            image_path TEXT,
            created_at DATETIME NOT NULL
        );

        CREATE TABLE IF NOT EXISTS news (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            content TEXT NOT NULL,
            created_at DATETIME NOT NULL
        );

        CREATE TABLE IF NOT EXISTS contacts (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT NOT NULL,
            subject TEXT NOT NULL,
            message TEXT NOT NULL,
            status TEXT NOT NULL DEFAULT 'new',
            created_at DATETIME NOT NULL
        );

        INSERT OR IGNORE INTO users (id, name, email, password, role, status, created_at) VALUES
        (1, 'Administrator', 'admin@vng.com', '\$2y\$10\$CFU1MVrsCfF5yggqle0qaOcs/9WdVuUsUfH7B0rolUbDEByilAguq', 'admin', 'active', datetime('now'));

        INSERT OR IGNORE INTO products (title, description, price, created_at) VALUES
        ('Giải pháp thương mại điện tử', 'Nền tảng trang web bán hàng chuyên nghiệp cho doanh nghiệp.', 12990000.00, datetime('now')),
        ('Giải pháp quản lý nội dung', 'Quản lý tin tức, sản phẩm và liên hệ khách hàng hiệu quả.', 8990000.00, datetime('now'));

        INSERT OR IGNORE INTO news (title, content, created_at) VALUES
        ('VNG mở rộng dịch vụ mới', 'Chúng tôi vừa ra mắt giải pháp web doanh nghiệp cho đối tác mới.', datetime('now')),
        ('Tối ưu hóa chuyển đổi đơn hàng', 'Nâng cấp thiết kế và quản lý sản phẩm nhằm tăng tỷ lệ chuyển đổi.', datetime('now'));
        ";
        $this->pdo->exec($sql);
    }
}

