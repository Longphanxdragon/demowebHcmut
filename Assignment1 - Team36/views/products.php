<?php $pageTitle = 'Sản phẩm'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Sản phẩm</h1>
  <p>Danh sách sản phẩm dịch vụ công ty cung cấp (có hỗ trợ tìm kiếm và phân trang).</p>
</div>

<form method="get" action="index.php" class="mb-4">
  <input type="hidden" name="page" value="products">
  <div class="input-group">
    <input
      type="text"
      class="form-control"
      name="q_product"
      value="<?php echo htmlspecialchars($keywordProduct); ?>"
      placeholder="Tìm theo tên hoặc mô tả sản phẩm"
    >
    <div class="input-group-append">
      <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </div>
  </div>
</form>

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
            <a class="btn btn-outline-primary btn-sm" href="index.php?page=product_detail&id=<?php echo intval($product['id']); ?>">Xem chi tiết</a>
          </div>
          <div class="card-footer">
            <span class="font-weight-bold"><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</span>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php if ($productTotalPages > 1): ?>
  <nav aria-label="Phân trang sản phẩm">
    <ul class="pagination">
      <?php for ($p = 1; $p <= $productTotalPages; $p++): ?>
        <li class="page-item <?php echo ($p === $productPage) ? 'active' : ''; ?>">
          <a class="page-link" href="index.php?page=products&q_product=<?php echo urlencode($keywordProduct); ?>&product_page=<?php echo $p; ?>"><?php echo $p; ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>