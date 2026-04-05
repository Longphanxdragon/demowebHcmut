<?php $pageTitle = 'Tin tức'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Tin tức</h1>
  <p>Cập nhật tin tức và thông báo từ công ty.</p>
</div>
<div class="list-group">
  <?php if (empty($news)): ?>
    <div class="alert alert-secondary">Chưa có tin tức mới.</div>
  <?php else: ?>
    <?php foreach ($news as $item): ?>
      <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1"><?php echo htmlspecialchars($item['title']); ?></h5>
          <small><?php echo date('d/m/Y', strtotime($item['created_at'])); ?></small>
        </div>
        <p class="mb-1"><?php echo nl2br(htmlspecialchars(substr($item['content'], 0, 180))); ?>...</p>
      </a>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<?php require __DIR__ . '/footer.php'; ?>