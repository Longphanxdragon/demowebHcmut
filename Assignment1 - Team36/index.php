<?php
require_once __DIR__ . '/config.php';

$db = Database::getInstance()->getConnection();
$userModel = new User($db);
$productModel = new Product($db);
$newsModel = new News($db);
$contactModel = new Contact($db);

$page = $_GET['page'] ?? 'home';
$currentUser = $_SESSION['user'] ?? null;
$isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';
$message = '';
$error = '';

$keywordProduct = trim($_GET['q_product'] ?? '');
$keywordNews = trim($_GET['q_news'] ?? '');
$productPage = max(1, intval($_GET['product_page'] ?? 1));
$newsPage = max(1, intval($_GET['news_page'] ?? 1));
$contactPage = max(1, intval($_GET['contact_page'] ?? 1));

$publicPerPage = 6;
$adminPerPage = 10;

$productDetail = null;
$newsDetail = null;
$productTotalPages = 1;
$newsTotalPages = 1;
$contactTotalPages = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($page === 'register') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        if ($name === '' || $email === '' || $password === '') {
            $error = 'Vui lòng nhập đủ thông tin.';
        } elseif ($userModel->register($name, $email, $password)) {
            $message = 'Đăng ký thành công. Vui lòng đăng nhập.';
        } else {
            $error = 'Email đã được sử dụng.';
        }
    }

    if ($page === 'login') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = $userModel->login($email, $password);
        if ($user) {
            if (($user['status'] ?? 'active') === 'blocked') {
                $error = 'Tài khoản của bạn đang bị khóa.';
            } else {
                $_SESSION['user'] = $user;
                header('Location: index.php?page=home');
                exit;
            }
        } else {
            $error = 'Email hoặc mật khẩu không đúng.';
        }
    }

    if ($page === 'profile' && $currentUser && isset($_POST['action'])) {
        if ($_POST['action'] === 'update_profile') {
            $name = trim($_POST['name'] ?? '');
            $avatarPath = $currentUser['avatar'] ?? '';

            if (!empty($_FILES['avatar']['name']) && is_uploaded_file($_FILES['avatar']['tmp_name'])) {
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0755, true);
                }
                $filename = basename($_FILES['avatar']['name']);
                $targetFile = UPLOAD_DIR . $filename;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                    $avatarPath = 'uploads/' . $filename;
                }
            }

            if ($name === '') {
                $error = 'Tên hiển thị không được để trống.';
            } elseif ($userModel->updateProfile((int) $currentUser['id'], $name, $avatarPath)) {
                $freshUser = $userModel->getById((int) $currentUser['id']);
                if ($freshUser) {
                    unset($freshUser['password']);
                    $_SESSION['user'] = $freshUser;
                    $currentUser = $freshUser;
                    $isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';
                }
                $message = 'Cập nhật thông tin cá nhân thành công.';
            } else {
                $error = 'Không thể cập nhật thông tin cá nhân.';
            }
        }

        if ($_POST['action'] === 'change_password') {
            $oldPassword = $_POST['old_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($oldPassword === '' || $newPassword === '' || $confirmPassword === '') {
                $error = 'Vui lòng nhập đầy đủ thông tin đổi mật khẩu.';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'Mật khẩu xác nhận không khớp.';
            } elseif (strlen($newPassword) < 6) {
                $error = 'Mật khẩu mới cần có ít nhất 6 ký tự.';
            } elseif ($userModel->updatePassword((int) $currentUser['id'], $oldPassword, $newPassword)) {
                $message = 'Đổi mật khẩu thành công.';
            } else {
                $error = 'Mật khẩu hiện tại không đúng.';
            }
        }
    }

    if ($page === 'contact') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $messageText = trim($_POST['message'] ?? '');
        if ($name === '' || $email === '' || $subject === '' || $messageText === '') {
            $error = 'Vui lòng điền đầy đủ thông tin liên hệ.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Email liên hệ không hợp lệ.';
        } else {
            $contactModel->save($name, $email, $subject, $messageText);
            $message = 'Cảm ơn bạn, yêu cầu đã được gửi.';
        }
    }

    if ($page === 'admin' && $isAdmin && isset($_POST['action'])) {
        if ($_POST['action'] === 'add_product') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = floatval($_POST['price'] ?? 0);
            $imagePath = '';
            if (!empty($_FILES['image']['name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
                if (!is_dir(UPLOAD_DIR)) {
                    mkdir(UPLOAD_DIR, 0755, true);
                }
                $targetFile = UPLOAD_DIR . basename($_FILES['image']['name']);
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = 'uploads/' . basename($_FILES['image']['name']);
                }
            }
            if ($title && $description && $price > 0) {
                $productModel->create($title, $description, $price, $imagePath);
                $message = 'Sản phẩm mới đã được thêm.';
            } else {
                $error = 'Vui lòng nhập đầy đủ thông tin sản phẩm.';
            }
        }

        if ($_POST['action'] === 'delete_product' && isset($_POST['product_id'])) {
            $productModel->delete(intval($_POST['product_id']));
            $message = 'Sản phẩm đã được xóa.';
        }

        if ($_POST['action'] === 'update_contact_status') {
            $contactId = intval($_POST['contact_id'] ?? 0);
            $status = trim($_POST['status'] ?? '');
            if ($contactId <= 0 || !$contactModel->updateStatus($contactId, $status)) {
                $error = 'Không thể cập nhật trạng thái liên hệ.';
            } else {
                $message = 'Đã cập nhật trạng thái liên hệ.';
            }
        }

        if ($_POST['action'] === 'update_user_status') {
            $targetUserId = intval($_POST['user_id'] ?? 0);
            $targetStatus = trim($_POST['status'] ?? '');

            if ($targetUserId <= 0) {
                $error = 'Người dùng không hợp lệ.';
            } elseif ($targetUserId === intval($currentUser['id'] ?? 0)) {
                $error = 'Không thể thay đổi trạng thái tài khoản đang đăng nhập.';
            } elseif ($userModel->updateStatus($targetUserId, $targetStatus)) {
                $message = 'Đã cập nhật trạng thái người dùng.';
            } else {
                $error = 'Không thể cập nhật trạng thái người dùng.';
            }
        }

        if ($_POST['action'] === 'reset_user_password') {
            $targetUserId = intval($_POST['user_id'] ?? 0);
            $newPassword = $_POST['new_password'] ?? '';

            if ($targetUserId <= 0 || $newPassword === '') {
                $error = 'Vui lòng nhập đầy đủ thông tin reset mật khẩu.';
            } elseif ($userModel->resetPasswordByAdmin($targetUserId, $newPassword)) {
                $message = 'Đã reset mật khẩu người dùng.';
            } else {
                $error = 'Không thể reset mật khẩu người dùng.';
            }
        }

        if ($_POST['action'] === 'delete_user') {
            $targetUserId = intval($_POST['user_id'] ?? 0);

            if ($targetUserId <= 0) {
                $error = 'Người dùng không hợp lệ.';
            } elseif ($targetUserId === intval($currentUser['id'] ?? 0)) {
                $error = 'Không thể xóa tài khoản đang đăng nhập.';
            } elseif ($userModel->deleteById($targetUserId)) {
                $message = 'Đã xóa người dùng.';
            } else {
                $error = 'Không thể xóa người dùng (không áp dụng cho tài khoản admin).';
            }
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php?page=home');
    exit;
}

$products = $productModel->getAll();
$news = $newsModel->getAll();
$contacts = $isAdmin ? $contactModel->getAll() : [];
$users = $isAdmin ? $userModel->getAll() : [];

if ($page === 'products') {
    $totalProducts = $productModel->countSearch($keywordProduct);
    $productTotalPages = max(1, (int) ceil($totalProducts / $publicPerPage));
    if ($productPage > $productTotalPages) {
        $productPage = $productTotalPages;
    }
    $products = $productModel->searchPaged($keywordProduct, $publicPerPage, ($productPage - 1) * $publicPerPage);
}

if ($page === 'product_detail') {
    $productId = intval($_GET['id'] ?? 0);
    $productDetail = $productId > 0 ? $productModel->getById($productId) : null;
    if (!$productDetail) {
        $error = 'Không tìm thấy sản phẩm yêu cầu.';
    }
}

if ($page === 'news') {
    $totalNews = $newsModel->countSearch($keywordNews);
    $newsTotalPages = max(1, (int) ceil($totalNews / $publicPerPage));
    if ($newsPage > $newsTotalPages) {
        $newsPage = $newsTotalPages;
    }
    $news = $newsModel->searchPaged($keywordNews, $publicPerPage, ($newsPage - 1) * $publicPerPage);
}

if ($page === 'news_detail') {
    $newsId = intval($_GET['id'] ?? 0);
    $newsDetail = $newsId > 0 ? $newsModel->getById($newsId) : null;
    if (!$newsDetail) {
        $error = 'Không tìm thấy bài viết yêu cầu.';
    }
}

if ($page === 'admin' && $isAdmin) {
    $contactTotal = $contactModel->countAll();
    $contactTotalPages = max(1, (int) ceil($contactTotal / $adminPerPage));
    if ($contactPage > $contactTotalPages) {
        $contactPage = $contactTotalPages;
    }
    $contacts = $contactModel->getPaged($adminPerPage, ($contactPage - 1) * $adminPerPage);
}

switch ($page) {
    case 'about':
        require __DIR__ . '/views/about.php';
        break;
    case 'products':
        require __DIR__ . '/views/products.php';
        break;
    case 'product_detail':
        require __DIR__ . '/views/product_detail.php';
        break;
    case 'pricing':
        require __DIR__ . '/views/pricing.php';
        break;
    case 'contact':
        require __DIR__ . '/views/contact.php';
        break;
    case 'faq':
        require __DIR__ . '/views/faq.php';
        break;
    case 'news':
        require __DIR__ . '/views/news.php';
        break;
    case 'news_detail':
        require __DIR__ . '/views/news_detail.php';
        break;
    case 'login':
        require __DIR__ . '/views/login.php';
        break;
    case 'register':
        require __DIR__ . '/views/register.php';
        break;
    case 'profile':
        if (!$currentUser) {
            header('Location: index.php?page=login');
            exit;
        }
        require __DIR__ . '/views/profile.php';
        break;
    case 'admin':
        if (!$isAdmin) {
            header('Location: index.php?page=login');
            exit;
        }
        require __DIR__ . '/views/admin.php';
        break;
    default:
        require __DIR__ . '/views/home.php';
        break;
}
