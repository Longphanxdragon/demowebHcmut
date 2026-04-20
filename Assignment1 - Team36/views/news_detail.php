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
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>
