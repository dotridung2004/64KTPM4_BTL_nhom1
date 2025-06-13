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
    <title>Thịt - Cá - Trứng - Thủy hải sản</title>
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
          <h4 class="text-white m-4">
            <span style="border-left: 5px solid green;padding-left: 10px;">Thịt - Cá - Trứng - Thủy hải sản</span>
          </h4>
        </div>

        <!-- Các thẻ card sản phẩm-->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
          <div class="col mb-4">
            <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;"
              data-id="1"
              data-name="Thịt bò úc xay 200g"
              data-price="38000"
              data-image="../assets/img/product1-1.png"
            >
              <img src="../assets/img/product1-1.png" class="card-img-top p-2" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Thịt bò úc xay 200g</p>
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
          <div class="col mb-4">
            <div class="card h-80 text-center" style="background-color: black; width: 244px; height: 467px;">
              <img src="../assets/img/product1-2.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Cá gáy TPP 350g</p>
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
          <div class="col mb-4">
            <div class="card h-80 text-center" style="background-color: black; width: 244px; height: 467px;">
              <img src="../assets/img/product1-3.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Cánh tỏi gà LeBoucher 500g</p>
              </div>
              <div class="card-footer bg-dark text-white text-center">
                <div class="fw-bold mb-2">45.000đ</div>
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
              <img src="../assets/img/product1-4.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Ba rọi heo 500g</p>
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
          <div class="col mb-4">
            <div class="card h-100 text-center" style="background-color: black; width: 244px; height: 467px;">
              <img src="../assets/img/product1-5.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Ba rọi rút sườn heo 500g</p>
              </div>
              <div class="card-footer bg-dark text-white text-center">
                <div class="fw-bold mb-2">158.000đ</div>
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
              <img src="../assets/img/product1-6.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Thịt vai heo 1kg</p>
              </div>
              <div class="card-footer bg-dark text-white text-center">
                <div class="fw-bold mb-2">139.000đ</div>
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
              <img src="../assets/img/product1-7.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Huyết hấp 400g</p>
              </div>
              <div class="card-footer bg-dark text-white text-center">
                <div class="fw-bold mb-2">18.000đ</div>
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
              <img src="../assets/img/product1-8.png" class="card-img-top p-3" alt="" style="height: 200px; object-fit: contain;">
              <div class="card-body text-white">
                <br>
                <br>
                <p class="card-text">Ba chỉ bò Mỹ cắt mỏng 300g</p>
              </div>
              <div class="card-footer bg-dark text-white text-center">
                <div class="fw-bold mb-2">115.000đ</div>
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
            <li class="page-item"><a class="page-link" href="product1.php">1</a></li>
            <li class="page-item"><a class="page-link" href="product1.php">2</a></li>
            <li class="page-item"><a class="page-link" href="product1.php">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Sau</a>
            </li>
          </ul>
        </nav>
        
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <!-- Cập nhật giỏ hàng-->
    <script>
      function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        document.getElementById('cart-count').textContent = cart.reduce((total, item) => total + item.quantity, 0);
      }

      document.addEventListener('DOMContentLoaded', () => {
        updateCartCount();

        document.querySelectorAll('.fa-cart-plus').forEach(button => {
          button.addEventListener('click', () => {
            const card = button.closest('.card');
            const name = card.querySelector('.card-text').textContent.trim();
            const price = card.querySelector('.fw-bold').textContent.trim();
            const image = card.querySelector('img').getAttribute('src');
            const quantity = parseInt(card.querySelector('span').textContent);

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            const existing = cart.find(p => p.name === name);

            if (existing) {
              existing.quantity += quantity;
            } else {
              cart.push({ name, price, image, quantity });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
          });
        });

        document.querySelectorAll('.card').forEach(card => {
          const qtySpan = card.querySelector('span');
          const minusBtn = card.querySelector('.btn-secondary:first-child');
          const plusBtn = card.querySelectorAll('.btn-secondary')[1];

          minusBtn?.addEventListener('click', () => {
            let qty = parseInt(qtySpan.textContent);
            if (qty > 1) qtySpan.textContent = qty - 1;
          });

          plusBtn?.addEventListener('click', () => {
            let qty = parseInt(qtySpan.textContent);
            qtySpan.textContent = qty + 1;
          });
        });
      });
    </script>

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