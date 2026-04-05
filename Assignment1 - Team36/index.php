<?php
require_once __DIR__ . '/config.php';

$db = Database::getInstance()->getConnection();
$userModel = new User($db);
$productModel = new Product($db);
$newsModel = new News($db);
$contactModel = new Contact($db);

$page = $_GET['page'] ?? 'home';
$section = $_GET['section'] ?? '';
$currentUser = $_SESSION['user'] ?? null;
$isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';
$message = '';
$error = '';

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
            $_SESSION['user'] = $user;
            header('Location: index.php?page=home');
            exit;
        }
        $error = 'Email hoặc mật khẩu không đúng.';
    }

    if ($page === 'contact') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $messageText = trim($_POST['message'] ?? '');
        if ($name === '' || $email === '' || $subject === '' || $messageText === '') {
            $error = 'Vui lòng điền đầy đủ thông tin liên hệ.';
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

switch ($page) {
    case 'about':
        require __DIR__ . '/views/about.php';
        break;
    case 'products':
        require __DIR__ . '/views/products.php';
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
    case 'login':
        require __DIR__ . '/views/login.php';
        break;
    case 'register':
        require __DIR__ . '/views/register.php';
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
