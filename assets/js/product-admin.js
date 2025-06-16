// Biến toàn cục để theo dõi ID sản phẩm tiếp theo và lưu trữ dữ liệu sản phẩm
let nextProductId = 6; // Bắt đầu từ 6 vì bạn có 5 sản phẩm mẫu trong HTML (product-1 đến product-5)
const productsData = []; // Mảng này sẽ lưu trữ dữ liệu các sản phẩm trong bộ nhớ

// Hàm để tải các sản phẩm mẫu vào productsData khi trang tải
function loadInitialProducts() {
  document.querySelectorAll(".product-card").forEach((card) => {
    // Đảm bảo thẻ product-card có ID
    const id = card.id;
    if (!id) {
      console.warn("Product card missing ID:", card);
      return; // Bỏ qua nếu không có ID để tránh lỗi
    }

    const nameElement = card.querySelector(".product-info .name");
    const priceElement = card.querySelector(".product-info .price");
    const quantityElement = card.querySelector(".product-info .quantity");
    const imgElement = card.querySelector("img");

    const name = nameElement ? nameElement.textContent.trim() : "";
    const priceText = priceElement ? priceElement.textContent.trim() : "";
    const price =
      parseFloat(
        priceText.replace("Giá: ", "").replace(/\./g, "").replace("đ", "")
      ) || 0; // Xóa định dạng tiền tệ và xử lý NaN
    const quantityText = quantityElement
      ? quantityElement.textContent.trim()
      : "";
    const quantity = parseInt(quantityText.replace("SL: ", "")) || 0; // Xử lý NaN
    const imageUrl = imgElement ? imgElement.src : "";

    // Lưu ý: desc, category, brand không có trong HTML mẫu, nên sẽ để trống hoặc thêm placeholder nếu cần
    productsData.push({
      id: id,
      name: name,
      desc: "", // Giả định không có trong HTML mẫu ban đầu
      price: price,
      category: "", // Giả định không có trong HTML mẫu ban đầu
      brand: "", // Giả định không có trong HTML mẫu ban đầu
      quantity: quantity,
      imageUrl: imageUrl,
      imageFile: null, // Không có file gốc từ sản phẩm tĩnh
    });
  });
  console.log("Sản phẩm ban đầu đã được tải:", productsData);
}

// Hàm render (hiển thị) một sản phẩm lên giao diện
function renderProduct(product) {
  const productListContainer = document.getElementById("productList");

  const newProductCard = document.createElement("div");
  newProductCard.classList.add("product-card");
  newProductCard.id = product.id; // Đặt ID cho thẻ sản phẩm

  newProductCard.innerHTML = `
        <img src="${product.imageUrl}" alt="${product.name}" />
        <div class="product-info">
            <div class="d-flex justify-content-between">
                <div class="name fw-bold">${product.name}</div>
                <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: ${
                  product.quantity
                }</div>
            </div>
            <div class="price">Giá: ${product.price.toLocaleString(
              "vi-VN"
            )}đ</div>
        </div>
        <div class="actions">
            <a href="#" class="edit edit-btn" data-id="${product.id}">Sửa</a>
            <a href="#" class="delete delete-btn" data-id="${
              product.id
            }">Xóa</a>
        </div>
    `;

  // Chèn sản phẩm mới lên đầu danh sách
  productListContainer.insertBefore(
    newProductCard,
    productListContainer.firstChild
  );

  // Gắn lại Event Listener cho các nút Sửa/Xóa mới được thêm vào DOM
  attachEventListenersToProductButtons();
}

// Hàm gắn Event Listener cho các nút Sửa/Xóa
function attachEventListenersToProductButtons() {
  // Xóa tất cả các listener cũ để tránh trùng lặp nếu gọi nhiều lần
  // (Đây là cách xử lý đơn giản cho ví dụ này, trong thực tế có thể dùng Event Delegation hiệu quả hơn)
  document.querySelectorAll(".edit-btn").forEach((btn) => {
    btn.removeEventListener("click", handleEditProduct);
  });
  document.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.removeEventListener("click", handleDeleteProduct);
  });

  // Gắn listener mới
  document.querySelectorAll(".edit-btn").forEach((btn) => {
    btn.addEventListener("click", handleEditProduct);
  });
  document.querySelectorAll(".delete-btn").forEach((btn) => {
    btn.addEventListener("click", handleDeleteProduct);
  });
}

// Hàm xử lý khi click nút "Sửa"
function handleEditProduct(event) {
  event.preventDefault();
  const productId = event.target.getAttribute("data-id");
  const product = productsData.find((p) => p.id === productId);

  if (product) {
    // Đặt tiêu đề modal là "Sửa sản phẩm"
    modalTitle.textContent = "Sửa sản phẩm";
    // Lưu ID sản phẩm vào input ẩn
    productIdToEditInput.value = productId;

    // Điền dữ liệu sản phẩm vào form
    document.getElementById("productName").value = product.name;
    document.getElementById("productDesc").value = product.desc;
    document.getElementById("productPrice").value = product.price;
    document.getElementById("productCategory").value = product.category;
    document.getElementById("productBrand").value = product.brand;
    document.getElementById("productQuantity").value = product.quantity;

    // Hiển thị ảnh hiện tại
    if (product.imageUrl) {
      currentProductImage.src = product.imageUrl;
      currentProductImage.style.display = "block";
    } else {
      currentProductImage.style.display = "none";
    }
    productImageInput.value = ""; // Xóa giá trị input file để người dùng có thể chọn file mới

    // Hiển thị modal
    const addProductModal = new bootstrap.Modal(addProductModalElement);
    addProductModal.show();
  }
}

// --- Xử lý Thêm/Sửa sản phẩm (Modal addProductModal) ---
const addProductModalElement = document.getElementById("addProductModal");
const addProductForm = document.getElementById("addProductForm");
const modalTitle = document.getElementById("modalTitle"); // Đã cập nhật id này trong HTML
const productIdToEditInput = document.getElementById("productIdToEdit"); // Đã thêm input ẩn này trong HTML
const currentProductImage = document.getElementById("currentProductImage"); // Đã thêm img này trong HTML
const productImageInput = document.getElementById("productImage"); // Để xử lý việc không chọn ảnh mới khi sửa

addProductForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // Lấy dữ liệu từ form
  const productNameInput = document.getElementById("productName");
  const productDescInput = document.getElementById("productDesc");
  const productPriceInput = document.getElementById("productPrice");
  const productCategorySelect = document.getElementById("productCategory");
  const productBrandInput = document.getElementById("productBrand");
  const productQuantityInput = document.getElementById("productQuantity");

  const name = productNameInput.value.trim();
  const desc = productDescInput.value.trim();
  const price = productPriceInput.value;
  const category = productCategorySelect.value;
  const brand = productBrandInput.value.trim();
  const quantity = productQuantityInput.value;
  const imageFile = productImageInput.files[0]; // Ảnh mới nếu có

  // Lấy các phần tử hiển thị lỗi
  const productNameError = document.getElementById("productNameError");
  const productDescError = document.getElementById("productDescError");
  const productPriceError = document.getElementById("productPriceError");
  const productCategoryError = document.getElementById("productCategoryError");
  const productBrandError = document.getElementById("productBrandError");
  const productImageError = document.getElementById("productImageError");
  const productQuantityError = document.getElementById("productQuantityError");
  const successMessageElement = document.getElementById("successMessage"); // Lấy element để đổi text

  let isValid = true;

  function validateField(inputElement, errorElement, condition) {
    if (condition) {
      inputElement.classList.remove("is-invalid");
      errorElement.style.display = "none";
    } else {
      inputElement.classList.add("is-invalid");
      errorElement.style.display = "block";
      isValid = false;
    }
  }

  validateField(productNameInput, productNameError, name !== "");
  validateField(productDescInput, productDescError, desc !== "");
  validateField(
    productPriceInput,
    productPriceError,
    price !== "" && parseFloat(price) > 0
  );
  validateField(productCategorySelect, productCategoryError, category !== "");
  validateField(productBrandInput, productBrandError, brand !== "");
  validateField(
    productQuantityInput,
    productQuantityError,
    quantity !== "" && parseInt(quantity) > 0
  );

  // Validation đặc biệt cho hình ảnh: nếu đang thêm MỚI hoặc sửa mà có chọn ảnh MỚI
  const isEditing = productIdToEditInput.value !== "";
  if (!isEditing) {
    // Nếu là thêm mới, ảnh là bắt buộc
    validateField(
      productImageInput,
      productImageError,
      imageFile !== undefined
    );
  } else {
    // Nếu là sửa, ảnh có thể không đổi
    if (imageFile === undefined) {
      // Nếu không chọn ảnh mới, kiểm tra xem ảnh cũ có tồn tại không
      const currentProduct = productsData.find(
        (p) => p.id === productIdToEditInput.value
      );
      if (!currentProduct || !currentProduct.imageUrl) {
        // Nếu không có ảnh cũ, vẫn báo lỗi
        productImageInput.classList.add("is-invalid");
        productImageError.style.display = "block";
        isValid = false;
      } else {
        // Có ảnh cũ và không chọn ảnh mới -> OK
        productImageInput.classList.remove("is-invalid");
        productImageError.style.display = "none";
      }
    } else {
      // Có chọn ảnh mới, validate như bình thường
      productImageInput.classList.remove("is-invalid");
      productImageError.style.display = "none";
    }
  }

  if (!isValid) {
    return;
  }

  const productId = productIdToEditInput.value; // ID của sản phẩm nếu đang sửa
  let newOrUpdatedProduct;

  if (productId) {
    // Nếu có productId, là chế độ SỬA
    const productIndex = productsData.findIndex((p) => p.id === productId);
    if (productIndex !== -1) {
      newOrUpdatedProduct = productsData[productIndex];
      newOrUpdatedProduct.name = name;
      newOrUpdatedProduct.desc = desc;
      newOrUpdatedProduct.price = parseFloat(price);
      newOrUpdatedProduct.category = category;
      newOrUpdatedProduct.brand = brand;
      newOrUpdatedProduct.quantity = parseInt(quantity);
      if (imageFile) {
        // Nếu có chọn ảnh mới
        if (
          newOrUpdatedProduct.imageUrl &&
          newOrUpdatedProduct.imageUrl.startsWith("blob:")
        ) {
          URL.revokeObjectURL(newOrUpdatedProduct.imageUrl); // Giải phóng URL cũ nếu là blob URL
        }
        newOrUpdatedProduct.imageUrl = URL.createObjectURL(imageFile);
        newOrUpdatedProduct.imageFile = imageFile; // Lưu file gốc nếu cần
      }
      // Cập nhật DOM của sản phẩm đã sửa
      const existingCard = document.getElementById(productId);
      if (existingCard) {
        existingCard.querySelector(".product-info .name").textContent = name;
        existingCard.querySelector(
          ".product-info .quantity"
        ).textContent = `SL: ${quantity}`;
        existingCard.querySelector(
          ".product-info .price"
        ).textContent = `Giá: ${parseFloat(price).toLocaleString("vi-VN")}đ`;
        if (imageFile) {
          existingCard.querySelector("img").src = newOrUpdatedProduct.imageUrl;
        }
      }
      successMessageElement.textContent = "Đã cập nhật sản phẩm thành công!"; // Cập nhật nội dung thông báo
    }
  } else {
    // Không có productId, là chế độ THÊM MỚI
    const newId = `product-${nextProductId++}`;
    const imageUrl = URL.createObjectURL(imageFile);
    newOrUpdatedProduct = {
      id: newId,
      name: name,
      desc: desc,
      price: parseFloat(price),
      category: category,
      brand: brand,
      quantity: parseInt(quantity),
      imageUrl: imageUrl,
      imageFile: imageFile, // Lưu file gốc nếu cần
    };
    productsData.unshift(newOrUpdatedProduct); // Thêm vào đầu mảng
    renderProduct(newOrUpdatedProduct); // Render sản phẩm mới lên DOM
    successMessageElement.textContent = "Đã thêm sản phẩm mới thành công!"; // Cập nhật nội dung thông báo
  }

  console.log("Dữ liệu sản phẩm hiện tại:", productsData);

  // Ẩn modal thêm/sửa sản phẩm
  const addProductModalInstance = bootstrap.Modal.getInstance(
    addProductModalElement
  );
  addProductModalInstance.hide();

  // Reset form và ẩn các thông báo lỗi sau khi thành công
  addProductForm.reset();
  document.querySelectorAll(".invalid-feedback").forEach((element) => {
    element.style.display = "none";
  });
  document
    .querySelectorAll(".form-control, .form-select")
    .forEach((element) => {
      element.classList.remove("is-invalid");
    });
  currentProductImage.style.display = "none"; // Ẩn ảnh xem trước

  // Hiển thị modal thành công
  const successModal = new bootstrap.Modal(
    document.getElementById("successModal")
  );
  successModal.show();
});

// Xử lý khi modal thêm/sửa sản phẩm được hiển thị (để reset form hoặc điền dữ liệu)
addProductModalElement.addEventListener("show.bs.modal", function (event) {
  const button = event.relatedTarget; // Nút đã click để mở modal
  // Kiểm tra xem button có tồn tại và có thuộc tính data-id không
  const productId =
    button && button.getAttribute("data-id")
      ? button.getAttribute("data-id")
      : null;

  // Reset form và ẩn tất cả lỗi khi modal mở
  addProductForm.reset();
  document.querySelectorAll(".invalid-feedback").forEach((element) => {
    element.style.display = "none";
  });
  document
    .querySelectorAll(".form-control, .form-select")
    .forEach((element) => {
      element.classList.remove("is-invalid");
    });
  currentProductImage.style.display = "none"; // Ẩn ảnh xem trước

  if (productId) {
    // Chế độ SỬA
    modalTitle.textContent = "Sửa sản phẩm";
    productIdToEditInput.value = productId; // Lưu ID sản phẩm cần sửa
    const product = productsData.find((p) => p.id === productId);

    if (product) {
      document.getElementById("productName").value = product.name;
      document.getElementById("productDesc").value = product.desc;
      document.getElementById("productPrice").value = product.price;
      document.getElementById("productCategory").value = product.category;
      document.getElementById("productBrand").value = product.brand;
      document.getElementById("productQuantity").value = product.quantity;

      if (product.imageUrl) {
        currentProductImage.src = product.imageUrl;
        currentProductImage.style.display = "block";
      } else {
        currentProductImage.style.display = "none";
      }
      productImageInput.value = ""; // Xóa giá trị input file để người dùng có thể chọn file mới
    }
  } else {
    // Chế độ THÊM MỚI
    modalTitle.textContent = "Thêm sản phẩm mới";
    productIdToEditInput.value = ""; // Xóa ID sản phẩm nếu là thêm mới
  }
});

// --- Xử lý Xóa sản phẩm (Modal confirmDeleteModal) ---
const confirmDeleteModalElement = document.getElementById("confirmDeleteModal");
const productIdToDeleteInput = document.getElementById("productIdToDelete");
const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

// Event delegation cho nút xóa (hiệu quả hơn khi có nhiều sản phẩm động)
document
  .getElementById("productList")
  .addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-btn")) {
      event.preventDefault(); // Ngăn hành vi mặc định của thẻ <a>
      const productId = event.target.getAttribute("data-id");
      productIdToDeleteInput.value = productId; // Lưu ID sản phẩm cần xóa
      const confirmModal = new bootstrap.Modal(confirmDeleteModalElement);
      confirmModal.show();
    }
  });

confirmDeleteBtn.addEventListener("click", function () {
  const productId = productIdToDeleteInput.value;
  if (productId) {
    // Xóa khỏi mảng dữ liệu
    const productIndex = productsData.findIndex((p) => p.id === productId);
    if (productIndex !== -1) {
      // Giải phóng Object URL nếu đó là một blob URL từ ảnh mới được thêm
      if (
        productsData[productIndex].imageUrl &&
        productsData[productIndex].imageUrl.startsWith("blob:")
      ) {
        URL.revokeObjectURL(productsData[productIndex].imageUrl);
      }
      productsData.splice(productIndex, 1);
    }

    // Xóa khỏi DOM
    const productCardToRemove = document.getElementById(productId);
    if (productCardToRemove) {
      productCardToRemove.remove();
    }

    console.log("Sản phẩm còn lại:", productsData);

    // Ẩn modal xác nhận xóa
    const confirmModalInstance = bootstrap.Modal.getInstance(
      confirmDeleteModalElement
    );
    confirmModalInstance.hide();
  }
});

// Chạy hàm tải sản phẩm ban đầu khi DOM đã tải xong
document.addEventListener("DOMContentLoaded", () => {
  loadInitialProducts();
  // Không cần attachEventListenersToProductButtons() ở đây lần nữa nếu event delegation đã được thiết lập đúng
  // Hoặc nếu bạn muốn các nút Sửa/Xóa của các sản phẩm mẫu cũng hoạt động ngay, thì vẫn cần.
  // Với event delegation trên productList cho nút delete, bạn không cần gọi lại cho mỗi nút.
  // Đối với nút edit, hàm handleEditProduct được gọi trực tiếp khi modal show.bs.modal,
  // nên cũng không cần gắn listener riêng ở đây.

  // Tuy nhiên, để đảm bảo tính nhất quán và dễ quản lý,
  // chúng ta sẽ gọi lại attachEventListenersToProductButtons() để xử lý các nút 'edit-btn'
  // và 'delete-btn' của các sản phẩm mẫu có sẵn khi tải trang.
  // Đối với các sản phẩm mới thêm, hàm renderProduct() đã gọi lại nó.
  attachEventListenersToProductButtons();
});

// Thêm sự kiện 'input' để ẩn lỗi khi người dùng bắt đầu nhập lại
addProductForm.querySelectorAll("input, textarea, select").forEach((input) => {
  input.addEventListener("input", function () {
    if (this.classList.contains("is-invalid")) {
      this.classList.remove("is-invalid");
      const errorId = this.id + "Error";
      const errorElement = document.getElementById(errorId);
      if (errorElement) {
        errorElement.style.display = "none";
      }
    }
  });
});
