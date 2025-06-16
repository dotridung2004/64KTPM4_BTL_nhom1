<?php
session_start();

// Danh sách tài khoản giả
$fake_users = [
  'user' => ['phone' => '0123456789', 'password' => 'user123', 'role' => 'user'],
  'admin' => ['phone' => '0987654321', 'password' => 'admin123', 'role' => 'admin']
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $phone = $_POST['phone'] ?? '';
  $password = $_POST['password'] ?? '';

  foreach ($fake_users as $username => $info) {
    if ($phone === $info['phone'] && $password === $info['password']) {
      $_SESSION['user'] = [
        'phone' => $phone,
        'role' => $info['role']
      ];

      // Chuyển hướng theo vai trò
      if ($info['role'] === 'admin') {
        header("Location: admin.php");
      } else {
        header("Location: ../index.php");
      }
      exit;
    }
  }

  $error = "Số điện thoại hoặc mật khẩu không đúng.";
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous"/>
  <link rel="stylesheet" href="../assets/css/login.css">
  <title>Đăng Nhập - HomeFood</title>
</head>
<body>
  <div class="container-fluid login-container">
    <div class="row g-0 h-100">
      <!-- Bên trái: Ảnh -->
      <div class="col-md-6">
        <img src="../assets/img/backlogin.png" alt="Ảnh đăng nhập" class="login-image" />
      </div>

      <!-- Bên phải: Form -->
      <div class="col-md-6 form-section">
        <div class="form-box">
          <h4 class="text-success fw-bold mb-4 text-center" style="margin-top:100px">ĐĂNG NHẬP</h4>

          <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
          <?php endif; ?>

          <div class="row">
            <!-- Cột trái: Form đăng nhập -->
            <div class="col-md-6">
              <form method="POST" action="">
                <div class="mb-3">
                  <label for="phone" class="form-label">Số điện thoại</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required />
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label">Mật khẩu</label>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required />
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                      <i class="fa-regular fa-eye-slash" id="eyeIcon"></i>
                    </span>
                  </div>
                </div>

                <button type="submit" class="btn btn-login mb-2">Đăng nhập</button>
                <div class="text-center mb-3">
                  <a href="#" class="text-link">Quên mật khẩu</a>
                </div>
              </form>
            </div>

            <!-- Cột phải: Mạng xã hội -->
            <div class="col-md-6 border-start-md">
              <div class="ps-md-3">
                <div class="fw-medium mb-3 text-center">Đăng nhập với</div>
                <button class="btn btn-outline-primary form-icon-btn">
                  <i class="fa-brands fa-facebook me-2"></i> <strong>Facebook</strong>
                </button>
                <button class="btn btn-outline-dark form-icon-btn">
                  <i class="fa-brands fa-google me-2"></i> <strong>Google</strong>
                </button>
                <button class="btn btn-outline-secondary form-icon-btn">
                  <i class="fa-brands fa-apple me-2"></i> <strong>Apple</strong>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>
  
  <script src="../assets/js/login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/99651229fa.js" crossorigin="anonymous"></script>
</body>
</html>
