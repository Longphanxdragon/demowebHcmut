# HUONG DAN SUA SOURCE 2026 (BAM SAT DE, BO PHAN THUA)

## 1) Muc tieu
- Bam dung de HK2 2025-2026.
- Uu tien tinh nang co diem truc tiep theo rubric.
- Bo toan bo phan "dep ma khong duoc cham".

## 2) Danh sach BAT BUOC theo de

### 2.1 Cong nghe va rang buoc
- PHP 7.0+.
- Chi dung PHP cho xu ly server.
- KHONG dung PHP Framework/CMF/CMS.
- Duoc dung thu vien CSS/JS.

### 2.2 Giao dien bat buoc
- Trang chu.
- Gioi thieu.
- San pham/Dich vu.
- Bang gia.
- Lien he.
- Hoi dap.
- Tin tuc.
- Dang ky/Dang nhap.
- Cac trang quan ly (admin).

### 2.3 Tinh nang nguoi dung
- Khach:
  - Xem trang public.
  - Tim kiem (san pham/tin tuc/dich vu).
  - Dang ky, dang nhap.
- Thanh vien:
  - Sua thong tin ca nhan.
  - Doi mat khau.
  - Doi avatar.
  - Binh luan/danh gia.
- Quan tri vien:
  - Quan ly nguoi dung.
  - Quan ly binh luan/danh gia.
  - Quan ly lien he.
  - Quan ly noi dung trang public.
  - CRUD san pham/dich vu.
  - CRUD tin tuc + keyword + mo ta + tieu de.

### 2.4 Yeu cau ky thuat bat buoc
- Co CSDL MySQL ro rang.
- Validate input ca client (JS) va server (PHP).
- Co phan trang cho danh sach dai.
- Upload anh len server (khong dung URL anh ngoai).
- Responsive (mobile/tablet/desktop).
- Test tren trinh duyet pho bien.
- Co noi dung bao mat co ban + SEO co ban.

## 3) Doi chieu hien trang source

### 3.1 Da co (giu nguyen, hoan thien them)
- Auth co ban: dang ky/dang nhap/phan quyen.
- Ho so: sua thong tin, doi mat khau, avatar.
- Quan ly user co ban (xem/reset/khoa/xoa).
- Tim kiem va phan trang mot so trang.
- Quan ly lien he co ban.

### 3.2 Con thieu (uu tien lam ngay)
- CRUD tin tuc admin day du (them/sua/xoa/xem/tim kiem).
- CRUD san pham admin day du (bo sung sua/tim kiem neu thieu).
- Quan ly binh luan/danh gia (member + admin).
- Neu nhom chon huong e-commerce: gio hang + don hang + trang thai.
- Chuan dashboard admin theo de (template Srtdash).

## 4) Bo ngay nhung thu THUA
- Bo mo ta dai dong "giai thich vi sao source loang".
- Khong viet trong report cac tinh nang chua co code.
- Khong them tinh nang ngoai de neu chua xong muc bat buoc.
- Khong de 2 luong chay lung tung (HTML cu + MVC moi) tren demo chinh.

## 5) Checklist nop bai an toan
- Co account admin demo hoat dong.
- DB import 1 lan la chay.
- Huong dan cai dat ngan gon, ro rang.
- Tat ca form co validate JS + PHP.
- Tat ca danh sach dai co pagination.
- Anh deu upload vao server.
- Co ghi ro phan cong tung thanh vien theo dung muc #1/#2/#3/#4.

## 6) Lenh reset mat khau admin (giu lai de demo)
Chay tai thu muc `Assignment1 - Team36`:

```bash
php -r 'require "config.php"; $db=Database::getInstance()->getConnection(); $h=password_hash("admin123", PASSWORD_DEFAULT); $db->prepare("UPDATE users SET password=:p WHERE email=:e")->execute([":p"=>$h,":e"=>"admin@vng.com"]); echo "Reset xong\n";'
```

Dang nhap sau reset:
- Email: `admin@vng.com`
- Password: `admin123`
