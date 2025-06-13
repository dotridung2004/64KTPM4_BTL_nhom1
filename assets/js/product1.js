// Cập nhật số lượng trên icon giỏ hàng
function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  const cartCountElem = document.getElementById("cart-count");
  if (cartCountElem) {
    cartCountElem.textContent = cart.reduce(
      (total, item) => total + item.quantity,
      0
    );
  }
}

document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();

  // Xử lý nút tăng giảm số lượng
  document.querySelectorAll(".product-card").forEach((card) => {
    const qtySpan = card.querySelector(".quantity");
    const btnDecrease = card.querySelector(".btn-decrease");
    const btnIncrease = card.querySelector(".btn-increase");

    btnDecrease.addEventListener("click", () => {
      let qty = parseInt(qtySpan.textContent);
      if (qty > 1) qtySpan.textContent = qty - 1;
    });

    btnIncrease.addEventListener("click", () => {
      let qty = parseInt(qtySpan.textContent);
      qtySpan.textContent = qty + 1;
    });

    // Thêm sản phẩm vào giỏ khi bấm nút giỏ hàng
    card.querySelector(".btn-add-cart").addEventListener("click", () => {
      const name = card.getAttribute("data-name");
      const priceText = card.getAttribute("data-price");
      const price = parseInt(priceText);
      const image = card.getAttribute("data-image");
      const quantity = parseInt(qtySpan.textContent);

      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      const existingProduct = cart.find((p) => p.name === name);

      if (existingProduct) {
        existingProduct.quantity += quantity;
      } else {
        cart.push({ name, price, image, quantity });
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
    });
  });
});
