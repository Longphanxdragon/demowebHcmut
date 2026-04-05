<?php $pageTitle = 'Liên hệ'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Liên hệ</h1>
  <p>Gửi thông tin liên hệ, yêu cầu báo giá hoặc câu hỏi về dịch vụ.</p>
</div>
<form method="post" action="index.php?page=contact">
  <div class="form-group">
    <label for="name">Họ và tên</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="form-group">
    <label for="subject">Tiêu đề</label>
    <input type="text" class="form-control" id="subject" name="subject" required>
  </div>
  <div class="form-group">
    <label for="message">Nội dung</label>
    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
</form>
<?php require __DIR__ . '/footer.php'; ?>