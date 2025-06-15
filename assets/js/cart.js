document.addEventListener("DOMContentLoaded", () => {
  const cartItemsContainer = document.querySelector(".cart-items-container");
  const totalPriceElement = document.getElementById("total-price");
  const checkAll = document.getElementById("checkAll");
  const clearAllBtn = document.querySelector(".clear-all");
  const checkoutBtn = document.querySelector(".checkout-btn");

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  // Hàm render giỏ hàng
  function renderCart() {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML = "<p>Giỏ hàng của bạn đang trống.</p>";
      totalPriceElement.textContent = "0đ";
      checkAll.checked = false;
      checkAll.disabled = true;
      checkoutBtn.disabled = true;
      return;
    }

    checkAll.disabled = false;
    checkoutBtn.disabled = false;

    cart.forEach((item, index) => {
      const priceNum = parseInt(item.price.replace(/[^\d]/g, "")) || 0;
      const itemTotal = priceNum * item.quantity;
      total += itemTotal;

      const itemHTML = `
        <div class="col-md-8">
          <div class="d-flex align-items-center mb-4">
            <!-- Checkbox bên ngoài -->
            <div class="d-flex align-items-center px-2">
              <input type="checkbox" class="form-check-input item-checkbox" data-index="${index}" checked style="width: 24px; height: 24px;background-color: green; border-color: black" />
            </div>

            <!-- Nội dung chính của sản phẩm -->
            <div class="cart-item bg-black text-white p-3 rounded flex-grow-1">
              <div class="d-flex">
                <!-- Hình ảnh sản phẩm -->
                <div style="margin-right:30px;margin-left:30px">
                  <img src="${
                    item.image
                  }" class="img-fluid rounded me-3" style="width: 120px; height: 120px; object-fit: cover" alt="${
        item.name
      }" />
                </div>

                <!-- Thông tin sản phẩm -->
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h5 class="fw-bold mb-1" style="font-size:24px">${
                        item.name
                      }</h5>
                      <div class="text-success mb-2" style="font-size:24px">${item.price.toLocaleString(
                        "vi-VN"
                      )}đ</div>
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <button class="btn btn-outline-light btn-sm quantity-btn" data-index="${index}" data-action="decrease">-</button>
                        <span>${item.quantity}</span>
                        <button class="btn btn-outline-light btn-sm quantity-btn" data-index="${index}" data-action="increase">+</button>
                      </div>
                      <hr class="text-white my-2" />
                      <div class="fw-bold fs-5" >${(
                        parseInt(item.price.replace(/[^\d]/g, "")) *
                        item.quantity
                      ).toLocaleString("vi-VN")}đ</div>
                    </div>

                    <!-- Icon yêu thích và xóa -->
                    <div class="d-flex flex-column">
                      <button class="btn btn-link text-white fs-5" style="margin-left:250px">
                        <i class="fa-regular fa-heart fa-xl"></i>
                      </button>

                      <!-- Icon thùng rác góc dưới phải -->
                      <button class="btn btn-link text-white fs-5 remove-btn" style="margin-top:100px;margin-left:250px"data-index="${index}">
                        <i class="fa-solid fa-trash-can fa-xl"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      `;
      cartItemsContainer.insertAdjacentHTML("beforeend", itemHTML);
    });

    totalPriceElement.textContent = total.toLocaleString("vi-VN") + "đ";
  }

  // Cập nhật tổng tiền theo các sản phẩm được chọn
  function updateTotalPrice() {
    const checkboxes = document.querySelectorAll(".item-checkbox");
    let total = 0;

    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        const idx = checkbox.dataset.index;
        const item = cart[idx];
        const priceNum = parseInt(item.price.replace(/[^\d]/g, "")) || 0;
        total += priceNum * item.quantity;
      }
    });

    totalPriceElement.textContent = total.toLocaleString("vi-VN") + "đ";
  }

  // Xóa sản phẩm theo index
  cartItemsContainer.addEventListener("click", (e) => {
    if (e.target.classList.contains("remove-btn")) {
      const index = e.target.dataset.index;
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
      updateTotalPrice();
    }
  });

  // Xóa tất cả sản phẩm
  clearAllBtn.addEventListener("click", () => {
    if (confirm("Bạn có chắc muốn xóa tất cả sản phẩm?")) {
      localStorage.removeItem("cart");
      cart = [];
      renderCart();
      updateTotalPrice();
    }
  });

  // Chọn tất cả checkbox
  checkAll.addEventListener("change", (e) => {
    const checked = e.target.checked;
    document.querySelectorAll(".item-checkbox").forEach((cb) => {
      cb.checked = checked;
    });
    updateTotalPrice();
  });

  // Bắt sự kiện thay đổi checkbox từng sản phẩm
  cartItemsContainer.addEventListener("change", (e) => {
    if (e.target.classList.contains("item-checkbox")) {
      // Nếu có 1 checkbox chưa chọn thì bỏ chọn "Chọn tất cả"
      const allCheckboxes = document.querySelectorAll(".item-checkbox");
      const allChecked = Array.from(allCheckboxes).every((cb) => cb.checked);
      checkAll.checked = allChecked;

      updateTotalPrice();
    }
  });

  // Xử lý nút Thanh toán (ví dụ alert)
  checkoutBtn.addEventListener("click", () => {
    const selectedItems = [];
    document.querySelectorAll(".item-checkbox").forEach((cb) => {
      if (cb.checked) {
        selectedItems.push(cart[cb.dataset.index]);
      }
    });

    if (selectedItems.length === 0) {
      alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
      return;
    }

    // Ở đây bạn có thể xử lý gửi dữ liệu đi, ví dụ:
    // console.log("Thanh toán các sản phẩm:", selectedItems);

    alert(`Bạn đã chọn ${selectedItems.length} sản phẩm để thanh toán.`);
  });

  renderCart();
  updateTotalPrice();

  // Xử lý bấm trái tim (thêm/bỏ yêu thích)
  cartItemsContainer.addEventListener("click", (e) => {
    const heartIcon = e.target.closest(".fa-heart");

    if (heartIcon) {
      if (
        heartIcon.classList.contains("fa-solid") &&
        heartIcon.classList.contains("text-danger")
      ) {
        // Nếu đã yêu thích -> bỏ yêu thích
        heartIcon.classList.remove("fa-solid", "text-danger");
        heartIcon.classList.add("fa-regular");
      } else {
        // Nếu chưa yêu thích -> thêm yêu thích
        heartIcon.classList.remove("fa-regular");
        heartIcon.classList.add("fa-solid", "text-danger");

        // Hiện modal yêu thích
        const favoriteModal = new bootstrap.Modal(
          document.getElementById("favoriteModal")
        );
        favoriteModal.show();
      }
    }
  });

  // Xử lý bấm icon thùng rác
  let itemToDeleteIndex = null;

  cartItemsContainer.addEventListener("click", (e) => {
    const trashIcon = e.target.closest(".fa-trash-can");
    if (trashIcon) {
      itemToDeleteIndex = trashIcon.closest("button")?.dataset.index;

      const deleteModal = new bootstrap.Modal(
        document.getElementById("confirmDeleteModal")
      );
      deleteModal.show();
    }
  });

  // Xử lý xác nhận xóa trong modal
  document.getElementById("confirmDeleteBtn").addEventListener("click", () => {
    if (itemToDeleteIndex !== null) {
      cart.splice(itemToDeleteIndex, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
      updateTotalPrice();
      itemToDeleteIndex = null;
    }
    const deleteModal = bootstrap.Modal.getInstance(
      document.getElementById("confirmDeleteModal")
    );
    deleteModal.hide();
  });

  // Xử lý tăng/giảm số lượng sản phẩm
  cartItemsContainer.addEventListener("click", (e) => {
    const btn = e.target.closest(".quantity-btn");
    if (btn) {
      const index = parseInt(btn.dataset.index);
      const action = btn.dataset.action;

      if (action === "increase") {
        cart[index].quantity++;
      } else if (action === "decrease") {
        if (cart[index].quantity > 1) {
          cart[index].quantity--;
        } else {
          return; // Không giảm xuống dưới 1
        }
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
      updateTotalPrice();

      // Hiển thị modal cập nhật thành công
      const updateModal = new bootstrap.Modal(
        document.getElementById("updateSuccessModal")
      );
      updateModal.show();
    }
  });
});
