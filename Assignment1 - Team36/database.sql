-- Tạo database cho ứng dụng web công ty doanh nghiệp
CREATE DATABASE IF NOT EXISTS company_site CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE company_site;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('member', 'admin') NOT NULL DEFAULT 'member',
  status ENUM('active', 'blocked') NOT NULL DEFAULT 'active',
  avatar VARCHAR(255) NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_path VARCHAR(255) NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contacts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(150) NOT NULL,
  email VARCHAR(150) NOT NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  status ENUM('new', 'read') NOT NULL DEFAULT 'new',
  created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO users (id, name, email, password, role, status, created_at) VALUES
(1, 'Administrator', 'admin@vng.com', '$2y$10$CFU1MVrsCfF5yggqle0qaOcs/9WdVuUsUfH7B0rolUbDEByilAguq', 'admin', 'active', NOW());

INSERT INTO products (title, description, price, image_path, created_at) VALUES
('Giải pháp thương mại điện tử', 'Nền tảng trang web bán hàng chuyên nghiệp cho doanh nghiệp.', 12990000.00, NULL, NOW()),
('Giải pháp quản lý nội dung', 'Quản lý tin tức, sản phẩm và liên hệ khách hàng hiệu quả.', 8990000.00, NULL, NOW());

INSERT INTO news (title, content, created_at) VALUES
('VNG mở rộng dịch vụ mới', 'Chúng tôi vừa ra mắt giải pháp web doanh nghiệp cho đối tác mới.', NOW()),
('Tối ưu hóa chuyển đổi đơn hàng', 'Nâng cấp thiết kế và quản lý sản phẩm nhằm tăng tỷ lệ chuyển đổi.', NOW());
