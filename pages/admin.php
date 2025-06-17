<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>Trang quản trị viên</title>
</head>
<body>
    <div class="container-fluid">
        <!-- Topbar -->
        <div class="row topbar text-center position-relative">
        <div class="col fw-bold text-center">Trang chủ</div>
        <div class="position-absolute end-0 pe-4 icons">
            <i class="fas fa-search" style="margin-left: 1500px;"></i>
            <i class="fas fa-user"></i>
        </div>
        </div>

        <!-- Main content -->
        <div class="row mt-4">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2">
            <div class="sidebar">
            <img src="../assets/img/logo.png" alt="HomeFood Logo">
            <a href="product-admin.php">Quản lý sản phẩm</a>
            <a href="comment-admin.php">Quản lý đánh giá sản phẩm</a>
            <a href="#">Chương trình khuyến mãi</a>
            <a href="#">Tin tức</a>
            </div>
        </div>

        <!-- Content bên phải (có thể để trống) -->
        <div class="col-md-9 col-lg-10">
            <!-- Nội dung chính sẽ ở đây -->
        </div>
        </div>
    </div>
    <br>
    <br>
    <?php include '../includes/footer.php';?>

    <script src="assets/js/index.js"></script>
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"
    ></script>
    <script
    src="https://kit.fontawesome.com/99651229fa.js"
    crossorigin="anonymous"
    ></script>
</body>
</html>
