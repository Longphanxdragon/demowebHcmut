<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle ?? APP_NAME); ?></title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Charm&family=Texturina:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.9/dist/css/uikit.min.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="css/homepage.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php?page=home">VNG</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo ($page === 'home') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=home">Trang chủ</a></li>
      <li class="nav-item <?php echo ($page === 'about') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=about">Giới thiệu</a></li>
      <li class="nav-item <?php echo ($page === 'products') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=products">Sản phẩm</a></li>
      <li class="nav-item <?php echo ($page === 'pricing') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=pricing">Bảng giá</a></li>
      <li class="nav-item <?php echo ($page === 'news') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=news">Tin tức</a></li>
      <li class="nav-item <?php echo ($page === 'contact') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=contact">Liên hệ</a></li>
      <li class="nav-item <?php echo ($page === 'faq') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=faq">Hỏi đáp</a></li>
    </ul>
    <ul class="navbar-nav">
      <?php if ($currentUser): ?>
        <li class="nav-item"><a class="nav-link" href="index.php?page=home">Xin chào <?php echo htmlspecialchars($currentUser['name']); ?></a></li>
        <?php if ($isAdmin): ?>
          <li class="nav-item"><a class="nav-link" href="index.php?page=admin">Quản trị</a></li>
        <?php endif; ?>
        <li class="nav-item"><a class="nav-link" href="index.php?action=logout">Đăng xuất</a></li>
      <?php else: ?>
        <li class="nav-item <?php echo ($page === 'login') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=login">Đăng nhập</a></li>
        <li class="nav-item <?php echo ($page === 'register') ? 'active' : ''; ?>"><a class="nav-link" href="index.php?page=register">Đăng ký</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>
<div class="container mt-4">
  <?php if ($message): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($message); ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>
