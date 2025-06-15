function updateCartCount() {
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  document.getElementById("cart-count").textContent = cart.reduce(
    (total, item) => total + item.quantity,
    0
  );
}

document.addEventListener("DOMContentLoaded", () => {
  updateCartCount();

  document.querySelectorAll(".fa-cart-plus").forEach((button) => {
    button.addEventListener("click", () => {
      const card = button.closest(".card");
      const name = card.querySelector(".card-text").textContent.trim();
      const price = card.querySelector(".fw-bold").textContent.trim();
      const image = card.querySelector("img").getAttribute("src");
      const quantity = parseInt(card.querySelector("span").textContent);

      let cart = JSON.parse(localStorage.getItem("cart")) || [];
      const existing = cart.find((p) => p.name === name);

      if (existing) {
        existing.quantity += quantity;
      } else {
        cart.push({ name, price, image, quantity });
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
    });
  });

  document.querySelectorAll(".card").forEach((card) => {
    const qtySpan = card.querySelector("span");
    const minusBtn = card.querySelector(".btn-secondary:first-child");
    const plusBtn = card.querySelectorAll(".btn-secondary")[1];

    minusBtn?.addEventListener("click", () => {
      let qty = parseInt(qtySpan.textContent);
      if (qty > 1) qtySpan.textContent = qty - 1;
    });

    plusBtn?.addEventListener("click", () => {
      let qty = parseInt(qtySpan.textContent);
      qtySpan.textContent = qty + 1;
    });
  });
});
