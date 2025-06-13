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
    <div class="cart-header fs-3 fw-bold mb-3">GIỎ HÀNG</div>

    <div class="cart-actions d-flex justify-content-between align-items-center mb-3">
      <div>
        <input type="checkbox" id="checkAll" class="form-check-input me-2" />
        <label for="checkAll">Chọn tất cả</label>
      </div>
      <span class="clear-all text-danger" role="button" style="cursor:pointer;">Xóa tất cả</span>
    </div>

    <div class="cart-items-container"></div>

    <div class="d-flex justify-content-between align-items-center mt-4">
      <div class="fw-bold fs-5">
        Tổng tiền: <span id="total-price">0đ</span>
      </div>
      <button class="btn btn-success checkout-btn">Thanh toán</button>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>

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
