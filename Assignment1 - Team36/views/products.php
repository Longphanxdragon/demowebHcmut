<?php $pageTitle = 'Sản phẩm'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Sản phẩm</h1>
  <p>Danh sách sản phẩm dịch vụ công ty cung cấp.</p>
</div>
<div class="row">
  <?php if (empty($products)): ?>
    <div class="col-12 alert alert-warning">Không có sản phẩm để hiển thị.</div>
  <?php else: ?>
    <?php foreach ($products as $product): ?>
      <div class="col-md-6 mb-4">
        <div class="card h-100">
          <?php if (!empty($product['image_path'])): ?>
            <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
          <?php endif; ?>
          <div class="card-body">
            <h5><?php echo htmlspecialchars($product['title']); ?></h5>
            <p><?php echo htmlspecialchars($product['description']); ?></p>
          </div>
          <div class="card-footer">
            <span class="font-weight-bold"><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<?php require __DIR__ . '/footer.php'; ?>