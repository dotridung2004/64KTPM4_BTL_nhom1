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
        <div class="cart-item row mb-3 align-items-center">
          <div class="col-md-1">
            <input type="checkbox" class="form-check-input item-checkbox" data-index="${index}" checked />
          </div>
          <div class="col-md-2">
            <img src="${item.image}" class="img-fluid" alt="${item.name}" />
          </div>
          <div class="col-md-3">${item.name}</div>
          <div class="col-md-2">${item.price}</div>
          <div class="col-md-2">Số lượng: ${item.quantity}</div>
          <div class="col-md-2 text-end">
            <button class="btn btn-sm btn-danger remove-btn" data-index="${index}">Xóa</button>
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
});
