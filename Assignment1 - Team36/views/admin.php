<?php $pageTitle = 'Trang quản trị'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Trang quản trị</h1>
  <p>Quản lý thành viên, sản phẩm và liên hệ khách hàng.</p>
</div>
<div class="row">
  <div class="col-md-6 mb-4">
    <div class="card">
      <div class="card-header">Thêm sản phẩm mới</div>
      <div class="card-body">
        <form id="addProductForm" enctype="multipart/form-data">
          <input type="hidden" name="action" value="add_product">
          <div class="form-group">
            <label for="title">Tên sản phẩm</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label for="price">Giá (VND)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="image">Hình ảnh sản phẩm</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
          <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-6 mb-4">
    <div class="card">
      <div class="card-header">Danh sách thành viên</div>
      <div class="card-body p-0">
        <?php if (empty($users)): ?>
          <div class="p-3">Chưa có thành viên nào.</div>
        <?php else: ?>
          <table class="table mb-0">
            <thead>
              <tr>
                <th>ID</th><th>Họ tên</th><th>Email</th><th>Vai trò</th><th>Trạng thái</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $user): ?>
                <tr>
                  <td><?php echo htmlspecialchars($user['id']); ?></td>
                  <td><?php echo htmlspecialchars($user['name']); ?></td>
                  <td><?php echo htmlspecialchars($user['email']); ?></td>
                  <td><?php echo htmlspecialchars($user['role']); ?></td>
                  <td><?php echo htmlspecialchars($user['status']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>
<div class="card mb-4">
  <div class="card-header">Danh sách sản phẩm</div>
  <div class="card-body" id="adminProductList">
    <?php if (empty($products)): ?>
      <div>Chưa có sản phẩm nào.</div>
    <?php else: ?>
      <div class="list-group">
        <?php foreach ($products as $product): ?>
          <div class="list-group-item d-flex justify-content-between align-items-start">
            <div>
              <h5 class="mb-1"><?php echo htmlspecialchars($product['title']); ?></h5>
              <p class="mb-1"><?php echo htmlspecialchars($product['description']); ?></p>
              <small><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</small>
            </div>
            <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct(<?php echo intval($product['id']); ?>)">Xóa</button>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<div class="card mb-4">
  <div class="card-header">Danh sách liên hệ mới</div>
  <div class="card-body">
    <?php if (empty($contacts)): ?>
      <div>Chưa có liên hệ mới.</div>
    <?php else: ?>
      <ul class="list-group">
        <?php foreach ($contacts as $contact): ?>
          <li class="list-group-item">
            <strong><?php echo htmlspecialchars($contact['name']); ?></strong> (<?php echo htmlspecialchars($contact['email']); ?>) - <?php echo htmlspecialchars($contact['subject']); ?>
            <div class="small text-muted"><?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></div>
            <p><?php echo nl2br(htmlspecialchars($contact['message'])); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
<script>
  const addProductForm = document.getElementById('addProductForm');

  addProductForm.addEventListener('submit', async function(event) {
    event.preventDefault();
    const formData = new FormData(addProductForm);

    const response = await fetch('ajax_product.php', {
      method: 'POST',
      body: formData
    });
    const result = await response.json();

    if (result.success) {
      alert(result.message);
      window.location.reload();
    } else {
      alert(result.message || 'Có lỗi xảy ra khi thêm sản phẩm.');
    }
  });

  async function deleteProduct(productId) {
    if (!confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
      return;
    }

    const response = await fetch('ajax_product.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({ action: 'delete_product', product_id: productId })
    });
    const result = await response.json();

    if (result.success) {
      alert(result.message);
      window.location.reload();
    } else {
      alert(result.message || 'Có lỗi xảy ra khi xóa sản phẩm.');
    }
  }
</script>
<?php require __DIR__ . '/footer.php'; ?>