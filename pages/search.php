<?php
include 'products.php'; // Gọi danh sách sản phẩm

$keyword = isset($_GET['keyword']) ? strtolower(trim($_GET['keyword'])) : '';
$results = [];
$errorType = ''; // sẽ nhận giá trị: 'empty', 'invalid', 'notfound'

if ($keyword === '') {
    $errorType = 'empty';
} elseif (!preg_match('/^[\p{L}\p{N}\s]+$/u', $keyword)) {
    // Chỉ cho phép chữ cái, số và khoảng trắng (có hỗ trợ tiếng Việt Unicode)
    $errorType = 'invalid';
} else {
    foreach ($products as $product) {
        if (strpos(strtolower($product['name']), $keyword) !== false) {
            $results[] = $product;
        }
    }

    if (count($results) === 0) {
        $errorType = 'notfound';
    }else {
      header("Location: search-result.php?keyword=" . urlencode($keyword));
      exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Trang tìm kiếm</title>
  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
      crossorigin="anonymous"
    />
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
  <?php include '../includes/header.php'; ?>

    <div id="searchOffcanvas" class="search-offcanvas">
      <div class="offcanvas-header">
        <button id="closeSearch" class="back-btn"><i class="fa-solid fa-arrow-left"></i></button>
        <h4>Tìm kiếm</h4>
      </div>

      <div class="offcanvas-body">
        <form action="search.php" method="GET">
          <!-- Danh mục -->
          <select class="form-select mb-3" id="category-select" name="category">
            <option value="">Chọn danh mục</option>
            <option value="Thịt">Thịt-Cá-Trứng-Thủy hải sản</option>
            <option value="Đông">Thực phẩm mát - Đông</option>
            <option value="Bữa ăn">Bữa ăn tiện lợi</option>
            <option value="Rau">Rau củ quả - Trái cây</option>
          </select>

          <!-- Giá cả -->
          <select class="form-select mb-3" id="price-select" name="price">
            <option value="">Chọn giá cả</option>
            <option value="0-50000">0 - 50.000đ</option>
            <option value="50000-100000">50.000đ - 100.000đ</option>
            <option value="100000-200000">100.000đ - 200.000đ</option>
            <option value="200000+">Trên 200.000đ</option>
          </select>

          <!-- Tên sản phẩm -->
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm theo tên sản phẩm" value="<?= htmlspecialchars($keyword) ?>">
            <button class="btn btn-outline-secondary" type="submit">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </form>

        <!-- Gợi ý -->
        <p class="fw-bold text-danger">Từ khóa phổ biến</p>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach (['Thịt heo', 'Thịt bò', 'Rau củ quả', 'Đồ khô'] as $suggest): ?>
            <form action="search.php" method="GET">
              <input type="hidden" name="keyword" value="<?= $suggest ?>">
              <button type="submit" class="btn btn-outline-warning btn-sm"><?= $suggest ?></button>
            </form>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <!-- Banner quảng cáo -->
    <div class="page1">
      <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="1"
            aria-label="Slide 2"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="2"
            aria-label="Slide 3"
          ></button>
          <button
            type="button"
            data-bs-target="#carouselExampleIndicators"
            data-bs-slide-to="3"
            aria-label="Slide 4"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../assets/img/poster1.png" class="d-block w-100" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../assets/img/poster2.png" class="d-block w-100" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../assets/img/poster3.png" class="d-block w-100" alt="..." />
          </div>
          <div class="carousel-item">
            <img src="../assets/img/poster4.png" class="d-block w-100" alt="..." />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleIndicators"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    
  <!-- Tên danh mục sản phẩm đề xuất-->
  <div class="page2">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-white m-3">
          <span style="border-left: 5px solid green; padding-left: 10px;">Đề xuất cho bạn</span>
        </h4>
        <a href="#" class="text-white text-decoration-none">
          Xem thêm <i class="fas fa-chevron-right"></i>
        </a>
      </div>

      <div id="productCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
        <!-- Nút chỉ số (dots) -->
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="0" class="active"></button>
          <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="1"></button>
          <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="2"></button>
          <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="3"></button>
        </div>

        <!-- Slide sản phẩm -->
        <div class="carousel-inner">
          <!-- Trang 1 -->
          <div class="carousel-item active">
            <div class="row">
              <!-- Sản phẩm 1 -->
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color:black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot1.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">SƯỜN NON HEO 300g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">103.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Sản phẩm 2 -->
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot2.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">BA RỌI HEO 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">118.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Sản phẩm 3 -->
              <div class="col-md-3">
                <!-- card sản phẩm 3 ở đây -->
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot3.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">BA RỌI RÚT SƯỜN HEO 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">38.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Sản phẩm 4 -->
              <div class="col-md-3">
                <!-- card sản phẩm 4 ở đây -->
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot4.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">THỊT HEO XAY 1KG</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">190.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Trang 2 -->
          <div class="carousel-item">
            <div class="row">
              <!-- 4 sản phẩm tiếp theo -->
              <!-- Sản phẩm 5 -->
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot5.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Nạc dăm heo 1kg</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">209.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot6.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Xương ống heo 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">54.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot7.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Chân gà rút xương xốt thái hộp 550g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">99.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot8.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Cốt lết heo 1kg</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">138.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Trang 3-->
          <div class="carousel-item">
            <div class="row">
              <!-- 4 sản phẩm tiếp theo -->
              <!-- Sản phẩm 5 -->
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot9.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Xương đuôi heo 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">51.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot10.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Thịt heo xay 300g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">57.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot11.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Giò sống 200g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">37.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot12.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Sườn già heo 300g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">61.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Trang 4-->
          <div class="carousel-item">
            <div class="row">
              <!-- 4 sản phẩm tiếp theo -->
              <!-- Sản phẩm 5 -->
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot13.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Chả lụa bì ớt xiêm xanh 500gr</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">78.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot14.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Mỡ heo 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">50.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot15.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Nạc nọng heo 300g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">149.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;" id="card">
                  <img src="../assets/img/Hot16.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
                  <div class="card-body text-white">
                    <br>
                    <br>
                    <p class="card-text">Má đùi gà LeBoucher 500g</p>
                  </div>
                  <div class="card-footer bg-dark text-white text-center">
                    <div class="fw-bold mb-2">41.000đ</div>
                    <div class="d-flex justify-content-center align-items-center gap-2">
                      <button class="btn btn-sm btn-secondary">-</button>
                      <span>1</span>
                      <button class="btn btn-sm btn-secondary">+</button>
                      <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Nút chuyển trái/phải -->
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
        <br>
        <br>
        <br>
        <br>
      </div>
    </div>
  </div>
  
  <div class="page3">
    <section class="bg-black text-white py-5">
      <div class="container text-center">
        <h2 class="fw-bold mb-2">SẢN PHẨM</h2>
        <p class="mb-5">Đại gia đình thịt thật thà đợi bạn chọn đón về nhà</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          
          <!-- Bữa ăn tiện lợi -->
          <div class="col">
            <img src="../assets/img/pg3-2.png" class="mb-3" alt="Bữa ăn tiện lợi" style="height: 130px;">
            <h5 class="fw-bold">BỮA ĂN TIỆN LỢI</h5>
            <div class="d-flex align-items-center justify-content-center mb-3">
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
              <div class="px-3 fs-5">
                <i class="fas fa-utensils"></i> <!-- Biểu tượng dao nĩa -->
              </div>
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
            </div>
            <p>
              Sản phẩm gồm các món ăn Lành ngon - Lạ vị được chế biến từ 100% thịt sạch, trứng đạt tiêu chuẩn VSATTP,
              là lựa chọn tuyệt vời cho bữa cơm nhà, chỉ 5 phút có ngay món ngon vị tươi mới, đậm đà.
            </p>
          </div>

          <!-- Thực phẩm mát-đông -->
          <div class="col">
            <img src="..//img/pg3-3.png" class="mb-3" alt="Thực phẩm mát đông" style="height: 130px;">
            <h5 class="fw-bold">THỰC PHẨM MÁT-ĐÔNG</h5>
            <div class="d-flex align-items-center justify-content-center mb-3">
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
              <div class="px-3 fs-5">
                <i class="fas fa-bowl-food"></i> <!-- Biểu tượng dao nĩa -->
              </div>
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
            </div>
            <p>
              Thực phẩm được chế biến của ... với nguồn nguyên liệu sạch đúng chuẩn 3F Plus và công thức sáng tạo.
            </p>
          </div>

          <!-- Thịt - Cá - Trứng - Hải sản -->
          <div class="col">
            <img src="../assets/img/pg3-1.png" class="mb-3" alt="Thịt cá trứng hải sản" style="height: 130px;">
            <h5 class="fw-bold">THỊT - CÁ - TRỨNG - THỦY HẢI SẢN</h5>
            <div class="d-flex align-items-center justify-content-center mb-3">
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
              <div class="px-3 fs-5">
                <i class="fas fa-drumstick-bite"></i> <!-- Biểu tượng dao nĩa -->
              </div>
              <div class="flex-grow-1">
                <hr class="border-light">
              </div>
            </div>
            <p>
              Thịt Heo mát chuẩn 3F Plus, Thịt Bò Mỹ hạng Choice và Thủy Hải sản được sơ chế sẵn cho bữa cơm gia đình sạch ngon, tiện lợi.
            </p>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php if ($errorType): ?>
    <div class="modal fade show" id="errorModal" tabindex="-1" aria-labelledby="modalLabel" style="display: block;" aria-modal="true" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title fw-bold" id="modalLabel">Lỗi tìm kiếm</h5>
            <button type="button" class="btn-close" onclick="closeModal()" aria-label="Đóng"></button>
          </div>
          <div class="modal-body">
            <?php if ($errorType === 'empty'): ?>
              Vui lòng nhập từ khóa tìm kiếm !
            <?php elseif ($errorType === 'invalid'): ?>
              Từ khóa không hợp lệ. Vui lòng nhập lại !
            <?php elseif ($errorType === 'notfound'): ?>
              Không tìm thấy sản phẩm phù hợp !
            <?php endif; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" onclick="closeModal()">Thử lại</button>
            <button type="button" class="btn btn-outline-danger" onclick="closeModal()">Hủy</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show"></div>

    <script>
      function closeModal() {
        document.getElementById('errorModal').style.display = 'none';
        const backdrop = document.querySelector('.modal-backdrop');
        if (backdrop) backdrop.remove();
      }
    </script>
  <?php endif; ?>


  <?php include '../includes/footer.php'; ?>
  
  <script src="../assets/js/index.js"></script>
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
