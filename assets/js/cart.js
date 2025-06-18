document.addEventListener("DOMContentLoaded", () => {
  const cartItemsContainer = document.querySelector(".cart-items-container");
  const totalPriceElement = document.getElementById("total-price");
  const checkAll = document.getElementById("checkAll");
  const clearAllBtn = document.querySelector(".clear-all");
  const checkoutBtn = document.querySelector(".checkout-btn");

  const confirmDeleteModalElement =
    document.getElementById("confirmDeleteModal");
  const confirmDeleteModal = new bootstrap.Modal(confirmDeleteModalElement);
  const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

  let itemToDeleteIndex = null; // Stores the index of the item to be deleted (for individual deletion)
  let confirmActionCallback = null; // Stores the function to execute on modal confirmation

  // --- Initial Cart Loading and Normalization ---
  let cart = JSON.parse(localStorage.getItem("cart")) || [];
  cart = cart.map((item) => ({
    ...item,
    isChecked: item.isChecked !== undefined ? item.isChecked : true,
    // Ensure price is a number. Convert from string if necessary.
    price:
      typeof item.price === "string"
        ? parseInt(item.price.replace(/[^\d]/g, "")) || 0
        : item.price || 0, // Default to 0 if price is missing or invalid
    // Ensure imgSrc exists, prioritize imgSrc, then 'image', then empty string
    imgSrc: item.imgSrc || item.image || "",
    quantity: item.quantity > 0 ? item.quantity : 1, // Ensure quantity is at least 1
  }));
  localStorage.setItem("cart", JSON.stringify(cart)); // Update localStorage with normalized cart

  // --- Core Functions ---

  // Renders the cart items to the DOM
  function renderCart() {
    cartItemsContainer.innerHTML = "";
    let total = 0;

    if (cart.length === 0) {
      cartItemsContainer.innerHTML =
        "<p class='text-center text-muted'>Giỏ hàng của bạn đang trống.</p>";
      totalPriceElement.textContent = "0đ";
      checkAll.checked = false;
      checkAll.disabled = true;
      checkoutBtn.disabled = true; // Disable checkout button when cart is empty
      return;
    }

    checkAll.disabled = false;
    checkoutBtn.disabled = false;

    cart.forEach((item, index) => {
      const priceNum = item.price; // Price is already a number from initial mapping
      // Only include in total if the item is checked
      if (item.isChecked) {
        total += priceNum * item.quantity;
      }

      const itemHTML = `
        <div class="col-md-8">
          <div class="d-flex align-items-center mb-4">
            <div class="d-flex align-items-center px-2">
              <input type="checkbox" class="form-check-input item-checkbox" data-index="${index}" ${
        item.isChecked ? "checked" : ""
      } style="width: 24px; height: 24px;background-color: green; border-color: black" />
            </div>

            <div class="cart-item bg-black text-white p-3 rounded flex-grow-1">
              <div class="d-flex">
                <div style="margin-right:30px;margin-left:30px">
                  <img src="${
                    item.imgSrc
                  }" class="img-fluid rounded me-3" style="width: 120px; height: 120px; object-fit: cover" alt="${
        item.name
      }" />
                </div>

                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between">
                    <div>
                      <h5 class="fw-bold mb-1" style="font-size:24px">${
                        item.name
                      }</h5>
                      <div class="text-success mb-2" style="font-size:24px">${priceNum.toLocaleString(
                        "vi-VN"
                      )}đ</div>
                      <div class="d-flex align-items-center gap-2 mb-2">
                        <button class="btn btn-outline-light btn-sm quantity-btn" data-index="${index}" data-action="decrease">-</button>
                        <span>${item.quantity}</span>
                        <button class="btn btn-outline-light btn-sm quantity-btn" data-index="${index}" data-action="increase">+</button>
                      </div>
                      <hr class="text-white my-2" />
                      <div class="fw-bold fs-5" >${(
                        priceNum * item.quantity
                      ).toLocaleString("vi-VN")}đ</div>
                    </div>

                    <div class="d-flex flex-column">
                      <button class="btn btn-link text-white fs-5 favorite-btn" style="margin-left:250px" data-index="${index}">
                        <i class="fa-regular fa-heart fa-xl"></i>
                      </button>

                      <button class="btn btn-link text-white fs-5 remove-btn" style="margin-top:100px;margin-left:250px" data-index="${index}">
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
    updateCheckAllCheckboxState(); // Update "Check all" checkbox state after rendering
  }

  // Updates the total price based on checked items in the cart array
  function updateTotalPrice() {
    let total = 0;
    cart.forEach((item) => {
      if (item.isChecked) {
        const priceNum = item.price; // Price is already a number
        total += priceNum * item.quantity;
      }
    });
    totalPriceElement.textContent = total.toLocaleString("vi-VN") + "đ";
  }

  // Updates the state of the "Check all" checkbox
  function updateCheckAllCheckboxState() {
    if (cart.length === 0) {
      checkAll.checked = false;
      checkAll.disabled = true;
    } else {
      const allChecked = cart.every((item) => item.isChecked);
      checkAll.checked = allChecked;
      checkAll.disabled = false;
    }
  }

  // Generic function to show the confirmation modal
  function showConfirmModal(callback) {
    confirmActionCallback = callback; // Store the function to call on confirmation
    confirmDeleteModal.show();
  }

  // --- Event Listeners ---

  // Event delegation for quantity, remove, and favorite buttons
  cartItemsContainer.addEventListener("click", (e) => {
    // Quantity buttons
    const quantityBtn = e.target.closest(".quantity-btn");
    if (quantityBtn) {
      const index = parseInt(quantityBtn.dataset.index);
      const action = quantityBtn.dataset.action;

      if (action === "increase") {
        cart[index].quantity++;
      } else if (action === "decrease") {
        if (cart[index].quantity > 1) {
          cart[index].quantity--;
        } else {
          return; // Do not decrease below 1
        }
      }
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart(); // Re-render to update quantities and totals
      updateTotalPrice();

      // Show success modal
      const updateModal = new bootstrap.Modal(
        document.getElementById("updateSuccessModal")
      );
      updateModal.show();
      return;
    }

    // Remove item button (trash icon)
    const removeBtn = e.target.closest(".remove-btn");
    if (removeBtn) {
      itemToDeleteIndex = parseInt(removeBtn.dataset.index); // Set index for individual deletion
      showConfirmModal(() => {
        // Callback for individual item deletion
        cart.splice(itemToDeleteIndex, 1);
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
        updateTotalPrice();
        itemToDeleteIndex = null; // Reset
      });
      return;
    }

    // Favorite button (heart icon)
    const favoriteBtn = e.target.closest(".favorite-btn");
    if (favoriteBtn) {
      const heartIcon = favoriteBtn.querySelector(".fa-heart");
      if (heartIcon) {
        if (heartIcon.classList.contains("fa-solid")) {
          // If already favorited -> unfavorite
          heartIcon.classList.remove("fa-solid", "text-danger");
          heartIcon.classList.add("fa-regular");
        } else {
          // If not favorited -> favorite
          heartIcon.classList.remove("fa-regular");
          heartIcon.classList.add("fa-solid", "text-danger");

          // Show favorite modal
          const favoriteModal = new bootstrap.Modal(
            document.getElementById("favoriteModal")
          );
          favoriteModal.show();
        }
      }
      return;
    }
  });

  // Event delegation for item checkboxes
  cartItemsContainer.addEventListener("change", (e) => {
    if (e.target.classList.contains("item-checkbox")) {
      const index = parseInt(e.target.dataset.index);
      cart[index].isChecked = e.target.checked; // Update checked state in cart array
      localStorage.setItem("cart", JSON.stringify(cart)); // Save to localStorage

      updateTotalPrice();
      updateCheckAllCheckboxState(); // Update "Check all" checkbox state
    }
  });

  // "Clear All" button
  clearAllBtn.addEventListener("click", () => {
    showConfirmModal(() => {
      // Callback for clearing all items
      localStorage.removeItem("cart");
      cart = []; // Empty the cart array
      renderCart();
      updateTotalPrice();
      updateCheckAllCheckboxState();
    });
  });

  // "Check All" checkbox
  checkAll.addEventListener("change", (e) => {
    const checked = e.target.checked;
    cart.forEach((item) => {
      item.isChecked = checked; // Update checked state for all items in cart array
    });
    localStorage.setItem("cart", JSON.stringify(cart)); // Save to localStorage
    renderCart(); // Re-render to update all item checkboxes
    updateTotalPrice();
  });

  // Confirmation button in the delete modal
  confirmDeleteBtn.addEventListener("click", () => {
    if (confirmActionCallback) {
      confirmActionCallback(); // Execute the stored callback function
    }
    confirmDeleteModal.hide(); // Hide the modal after action
  });

  // Checkout button
  checkoutBtn.addEventListener("click", () => {
    const selectedItems = cart.filter((item) => item.isChecked); // Filter selected items

    if (selectedItems.length === 0) {
      alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
      return;
    }

    // Save selected items to localStorage under a new key for the payment page
    const itemsToSaveForPayment = selectedItems.map((item) => ({
      name: item.name,
      quantity: item.quantity,
      price: item.price,
      imgSrc: item.imgSrc,
    }));

    localStorage.setItem(
      "selectedItemsForPayment",
      JSON.stringify(itemsToSaveForPayment)
    );

    // Redirect to the payment page
    window.location.href = "../pages/payment.php"; // Adjust path if necessary
  });

  // --- Initial Page Load ---
  renderCart();
  updateTotalPrice(); // Ensure correct total price on page load
  updateCheckAllCheckboxState(); // Ensure correct initial state of checkAll
});
