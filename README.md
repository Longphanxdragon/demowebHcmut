# BAI TAP LON LAP TRINH WEB (HK2 2025-2026) - TEAM36

README nay giu cau truc de bai va ghi ro nhom da lam gi trong tung muc nho, dong thoi cap nhat dung theo source hien tai.

## 0) CAY THU MUC CHINH

```text
demowebHcmut/
├── Assignment1 - Team36/
│   ├── index.php
│   ├── config.php
│   ├── ajax_product.php
│   ├── database.sql
│   ├── database.sqlite
│   ├── models/
│   │   ├── Database.php
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── News.php
│   │   ├── Contact.php
│   │   └── Comment.php
│   ├── views/
│   │   ├── header.php, footer.php
│   │   ├── home.php, about.php, pricing.php, contact.php, faq.php
│   │   ├── products.php, product_detail.php
│   │   ├── news.php, news_detail.php
│   │   ├── login.php, register.php, profile.php
│   │   └── admin.php
│   ├── css/
│   ├── images/
│   └── uploads/
├── Report_Web_2026.tex
├── HUONG_DAN_SUA_2026.md
└── README.md
```

## 1) DE BAI

### 1.1 De bai
Thiet ke giao dien va xay dung cac tinh nang co ban cho website cong ty - doanh nghiep.

### 1.2 Muc tieu
Su dung cac kien thuc da hoc:
- HTML5
- CSS3
- Javascript
- PHP
- PHP & MySQL
- Thu vien/framework CSS/JS
- Bao mat va SEO co ban

## 2) YEU CAU CHUNG VA TINH TRANG THUC HIEN

### 2.1 Rang buoc cong nghe
- Yeu cau: PHP 7.0+, chi dung PHP cho server, khong dung PHP Framework/CMF/CMS.
- Da lam:
	- Du an dung PHP thuan, khong Laravel/CodeIgniter/WordPress.
	- Router tap trung tai index.php + model/view thu cong.

### 2.2 Giao dien bat buoc
- Yeu cau: Trang chu, Gioi thieu, San pham/Dich vu, Bang gia, Lien he, Hoi dap, Tin tuc, Dang ky/Dang nhap, trang quan ly.
- Da lam:
	- Da co day du cac trang trong views/: home, about, products, pricing, contact, faq, news, login, register.
	- Da co profile va admin dashboard.

### 2.3 Vai tro nguoi dung

#### Khach
- Yeu cau:
	- Xem thong tin public.
	- Tim kiem tai nguyen.
	- Dang ky, dang nhap.
- Da lam:
	- Xem day du trang public.
	- Tim kiem san pham va tin tuc co phan trang.
	- Dang ky, dang nhap co kiem tra server-side.

#### Thanh vien
- Yeu cau:
	- Thay doi thong tin ca nhan, mat khau, avatar.
	- Viet binh luan/danh gia.
- Da lam:
	- Cap nhat ho so + avatar.
	- Doi mat khau co xac thuc mat khau cu.
	- Them binh luan/danh gia cho chi tiet san pham va chi tiet tin tuc (diem 1-5 + noi dung).

#### Quan tri vien
- Yeu cau:
	- Quan ly thanh vien.
	- Quan ly binh luan/danh gia.
	- Quan ly lien he.
	- Quan ly san pham/dich vu.
	- Quan ly tin tuc (them/sua/xoa + keyword + mo ta + tieu de).
- Da lam:
	- Quan ly user: xem, khoa/mo khoa, reset mat khau, xoa (bao ve tai khoan admin dang dang nhap).
	- Quan ly binh luan: duyet/an, xoa.
	- Quan ly lien he: cap nhat trang thai new/read/replied + phan trang.
	- Quan ly san pham: them/sua/xoa.
	- Quan ly tin tuc: them/sua/xoa + keyword + meta_description + phan trang.

### 2.4 CSDL va luu tru
- Yeu cau: thiet ke CSDL MySQL.
- Da lam:
	- Co file database.sql cho MySQL.
	- Co database.sqlite de demo nhanh.
	- Bang da su dung: users, products, news, contacts, comments.

### 2.5 Validate dau vao (client + server)
- Yeu cau: cac form phai co validate o JS va PHP.
- Da lam:
	- Client-side: required, type, minlength tren form dang ky, dang nhap, profile, admin.
	- Server-side: validate du lieu o register/login/contact/profile/admin CRUD/comment.

### 2.6 Pagination
- Yeu cau: cac danh sach dai phai phan trang.
- Da lam:
	- Public: products, news.
	- Admin: contacts, users, news, comments.

### 2.7 Upload hinh anh len server
- Yeu cau: khong dung URL anh ben ngoai thay cho upload noi bo.
- Da lam:
	- Upload avatar thanh vien vao uploads/.
	- Upload anh san pham vao uploads/ (co sanitize ten file).

### 2.8 Bao mat co ban
- Yeu cau: tim hieu lo hong va phong chong.
- Da lam:
	- password_hash/password_verify.
	- Prepared statement voi PDO.
	- htmlspecialchars khi render.
	- Kiem tra role admin cho hanh dong quan tri.

### 2.9 SEO co ban
- Yeu cau: ap dung SEO co ban vao san pham.
- Da lam:
	- title theo tung trang.
	- Them meta description + meta keywords o header.
	- News co keyword va meta_description de quan tri vien quan ly.

## 3) CAC MUC CHUA XONG HOAN TOAN

- Gio hang/don hang va thanh toan (neu nhom chon huong e-commerce) chua trien khai.
- Admin dashboard chua dung template Srtdash 100%, hien la dashboard Bootstrap tu viet.
- Chua co bo test tu dong.

## 4) TIEN DO HIEN TAI

- Uoc luong: khoang 80-85% so voi khung de bai tong.
- Da xong phan cot loi: auth, profile, user admin, product CRUD, news CRUD, comment/rating, contact management, pagination, upload, bao mat co ban, SEO co ban.

## 5) CACH CHAY DU AN

### 5.1 Chay local nhanh
1. Vao thu muc Assignment1 - Team36.
2. Chay lenh:

```bash
php -S localhost:8000
```

3. Mo trinh duyet:

```text
http://localhost:8000/index.php
```

### 5.2 Tai khoan admin demo
- Email: admin@vng.com
- Password: admin123

Neu khong dang nhap duoc, reset nhanh:

```bash
php -r 'require "config.php"; $db=Database::getInstance()->getConnection(); $h=password_hash("admin123", PASSWORD_DEFAULT); $db->prepare("UPDATE users SET password=:p WHERE email=:e")->execute([":p"=>$h,":e"=>"admin@vng.com"]); echo "Reset xong\n";'
```

## 6) GHI CHU 

- Da loai bo nhom file HTML legacy, source chi con luong MVC PHP de demo/cham bai.
- Neu can doc nhanh code, bat dau tu:
	- index.php
	- models/
	- views/admin.php
	- views/product_detail.php
	- views/news_detail.php

