<?php
// Giả lập dữ liệu sản phẩm theo ID (bạn thay bằng truy vấn DB thực tế)
$products = [
    1 => [
        'id' => 1,
        'name' => 'Ba rọi rút sườn heo G 500g',
        'image' => 'images/ba-roi.jpg',
        'price' => 98000,
        'description' => "- Thịt ba rọi hay còn gọi thịt ba chỉ có lớp thịt và lớp mỡ xen kẽ tạo nên ba đường chỉ đẹp mắt. Với hương vị mềm béo hài hòa đặc trưng do sự kết hợp cân đối giữa phần nạc và phần mỡ...",
        'brand' => 'HF',
        'weight' => '500g',
        'origin' => 'Việt Nam',
        'ingredient' => 'Thịt heo 100%',
    ],
        2 => [
        'id' => 2,
        'name' => 'Ba rọi rút sườn heo G 500g',
        'image' => 'images/ba-roi.jpg',
        'price' => 98000,
        'description' => "- Thịt ba rọi hay còn gọi thịt ba chỉ có lớp thịt và lớp mỡ xen kẽ tạo nên ba đường chỉ đẹp mắt. Với hương vị mềm béo hài hòa đặc trưng do sự kết hợp cân đối giữa phần nạc và phần mỡ...",
        'brand' => 'HF',
        'weight' => '500g',
        'origin' => 'Việt Nam',
        'ingredient' => 'Thịt heo 100%',
    ],
        3 => [
        'id' => 3,
        'name' => 'Ba rọi rút sườn heo G 500g',
        'image' => 'images/ba-roi.jpg',
        'price' => 98000,
        'description' => "- Thịt ba rọi hay còn gọi thịt ba chỉ có lớp thịt và lớp mỡ xen kẽ tạo nên ba đường chỉ đẹp mắt. Với hương vị mềm béo hài hòa đặc trưng do sự kết hợp cân đối giữa phần nạc và phần mỡ...",
        'brand' => 'HF',
        'weight' => '500g',
        'origin' => 'Việt Nam',
        'ingredient' => 'Thịt heo 100%',
    ],
        4 => [
        'id' => 4,
        'name' => 'THỊT HEO XAY 1KG',
        'images' => ['../assets/img/Hot4.png','../assets/img/product-detail4-1.png','../assets/img/product-detail4-2.png'],
        'price' => 179000,
        'description' => "- Thịt xay là loại thịt hết sức quen thuộc với mỗi bà nội trợ nhờ độ linh hoạt cao trong chế biến, lại nhanh thấm gia vị và có khả năng kết hợp hài hòa với hầu hết các loại rau củ, cho các đầu bếp tại gia thỏa sức biến tấu. Thịt xay của G được làm từ 80% nạc và 20% mỡ tươi sạch tạo sự hài hòa cho hương vị và sự an tâm tuyệt đối về chất lượng cho các món ăn. Hình ảnh sản phẩm có thể khác so với thực tế.",
        'brand' => 'G',
        'weight' => '1kg',
        'origin' => 'Việt Nam',
        'ingredient' => 'Thịt heo 100%',
    ],
    // thêm các sản phẩm khác nếu cần
];

// Lấy ID từ URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (isset($products[$id])) {
    $product = $products[$id];
} else {
    // Xử lý khi không tìm thấy sản phẩm
    echo "Sản phẩm không tồn tại.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['name']) ?> - HomeFood</title>
        <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/product-detail.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Main Content -->
    <div class="container-fluid my-4">
        <div class="row" id="page1">
            <!-- Cột ảnh sản phẩm -->
            <div class="col-md-6 text-center"style="background-color: black;">
                <img id="mainImage" src="<?= $product['images'][0] ?? $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid mb-3" style="max-height: 300px;">
                <br>
                <br>
                <!-- Thumbnail nếu có nhiều ảnh -->
                <?php if (isset($product['images']) && is_array($product['images'])): ?>
                <div class="d-flex justify-content-center gap-2 flex-wrap" >
                    <?php foreach ($product['images'] as $img): ?>
                        <img src="<?= $img ?>" alt="Thumbnail" class="img-thumbnail thumbnail-img" style="width: 130px; height: 130px; object-fit: cover; cursor: pointer; background-color:black;border:none;margin: 15px;">
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Cột mô tả và nút chức năng -->
            <div class="col-md-6 d-flex flex-column justify-content-center" style="background-color: black;color:white">
                <h4 id="productName"><?= htmlspecialchars($product['name'] ?? 'Tên sản phẩm') ?></h4><br>
                <div style="max-width: 600px;font-size: 18px;">
                    <p><?= nl2br(htmlspecialchars($product['description'] ?? '')) ?></p>
                </div>
                <p id="productPrice" style="color:#4caf50;font-size: 27px;"><?= isset($product['price']) ? number_format($product['price'], 0, ',', '.') . 'đ' : '' ?></p>
                <div class="d-flex align-items-center gap-3 mt-3">
                    <button class="btn btn-secondary btn-sm" style="padding: 8px 14px; font-size: 1rem;">-</button>
                    <span id="productQty" class="align-self-center">1</span>
                    <button class="btn btn-secondary btn-sm" style="padding: 8px 14px; font-size: 1rem;">+</button>
                    <button id="addToCartBtn" class="btn btn-success btn-sm" style="padding: 8px 14px; font-size: 1rem;"><i class="fa-solid fa-cart-plus fa-xl"></i></button>
                    <button id="heartBtn" class="btn btn-outline-light btn-sm" style="padding: 8px 14px; font-size: 1rem;border:none">
                        <i id="heartIcon" class="fa-regular fa-heart fa-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row">
        <!-- Thẻ card bên trái -->
            <div class="col-md-6">
                <div class="card bg-dark text-white p-4 rounded-4 shadow h-100">
                    <div class="d-flex align-items-center mb-3">
                        <img src="../assets/img/Logo2.png" alt="" class="m-2">
                        <h5 class="mb-0 fw-bold text-uppercase">Vì sao nên chọn sản phẩm này?</h5>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            G là một thương hiệu thuộc tập đoàn GREENFEED, được thành lập năm 2019 với cam kết mang đến sản phẩm Thịt heo mát chuẩn 3F plus từ chuỗi thực phẩm lành ngon "từ trang trại đến bàn ăn" của tập đoàn. Thịt heo mát chuẩn 3F plus, truy xuất nguồn gốc rõ ràng, mang lại sự an tâm cho khách hàng:
                        </li>
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Giống heo GF24 hợp tác với PIC của Mỹ (công ty con giống hàng đầu thế giới).
                        </li>
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Chuồng trại sạch, không dịch bệnh, cám sạch, không chất tăng trọng.
                        </li>
                        <li>
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Công nghệ thịt mát chuẩn Âu (0-4 độ C).
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="text-white m-4">
                        <span style="border-left: 5px solid green;padding-left: 10px;">Nấu ngon cùng HF</span>
                    </h4>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="m-4 d-flex align-items-center">
                        <img src="../assets/img/product-detail4-3.png" alt="" style="width: 186px; height: 188px; margin-right: 100px;">
                        <img src="../assets/img/product-detail4-4.png" alt="" style="width: 278px; height: 188px;">
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="m-4">
                        <img src="../assets/img/product-detail4-5.png" alt="" style="width: 560px;height: 358px;">
                    </div>
                </div>
            </div>

            <!-- Thẻ card bên phải -->
            <div class="col-md-6" style="margin-top: 30px;">
                <div class="card bg-dark text-white p-4 rounded-4 shadow h-100">
                    <div class="d-flex align-items-center mb-3">
                        <img src="../assets/img/Logo1.png" alt="" class="m-2">
                        <h5 class="mb-0 fw-bold text-uppercase">THÔNG TIN SẢN PHẨM</h5>
                    </div>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Thương hiệu: G
                        </li>
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Trọng lượng: 1kg
                        </li>
                        <li class="mb-2">
                            <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Xuất xứ: Việt Nam
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Thành phần: Thịt heo 100%
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Bảo quản: Nhiệt độ từ 0-4 độ C hoặc ngăn mát tủ lạnh.
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Hướng dẫn sử dụng: Nấu chín khi ăn.
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                        Gợi ý chế biến món ngon: Thịt viên, chả trứng hấp, nấu canh.
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Hạn sử dụng thực tế vui lòng xem trên bao bì. Hình ảnh chỉ mang tính chất minh họa.
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Sản phẩm nhận được có thể khác với hình ảnh về màu sắc và số lượng nhưng vẫn đảm bảo khối lượng và chất lượng.
                        </li>
                        <li>
                        <img src="../assets/img/Logo3.png" alt="" class="m-1">
                            Giá sản phẩm áp dụng cho khách hàng mua hàng online qua website hoặc app, không áp dụng tại cửa hàng.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/js/product-detail.js"></script>

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
