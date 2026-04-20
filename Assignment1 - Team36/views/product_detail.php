<?php $pageTitle = 'Chi tiết sản phẩm'; require __DIR__ . '/header.php'; ?>

<?php if (!$productDetail): ?>
  <div class="alert alert-warning">Không tìm thấy sản phẩm.</div>
  <a class="btn btn-outline-secondary" href="index.php?page=products">Quay lại danh sách sản phẩm</a>
<?php else: ?>
  <div class="card">
    <?php if (!empty($productDetail['image_path'])): ?>
      <img class="card-img-top" src="<?php echo htmlspecialchars($productDetail['image_path']); ?>" alt="<?php echo htmlspecialchars($productDetail['title']); ?>">
    <?php endif; ?>
    <div class="card-body">
      <h1 class="h3"><?php echo htmlspecialchars($productDetail['title']); ?></h1>
      <p><?php echo nl2br(htmlspecialchars($productDetail['description'])); ?></p>
      <p class="font-weight-bold">Giá: <?php echo number_format($productDetail['price'], 0, ',', '.'); ?> VND</p>
      <a class="btn btn-primary" href="index.php?page=products">Quay lại danh sách</a>
    </div>
  </div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
