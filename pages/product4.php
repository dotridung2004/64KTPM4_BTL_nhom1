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
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/product.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <title>Rau củ quả trái cây</title>
</head>
<body>
  <?php include '../includes/header.php'; ?>
    
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

  <div class="page1">
    <div class="container">
      <!-- Tên danh mục-->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-white m-3">
          <span style="border-left: 5px solid green;padding-left: 10px;">Rau củ quả trái cây</span>
        </h4>
      </div>

      <!-- Các thẻ card sản phẩm-->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
        <div class="col mb-4">
          <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-1.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Xà lách hỗn hợp Orlar 300g</p>
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
        <div class="col mb-4">
          <div class="card h-80 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-2.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Cải thìa Orlar 200g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">21.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-80 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-3.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Xà lách sồi đỏ Orlar 300g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">27.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-80 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-4.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Giá đậu xanh Xuân Điền 300g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">9.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-5.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Đậu đũa VietGap Xuân Điền 250g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">15.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-6.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Tắc Xuân Điền 200g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">11.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;">
            <img src="../assets/img/product4-7.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Su Su VietGap Xuân Điền 500g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">15.000đ</div>
              <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-sm btn-secondary">-</button>
                <span>1</span>
                <button class="btn btn-sm btn-secondary">+</button>
                <button class="btn btn-sm btn-success ms-2"><i class="fa-solid fa-cart-plus"></i></button>
              </div>
            </div>
          </div>
        </div>
        <div class="col mb-4">
          <div class="card h-80 text-center" style="background-color: black;width: 244px; height: 467px;">
            <img src="../assets/img/product4-8.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
            <div class="card-body text-white">
              <br>
              <br>
              <p class="card-text">Xà lách xoong lá lớn Xuân Điền 300g</p>
            </div>
            <div class="card-footer bg-dark text-white text-center">
              <div class="fw-bold mb-2">17.000đ</div>
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
      <br>
      <br>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled">
            <a class="page-link">Trước</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Sau</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>

  <script src="../assets/js/product.js"></script>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous">
  </script>
  <script
    src="https://kit.fontawesome.com/99651229fa.js"
    crossorigin="anonymous">
  </script>
</body>
</html>