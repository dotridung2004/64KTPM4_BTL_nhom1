document.addEventListener("DOMContentLoaded", () => {
  const favoritesItemsContainer = document.querySelector(
    ".favorites-items-container"
  );

  // Khai báo lại favorites và cart để đồng bộ với cart.js
  let favorites = JSON.parse(localStorage.getItem("favorites")) || []; // Đã đổi từ 'favoriteItems'
  let cart = JSON.parse(localStorage.getItem("cart")) || []; // Đã đổi từ 'cartItems'

  // Hàm formatCurrency để đảm bảo nhất quán với cart.js
  function formatCurrency(amount) {
    return Number(amount).toLocaleString("vi-VN") + "đ";
  }

  function renderFavoriteItems() {
    favoritesItemsContainer.innerHTML = ""; // Clear existing items

    if (favorites.length === 0) {
      favoritesItemsContainer.innerHTML =
        '<p class="text-center text-muted">Bạn chưa có sản phẩm yêu thích nào.</p>';
      return;
    }

    favorites.forEach((item) => {
      const favoriteItemCol = document.createElement("div");
      favoriteItemCol.classList.add("col-lg-3", "col-md-4", "col-sm-6", "mb-4"); // Adjust column sizes as needed

      // Đảm bảo item.price được hiển thị đúng định dạng (có thể cần parse lại nếu nó đã là số)
      const displayPrice = formatCurrency(
        parseInt(String(item.price).replace(/[^\d]/g, "")) || 0
      );

      favoriteItemCol.innerHTML = `
                <div class="card h-100 shadow-sm">
                    <img src="${item.image}" class="card-img-top" alt="${item.name}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">${item.name}</h5>
                        <p class="card-text text-danger fw-bold">${displayPrice}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <button class="btn btn-sm btn-outline-success add-to-cart-btn" 
                                data-product-id="${item.id}" 
                                data-product-name="${item.name}" 
                                data-product-image="${item.image}" 
                                data-product-price="${item.price}">
                                Thêm vào giỏ
                            </button>
                            <i class="fa-solid fa-trash-can remove-favorite text-danger" 
                                data-product-id="${item.id}" 
                                style="cursor: pointer; font-size: 20px;"></i>
                        </div>
                    </div>
                </div>
            `;
      favoritesItemsContainer.appendChild(favoriteItemCol);
    });

    // Event listeners được xử lý bằng delegation bên dưới thay vì addFavoriteItemEventListeners()
  }

  function removeProductFromFavorites(productId) {
    favorites = favorites.filter((item) => item.id !== productId);
    localStorage.setItem("favorites", JSON.stringify(favorites)); // Đã đổi từ 'favoriteItems'
    renderFavoriteItems(); // Re-render the list
    alert("Đã xóa sản phẩm khỏi danh sách yêu thích."); // Có thể thay bằng modal
  }

  function addToCartFromFavorites(
    productId,
    productName,
    productImage,
    productPrice // ProductPrice ở đây vẫn là string gốc
  ) {
    // Đảm bảo giá được parse nhất quán với cart.js
    const parsedPrice =
      parseInt(String(productPrice).replace(/[^\d]/g, "")) || 0;

    const existingItemIndex = cart.findIndex(
      // Đã đổi từ 'cartItems'
      (item) => item.id === productId
    );

    if (existingItemIndex > -1) {
      cart[existingItemIndex].quantity++;
    } else {
      cart.push({
        id: productId,
        name: productName,
        image: productImage,
        price: parsedPrice, // Lưu giá dưới dạng số
        quantity: 1,
        selected: true,
      });
    }
    localStorage.setItem("cart", JSON.stringify(cart)); // Đã đổi từ 'cartItems'
    alert("Sản phẩm đã được thêm vào giỏ hàng!");
    // Optionally, you might want to redirect to the cart page or show a confirmation
  }

  // --- Sử dụng Event Delegation cho các nút trong favoritesItemsContainer ---
  favoritesItemsContainer.addEventListener("click", (event) => {
    // Xử lý nút xóa sản phẩm yêu thích
    const removeIcon = event.target.closest(".remove-favorite");
    if (removeIcon) {
      const productId = removeIcon.dataset.productId;
      if (
        confirm(
          "Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích?"
        )
      ) {
        removeProductFromFavorites(productId);
      }
      return;
    }

    // Xử lý nút "Thêm vào giỏ"
    const addToCartBtn = event.target.closest(".add-to-cart-btn");
    if (addToCartBtn) {
      const productId = addToCartBtn.dataset.productId;
      const productName = addToCartBtn.dataset.productName;
      const productImage = addToCartBtn.dataset.productImage;
      const productPrice = addToCartBtn.dataset.productPrice;

      addToCartFromFavorites(
        productId,
        productName,
        productImage,
        productPrice
      );
      return;
    }
  });

  renderFavoriteItems(); // Initial render when the page loads
});

// Helper function for currency formatting (đã gộp vào trong event listener để đảm bảo scope)
// Nếu bạn muốn dùng nó ở file khác, hãy giữ nó ở đây hoặc tạo một file helper riêng.
// function formatCurrency(amount) {
//     return amount.toLocaleString("vi-VN") + "đ";
// }
