<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/config.php';

if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Bạn không có quyền thực hiện hành động này.']);
    exit;
}

$db = Database::getInstance()->getConnection();
$productModel = new Product($db);
$action = $_POST['action'] ?? '';

if ($action === 'add_product') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $imagePath = '';

    if ($title === '' || $description === '' || $price <= 0) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin sản phẩm.']);
        exit;
    }

    if (!empty($_FILES['image']['name']) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        if (!is_dir(UPLOAD_DIR)) {
            mkdir(UPLOAD_DIR, 0755, true);
        }
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['image']['name']));
        $targetFile = UPLOAD_DIR . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imagePath = 'uploads/' . $filename;
        }
    }

    if ($productModel->create($title, $description, $price, $imagePath)) {
        echo json_encode(['success' => true, 'message' => 'Sản phẩm mới đã được thêm.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Thêm sản phẩm thất bại.']);
    }
    exit;
}

if ($action === 'delete_product') {
    $productId = intval($_POST['product_id'] ?? 0);
    if ($productId <= 0) {
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ.']);
        exit;
    }

    if ($productModel->delete($productId)) {
        echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Xóa sản phẩm thất bại.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Hành động không hợp lệ.']);
