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

  <div class="card mt-4">
    <div class="card-header">Bình luận và đánh giá</div>
    <div class="card-body">
      <?php if ($currentUser): ?>
        <form method="post" action="index.php?page=product_detail&id=<?php echo intval($productDetail['id']); ?>" class="mb-4">
          <input type="hidden" name="action" value="add_comment">
          <input type="hidden" name="target_id" value="<?php echo intval($productDetail['id']); ?>">
          <div class="form-group">
            <label for="rating">Điểm đánh giá (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
              <option value="">Chọn điểm</option>
              <option value="5">5 - Rất tốt</option>
              <option value="4">4 - Tốt</option>
              <option value="3">3 - Bình thường</option>
              <option value="2">2 - Chưa tốt</option>
              <option value="1">1 - Kém</option>
            </select>
          </div>
          <div class="form-group">
            <label for="content">Nội dung bình luận</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Gửi đánh giá</button>
        </form>
      <?php else: ?>
        <div class="alert alert-info">Vui lòng đăng nhập để gửi bình luận/đánh giá.</div>
      <?php endif; ?>

      <?php if (empty($productComments)): ?>
        <div class="text-muted">Chưa có bình luận nào.</div>
      <?php else: ?>
        <ul class="list-group">
          <?php foreach ($productComments as $comment): ?>
            <li class="list-group-item">
              <div class="d-flex justify-content-between">
                <strong><?php echo htmlspecialchars($comment['user_name']); ?></strong>
                <small><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></small>
              </div>
              <div class="text-warning mb-1">Điểm: <?php echo intval($comment['rating']); ?>/5</div>
              <div><?php echo nl2br(htmlspecialchars($comment['content'])); ?></div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
