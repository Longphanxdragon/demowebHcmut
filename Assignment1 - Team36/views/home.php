<?php $pageTitle = 'Trang chủ'; require __DIR__ . '/header.php'; ?>
<div class="jumbotron p-4 mb-4 bg-light rounded">
  <h1 class="display-4">Chào mừng đến với VNG Company</h1>
  <p class="lead">Giải pháp website doanh nghiệp chuyên nghiệp - thiết kế responsive, quản lý nội dung, quản lý sản phẩm và liên hệ khách hàng.</p>
  <a class="btn btn-primary btn-lg" href="index.php?page=products" role="button">Xem sản phẩm</a>
</div>

<section class="mb-5">
  <h2 class="mb-4">Sản phẩm nổi bật</h2>
  <div class="row">
    <?php if (empty($products)): ?>
      <div class="col-12 alert alert-secondary">Chưa có sản phẩm nào.</div>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <div class="col-md-6 mb-4">
          <div class="card h-100">
            <?php if (!empty($product['image_path'])): ?>
              <img class="card-img-top" src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['title']); ?>">
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?php echo htmlspecialchars($product['title']); ?></h5>
              <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
            </div>
            <div class="card-footer">
              <strong>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VND</strong>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<section class="mb-5">
  <h2 class="mb-4">Tin tức nổi bật</h2>
  <?php if (empty($news)): ?>
    <div class="alert alert-secondary">Chưa có tin tức nào.</div>
  <?php else: ?>
    <?php foreach ($news as $article): ?>
      <div class="media mb-4 p-3 border rounded bg-white">
        <div class="media-body">
          <h5><?php echo htmlspecialchars($article['title']); ?></h5>
          <p><?php echo nl2br(htmlspecialchars(substr($article['content'], 0, 180))); ?>...</p>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</section>

<?php require __DIR__ . '/footer.php'; ?>