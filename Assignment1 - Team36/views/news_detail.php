<?php $pageTitle = 'Chi tiết tin tức'; require __DIR__ . '/header.php'; ?>

<?php if (!$newsDetail): ?>
  <div class="alert alert-warning">Không tìm thấy bài viết.</div>
  <a class="btn btn-outline-secondary" href="index.php?page=news">Quay lại danh sách tin tức</a>
<?php else: ?>
  <article class="card">
    <div class="card-body">
      <h1 class="h3"><?php echo htmlspecialchars($newsDetail['title']); ?></h1>
      <div class="text-muted mb-3">Ngày đăng: <?php echo date('d/m/Y H:i', strtotime($newsDetail['created_at'])); ?></div>
      <div><?php echo nl2br(htmlspecialchars($newsDetail['content'])); ?></div>
      <a class="btn btn-primary mt-3" href="index.php?page=news">Quay lại danh sách</a>
    </div>
  </article>

  <div class="card mt-4">
    <div class="card-header">Bình luận và đánh giá bài viết</div>
    <div class="card-body">
      <?php if ($currentUser): ?>
        <form method="post" action="index.php?page=news_detail&id=<?php echo intval($newsDetail['id']); ?>" class="mb-4">
          <input type="hidden" name="action" value="add_comment">
          <input type="hidden" name="target_id" value="<?php echo intval($newsDetail['id']); ?>">
          <div class="form-group">
            <label for="rating">Điểm đánh giá (1-5)</label>
            <select class="form-control" id="rating" name="rating" required>
              <option value="">Chọn điểm</option>
              <option value="5">5 - Rất hữu ích</option>
              <option value="4">4 - Hữu ích</option>
              <option value="3">3 - Bình thường</option>
              <option value="2">2 - Chưa tốt</option>
              <option value="1">1 - Kém</option>
            </select>
          </div>
          <div class="form-group">
            <label for="content">Nội dung bình luận</label>
            <textarea class="form-control" id="content" name="content" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Gửi bình luận</button>
        </form>
      <?php else: ?>
        <div class="alert alert-info">Vui lòng đăng nhập để gửi bình luận/đánh giá.</div>
      <?php endif; ?>

      <?php if (empty($newsComments)): ?>
        <div class="text-muted">Chưa có bình luận nào.</div>
      <?php else: ?>
        <ul class="list-group">
          <?php foreach ($newsComments as $comment): ?>
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
