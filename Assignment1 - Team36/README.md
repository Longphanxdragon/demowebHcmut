# Assignment 1 - Team36

## Tài liệu tham khảo Lab03

Assignment này đã dùng Lab03 làm tham khảo chính cho các kỹ thuật sau:

- Xử lý form GET/POST và upload file
- Kết nối database bằng PDO
- Thiết lập CRUD sản phẩm
- Tạo endpoint AJAX để thêm/xóa sản phẩm mà không cần tải lại trang

## Những gì đã cập nhật

- Sửa model để tương thích SQLite (`NOW()` được thay bằng `date('Y-m-d H:i:s')`)
- Bổ sung `ajax_product.php` để xử lý thêm/xóa sản phẩm dưới dạng AJAX
- Cập nhật `views/admin.php` để dùng `fetch()` và gửi dữ liệu form đến endpoint AJAX
- Xây dựng cấu trúc quản lý sản phẩm theo kiểu MVC nhẹ với model/controller/view

## Cách chạy

1. Truy cập `Assignment1 - Team36/index.php`
2. Đăng nhập bằng tài khoản admin
3. Vào `Quản trị` để quản lý sản phẩm và liên hệ
