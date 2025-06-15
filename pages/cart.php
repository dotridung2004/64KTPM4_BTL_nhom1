<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous"
  />
  <link rel="stylesheet" href="../assets/css/header.css" />
  <link rel="stylesheet" href="../assets/css/cart.css" />
  <link rel="stylesheet" href="../assets/css/footer.css" />
  <title>Giỏ hàng</title>
</head>
<body>
  <?php include '../includes/header.php'; ?>

  <div class="container mt-4">
    <div class="cart-header fs-3 fw-bold mb-3">GIỎ HÀNG</div><br>

    <div class="cart-actions d-flex justify-content-between align-items-center mb-3">
      <div>
        <input type="checkbox" id="checkAll" class="form-check-input me-2" style="background-color: green; border-color: black;width: 24px; height: 24px;"/>
        <label for="checkAll" style="color:green;font-size: 24px;">Chọn tất cả</label>
      </div>
      <span class="clear-all text-danger" role="button" style="cursor:pointer;margin-right:450px">Xóa tất cả</span>
    </div>
    
    <div class="cart-items-container"></div>

    <div class="d-flex align-items-center mt-4">
      <div class="fw-bold fs-5">
        Tổng tiền: <span id="total-price">0đ</span>
      </div>
      <button class="btn btn-success checkout-btn" style="margin-left: 900px;">Thanh toán</button>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>

  <!-- Modal thông báo thêm vào yêu thích -->
  <div class="modal fade" id="favoriteModal" tabindex="-1" aria-labelledby="favoriteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="favoriteModalLabel">Thông báo !</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          Đã lưu vào yêu thích
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" data-bs-dismiss="modal">Xác nhận</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal xác nhận xóa sản phẩm -->
  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-dark">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="confirmDeleteLabel">Thông báo !</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          Bạn có chắc chắn muốn xóa ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" id="confirmDeleteBtn">Xác nhận</button>
          <button type="button" class="btn btn-outline-danger" style="color:black;border-radius: 50px;" data-bs-dismiss="modal">Hủy</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal cập nhật thành công -->
  <div class="modal fade" id="updateSuccessModal" tabindex="-1" aria-labelledby="updateSuccessLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-dark">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="confirmDeleteLabel">Thông báo !</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          Cập nhật thành công.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" data-bs-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Gọi file JS tách riêng -->
  <script src="../assets/js/cart.js"></script>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://kit.fontawesome.com/99651229fa.js"
    crossorigin="anonymous"
  ></script>
</body>
</html>
