<?php $pageTitle = 'Trang quản trị'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Trang quản trị</h1>
  <p>Quản lý thành viên, sản phẩm, tin tức, bình luận/đánh giá và liên hệ khách hàng.</p>
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
      <div class="card-header">Thêm tin tức mới</div>
      <div class="card-body">
        <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>">
          <input type="hidden" name="action" value="add_news">
          <div class="form-group">
            <label for="news_title">Tiêu đề</label>
            <input type="text" class="form-control" id="news_title" name="title" required>
          </div>
          <div class="form-group">
            <label for="news_keyword">Từ khóa SEO</label>
            <input type="text" class="form-control" id="news_keyword" name="keyword" placeholder="web doanh nghiệp, chuyển đổi số">
          </div>
          <div class="form-group">
            <label for="news_meta_description">Mô tả SEO</label>
            <input type="text" class="form-control" id="news_meta_description" name="meta_description" maxlength="255" placeholder="Mô tả ngắn cho thẻ meta description">
          </div>
          <div class="form-group">
            <label for="news_content">Nội dung</label>
            <textarea class="form-control" id="news_content" name="content" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-success">Thêm tin tức</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">Danh sách sản phẩm (CRUD)</div>
  <div class="card-body" id="adminProductList">
    <?php if (empty($products)): ?>
      <div>Chưa có sản phẩm nào.</div>
    <?php else: ?>
      <div class="list-group">
        <?php foreach ($products as $product): ?>
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <div>
                <h5 class="mb-1"><?php echo htmlspecialchars($product['title']); ?></h5>
                <p class="mb-1"><?php echo htmlspecialchars($product['description']); ?></p>
                <small><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</small>
              </div>
              <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct(<?php echo intval($product['id']); ?>)">Xóa</button>
            </div>

            <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" enctype="multipart/form-data" class="border rounded p-2 bg-light">
              <input type="hidden" name="action" value="update_product">
              <input type="hidden" name="product_id" value="<?php echo intval($product['id']); ?>">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label>Tên</label>
                  <input type="text" class="form-control form-control-sm" name="title" required value="<?php echo htmlspecialchars($product['title']); ?>">
                </div>
                <div class="form-group col-md-3">
                  <label>Giá</label>
                  <input type="number" class="form-control form-control-sm" name="price" step="0.01" min="1" required value="<?php echo htmlspecialchars($product['price']); ?>">
                </div>
                <div class="form-group col-md-5">
                  <label>Ảnh mới (tùy chọn)</label>
                  <input type="file" class="form-control-file form-control-sm" name="image" accept="image/*">
                </div>
              </div>
              <div class="form-group mb-2">
                <label>Mô tả</label>
                <textarea class="form-control form-control-sm" name="description" rows="2" required><?php echo htmlspecialchars($product['description']); ?></textarea>
              </div>
              <button type="submit" class="btn btn-sm btn-outline-primary">Cập nhật sản phẩm</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">Danh sách tin tức (CRUD)</div>
  <div class="card-body p-0">
    <?php if (empty($adminNews)): ?>
      <div class="p-3">Chưa có tin tức nào.</div>
    <?php else: ?>
      <div class="list-group list-group-flush">
        <?php foreach ($adminNews as $item): ?>
          <div class="list-group-item">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h5 class="mb-1"><?php echo htmlspecialchars($item['title']); ?></h5>
                <small class="text-muted">Ngày đăng: <?php echo date('d/m/Y H:i', strtotime($item['created_at'])); ?></small>
              </div>
              <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" onsubmit="return confirm('Xóa tin tức này?');">
                <input type="hidden" name="action" value="delete_news">
                <input type="hidden" name="news_id" value="<?php echo intval($item['id']); ?>">
                <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
              </form>
            </div>

            <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" class="border rounded p-2 mt-2 bg-light">
              <input type="hidden" name="action" value="update_news">
              <input type="hidden" name="news_id" value="<?php echo intval($item['id']); ?>">
              <div class="form-group mb-2">
                <label>Tiêu đề</label>
                <input type="text" class="form-control form-control-sm" name="title" required value="<?php echo htmlspecialchars($item['title']); ?>">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label>Từ khóa SEO</label>
                  <input type="text" class="form-control form-control-sm" name="keyword" value="<?php echo htmlspecialchars($item['keyword'] ?? ''); ?>">
                </div>
                <div class="form-group col-md-6">
                  <label>Mô tả SEO</label>
                  <input type="text" class="form-control form-control-sm" name="meta_description" maxlength="255" value="<?php echo htmlspecialchars($item['meta_description'] ?? ''); ?>">
                </div>
              </div>
              <div class="form-group mb-2">
                <label>Nội dung</label>
                <textarea class="form-control form-control-sm" name="content" rows="3" required><?php echo htmlspecialchars($item['content']); ?></textarea>
              </div>
              <button type="submit" class="btn btn-sm btn-outline-primary">Cập nhật tin tức</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>

      <?php if ($adminNewsTotalPages > 1): ?>
        <nav class="mt-3 px-3 pb-3" aria-label="Phân trang tin tức admin">
          <ul class="pagination pagination-sm mb-0">
            <?php for ($p = 1; $p <= $adminNewsTotalPages; $p++): ?>
              <li class="page-item <?php echo ($p === $adminNewsPage) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo $p; ?>&comment_page=<?php echo intval($commentPage); ?>"><?php echo $p; ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">Danh sách thành viên</div>
  <div class="card-body p-0">
    <?php if (empty($users)): ?>
      <div class="p-3">Chưa có thành viên nào.</div>
    <?php else: ?>
      <table class="table mb-0 table-sm">
        <thead>
          <tr>
            <th>ID</th><th>Họ tên</th><th>Email</th><th>Vai trò</th><th>Trạng thái</th><th>Tác vụ</th>
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
              <td>
                <?php if (intval($user['id']) !== intval($currentUser['id']) && $user['role'] !== 'admin'): ?>
                  <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" class="mb-1">
                    <input type="hidden" name="action" value="update_user_status">
                    <input type="hidden" name="user_id" value="<?php echo intval($user['id']); ?>">
                    <input type="hidden" name="status" value="<?php echo ($user['status'] === 'active') ? 'blocked' : 'active'; ?>">
                    <button type="submit" class="btn btn-sm <?php echo ($user['status'] === 'active') ? 'btn-warning' : 'btn-success'; ?> btn-block">
                      <?php echo ($user['status'] === 'active') ? 'Khóa' : 'Mở khóa'; ?>
                    </button>
                  </form>
                  <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" class="mb-1">
                    <input type="hidden" name="action" value="reset_user_password">
                    <input type="hidden" name="user_id" value="<?php echo intval($user['id']); ?>">
                    <input type="text" name="new_password" class="form-control form-control-sm mb-1" placeholder="Mật khẩu mới" minlength="6" required>
                    <button type="submit" class="btn btn-sm btn-info btn-block">Reset mật khẩu</button>
                  </form>
                  <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" onsubmit="return confirm('Xóa người dùng này?');">
                    <input type="hidden" name="action" value="delete_user">
                    <input type="hidden" name="user_id" value="<?php echo intval($user['id']); ?>">
                    <button type="submit" class="btn btn-sm btn-danger btn-block">Xóa</button>
                  </form>
                <?php else: ?>
                  <span class="text-muted small">Không áp dụng</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if ($userTotalPages > 1): ?>
        <nav class="mt-3 px-3 pb-3" aria-label="Phân trang thành viên admin">
          <ul class="pagination pagination-sm mb-0">
            <?php for ($p = 1; $p <= $userTotalPages; $p++): ?>
              <li class="page-item <?php echo ($p === $userPage) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo $p; ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>"><?php echo $p; ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>

<div class="card mb-4">
  <div class="card-header">Quản lý bình luận/đánh giá</div>
  <div class="card-body p-0">
    <?php if (empty($adminComments)): ?>
      <div class="p-3">Chưa có bình luận nào.</div>
    <?php else: ?>
      <table class="table mb-0 table-sm">
        <thead>
          <tr>
            <th>ID</th><th>Người dùng</th><th>Mục tiêu</th><th>Điểm</th><th>Nội dung</th><th>Trạng thái</th><th>Tác vụ</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($adminComments as $comment): ?>
            <tr>
              <td><?php echo intval($comment['id']); ?></td>
              <td>
                <div><?php echo htmlspecialchars($comment['user_name']); ?></div>
                <small class="text-muted"><?php echo htmlspecialchars($comment['user_email']); ?></small>
              </td>
              <td><?php echo htmlspecialchars($comment['target_type']); ?> #<?php echo intval($comment['target_id']); ?></td>
              <td><?php echo intval($comment['rating']); ?>/5</td>
              <td><?php echo nl2br(htmlspecialchars($comment['content'])); ?></td>
              <td><?php echo htmlspecialchars($comment['status']); ?></td>
              <td>
                <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" class="mb-1">
                  <input type="hidden" name="action" value="update_comment_status">
                  <input type="hidden" name="comment_id" value="<?php echo intval($comment['id']); ?>">
                  <input type="hidden" name="status" value="<?php echo ($comment['status'] === 'approved') ? 'hidden' : 'approved'; ?>">
                  <button type="submit" class="btn btn-sm <?php echo ($comment['status'] === 'approved') ? 'btn-warning' : 'btn-success'; ?> btn-block">
                    <?php echo ($comment['status'] === 'approved') ? 'Ẩn' : 'Duyệt'; ?>
                  </button>
                </form>
                <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" onsubmit="return confirm('Xóa bình luận này?');">
                  <input type="hidden" name="action" value="delete_comment">
                  <input type="hidden" name="comment_id" value="<?php echo intval($comment['id']); ?>">
                  <button type="submit" class="btn btn-sm btn-danger btn-block">Xóa</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?php if ($commentTotalPages > 1): ?>
        <nav class="mt-3 px-3 pb-3" aria-label="Phân trang bình luận admin">
          <ul class="pagination pagination-sm mb-0">
            <?php for ($p = 1; $p <= $commentTotalPages; $p++): ?>
              <li class="page-item <?php echo ($p === $commentPage) ? 'active' : ''; ?>">
                <a class="page-link" href="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo $p; ?>"><?php echo $p; ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      <?php endif; ?>
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
            <div class="mb-2">Trạng thái hiện tại: <span class="badge badge-info"><?php echo htmlspecialchars($contact['status']); ?></span></div>
            <p><?php echo nl2br(htmlspecialchars($contact['message'])); ?></p>
            <form method="post" action="index.php?page=admin&contact_page=<?php echo intval($contactPage); ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>" class="form-inline">
              <input type="hidden" name="action" value="update_contact_status">
              <input type="hidden" name="contact_id" value="<?php echo intval($contact['id']); ?>">
              <label class="mr-2" for="status_<?php echo intval($contact['id']); ?>">Cập nhật:</label>
              <select class="form-control form-control-sm mr-2" id="status_<?php echo intval($contact['id']); ?>" name="status">
                <option value="new" <?php echo ($contact['status'] === 'new') ? 'selected' : ''; ?>>new</option>
                <option value="read" <?php echo ($contact['status'] === 'read') ? 'selected' : ''; ?>>read</option>
                <option value="replied" <?php echo ($contact['status'] === 'replied') ? 'selected' : ''; ?>>replied</option>
              </select>
              <button type="submit" class="btn btn-sm btn-outline-primary">Lưu</button>
            </form>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <?php if ($contactTotalPages > 1): ?>
      <nav class="mt-3" aria-label="Phân trang liên hệ">
        <ul class="pagination pagination-sm mb-0">
          <?php for ($p = 1; $p <= $contactTotalPages; $p++): ?>
            <li class="page-item <?php echo ($p === $contactPage) ? 'active' : ''; ?>">
              <a class="page-link" href="index.php?page=admin&contact_page=<?php echo $p; ?>&user_page=<?php echo intval($userPage); ?>&admin_news_page=<?php echo intval($adminNewsPage); ?>&comment_page=<?php echo intval($commentPage); ?>"><?php echo $p; ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
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