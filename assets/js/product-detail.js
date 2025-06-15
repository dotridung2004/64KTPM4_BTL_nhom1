document.addEventListener("DOMContentLoaded", function () {
  // Cập nhật số lượng trong giỏ hàng
  function updateCartCount() {
    const cart = JSON.parse(localStorage.getItem("cart")) || [];
    const totalQty = cart.reduce((total, item) => total + item.quantity, 0);
    const cartCountElem = document.getElementById("cart-count");
    if (cartCountElem) cartCountElem.textContent = totalQty;
  }

  // Trái tim yêu thích
  const heartBtn = document.getElementById("heartBtn");
  const heartIcon = document.getElementById("heartIcon");
  if (heartBtn && heartIcon) {
    heartBtn.addEventListener("click", () => {
      heartIcon.classList.toggle("fa-regular");
      heartIcon.classList.toggle("fa-solid");
      heartIcon.style.color = heartIcon.classList.contains("fa-solid")
        ? "red"
        : "";
    });
  }

  // Đổi ảnh chính khi click thumbnail
  const mainImage = document.getElementById("mainImage");
  const thumbnails = document.querySelectorAll(".thumbnail-img");
  thumbnails.forEach((thumbnail) => {
    thumbnail.addEventListener("click", () => {
      if (mainImage && thumbnail.src) mainImage.src = thumbnail.src;
    });
  });

  // Tăng/giảm số lượng
  const qtySpan = document.getElementById("productQty");
  const minusBtn = document.querySelector(".btn-secondary:first-child");
  const plusBtn = document.querySelectorAll(".btn-secondary")[1];

  minusBtn?.addEventListener("click", () => {
    let qty = parseInt(qtySpan.textContent);
    if (qty > 1) qtySpan.textContent = qty - 1;
  });

  plusBtn?.addEventListener("click", () => {
    let qty = parseInt(qtySpan.textContent);
    qtySpan.textContent = qty + 1;
  });

  // Thêm vào giỏ hàng
  const addToCartBtn = document.getElementById("addToCartBtn");
  addToCartBtn?.addEventListener("click", () => {
    const name = document.getElementById("productName")?.textContent.trim();
    const priceText = document
      .getElementById("productPrice")
      ?.textContent.trim();
    const image = mainImage?.getAttribute("src") || "";
    const quantity = parseInt(qtySpan.textContent);

    // Kiểm tra dữ liệu
    if (!name || !priceText || !image || isNaN(quantity) || quantity <= 0) {
      alert(
        "❌ Không thể thêm sản phẩm. Thiếu thông tin hoặc số lượng không hợp lệ."
      );
      console.log({ name, priceText, image, quantity });
      return;
    }

    // Chuyển giá từ "98.000đ" -> 98000
    // Loại bỏ tất cả các ký tự không phải số (bao gồm dấu chấm, dấu phẩy, chữ 'đ')
    const price = parseInt(priceText.replace(/[^\d]/g, ""));
    if (isNaN(price)) {
      alert("❌ Lỗi khi xử lý giá sản phẩm.");
      return;
    }

    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    const existing = cart.find((p) => p.name === name);

    if (existing) {
      // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
      existing.quantity += quantity;
    } else {
      // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
      cart.push({ name, price, image, quantity });
    }

    // Lưu giỏ hàng đã cập nhật vào localStorage
    localStorage.setItem("cart", JSON.stringify(cart));

    // Cập nhật số lượng sản phẩm hiển thị trên icon giỏ hàng
    updateCartCount();

    alert("✅ Sản phẩm đã được thêm vào giỏ hàng!");
  });

  updateCartCount();
});
