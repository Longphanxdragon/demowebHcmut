<?php $pageTitle = 'Hỏi đáp'; require __DIR__ . '/header.php'; ?>
<div class="mb-4">
  <h1>Hỏi đáp</h1>
  <p>Một số câu hỏi thường gặp về website và dịch vụ.</p>
</div>
<div class="accordion" id="faqAccordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne">Website có hỗ trợ thiết bị di động không?</button>
      </h2>
    </div>
    <div id="collapseOne" class="collapse show" data-parent="#faqAccordion">
      <div class="card-body">Có, giao diện được thiết kế responsive và hiển thị tốt trên điện thoại, máy tính bảng và desktop.</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">Làm sao để quản lý sản phẩm?</button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
      <div class="card-body">Admin có thể đăng nhập và thêm, sửa, xoá sản phẩm qua trang quản trị.</div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree">Website có lưu liên hệ khách hàng không?</button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" data-parent="#faqAccordion">
      <div class="card-body">Có, mọi yêu cầu liên hệ sẽ được lưu vào MySQL để admin xem và phản hồi.</div>
    </div>
  </div>
</div>
<?php require __DIR__ . '/footer.php'; ?>