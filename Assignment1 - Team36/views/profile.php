<?php $pageTitle = 'Tài khoản cá nhân'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Tài khoản cá nhân</h1>
  <p>Cập nhật thông tin, ảnh đại diện và mật khẩu.</p>
</div>

<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">Thông tin cá nhân</div>
      <div class="card-body">
        <form method="post" action="index.php?page=profile" enctype="multipart/form-data">
          <input type="hidden" name="action" value="update_profile">
          <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($currentUser['name'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($currentUser['email'] ?? ''); ?>" disabled>
          </div>
          <div class="form-group">
            <label for="avatar">Ảnh đại diện</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
          </div>
          <?php if (!empty($currentUser['avatar'])): ?>
            <div class="mb-3">
              <img src="<?php echo htmlspecialchars($currentUser['avatar']); ?>" alt="Avatar" style="max-width: 160px; border-radius: 8px;">
            </div>
          <?php endif; ?>
          <button type="submit" class="btn btn-primary">Lưu thông tin</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">Đổi mật khẩu</div>
      <div class="card-body">
        <form method="post" action="index.php?page=profile">
          <input type="hidden" name="action" value="change_password">
          <div class="form-group">
            <label for="old_password">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" id="old_password" name="old_password" required>
          </div>
          <div class="form-group">
            <label for="new_password">Mật khẩu mới</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
          </div>
          <div class="form-group">
            <label for="confirm_password">Xác nhận mật khẩu mới</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="6">
          </div>
          <button type="submit" class="btn btn-warning">Đổi mật khẩu</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
