// Lấy giỏ hàng từ localStorage (nếu có)
let cartCount = localStorage.getItem("cartCount") || 0;
document.getElementById("cart-count").textContent = cartCount;

document.querySelectorAll(".fa-cart-plus").forEach((button) => {
  button.addEventListener("click", () => {
    cartCount++;
    document.getElementById("cart-count").textContent = cartCount;
    localStorage.setItem("cartCount", cartCount);
  });
});
const openBtn = document.getElementById("openSearchBtn");
const closeBtn = document.getElementById("closeSearch");
const offcanvas = document.getElementById("searchOffcanvas");

openBtn.addEventListener("click", (e) => {
  e.preventDefault();
  offcanvas.classList.add("active");
});

closeBtn.addEventListener("click", () => {
  offcanvas.classList.remove("active");
});
