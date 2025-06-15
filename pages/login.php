<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Đăng Nhập - HomeFood</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Nội dung chính -->
  <main class="flex-grow-1">
    <div class="container-fluid login-container">
      <div class="row">
        <!-- Bên trái: Ảnh -->
        <div class="col-md-6 left-img d-none d-md-block"></div>

        <!-- Bên phải: Form -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
          <div class="w-75">
            <h4 class="text-success text-center fw-bold mb-4">ĐĂNG NHẬP</h4>
            <form>
              <div class="mb-3">
                <label for="phone" class="form-label">Nhập số điện thoại</label>
                <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                  <span class="input-group-text"><i class="bi bi-eye-slash"></i></span>
                </div>
              </div>
              <button type="submit" class="btn btn-login mb-2">Đăng nhập</button>
              <div class="text-center mb-3">
                <a href="#" class="text-success">Quên mật khẩu</a>
              </div>
            </form>

            <div class="text-center my-3">— hoặc đăng nhập với —</div>

            <button class="btn btn-outline-primary form-icon-btn">
              <i class="bi bi-facebook me-2"></i> Facebook
            </button>
            <button class="btn btn-outline-dark form-icon-btn">
              <i class="bi bi-google me-2"></i> Google
            </button>
            <button class="btn btn-outline-secondary form-icon-btn">
              <i class="bi bi-apple me-2"></i> Apple
            </button>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include '../includes/footer.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
