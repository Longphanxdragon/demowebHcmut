<?php $pageTitle = 'Tin tức'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Tin tức</h1>
  <p>Cập nhật tin tức và thông báo từ công ty (có hỗ trợ tìm kiếm và phân trang).</p>
</div>

<form method="get" action="index.php" class="mb-4">
  <input type="hidden" name="page" value="news">
  <div class="input-group">
    <input
      type="text"
      class="form-control"
      name="q_news"
      value="<?php echo htmlspecialchars($keywordNews); ?>"
      placeholder="Tìm theo tiêu đề hoặc nội dung bài viết"
    >
    <div class="input-group-append">
      <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </div>
  </div>
</form>

<div class="list-group">
  <?php if (empty($news)): ?>
    <div class="alert alert-secondary">Chưa có tin tức mới.</div>
  <?php else: ?>
    <?php foreach ($news as $item): ?>
      <a href="index.php?page=news_detail&id=<?php echo intval($item['id']); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <h5 class="mb-1"><?php echo htmlspecialchars($item['title']); ?></h5>
          <small><?php echo date('d/m/Y', strtotime($item['created_at'])); ?></small>
        </div>
        <p class="mb-1"><?php echo nl2br(htmlspecialchars(substr($item['content'], 0, 180))); ?>...</p>
      </a>
    <?php endforeach; ?>
  <?php endif; ?>
</div>

<?php if ($newsTotalPages > 1): ?>
  <nav class="mt-4" aria-label="Phân trang tin tức">
    <ul class="pagination">
      <?php for ($p = 1; $p <= $newsTotalPages; $p++): ?>
        <li class="page-item <?php echo ($p === $newsPage) ? 'active' : ''; ?>">
          <a class="page-link" href="index.php?page=news&q_news=<?php echo urlencode($keywordNews); ?>&news_page=<?php echo $p; ?>"><?php echo $p; ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
<?php endif; ?>

<?php require __DIR__ . '/footer.php'; ?>