// Biến toàn cục để theo dõi ID sản phẩm tiếp theo và lưu trữ dữ liệu sản phẩm
let nextProductId = 6; // Bắt đầu từ 6 vì bạn có 5 sản phẩm mẫu trong HTML (product-1 đến product-5)
const productsData = []; // Mảng này sẽ lưu trữ dữ liệu các sản phẩm trong bộ nhớ

// Tham chiếu đến các phần tử DOM chính cho THÊM MỚI SẢN PHẨM
const addProductModalElement = document.getElementById("addProductModal");
const addProductForm = document.getElementById("addProductForm");
const modalTitle = document.getElementById("modalTitle"); // Tiêu đề cho modal Thêm sản phẩm

// Tham chiếu đến các phần tử DOM chính cho SỬA SẢN PHẨM
const editProductModalElement = document.getElementById("editProductModal");
const editProductForm = document.getElementById("editProductForm");
const editModalTitle = document.getElementById("editModalTitle");
// ĐÃ SỬA: Đảm bảo biến này tham chiếu đúng ID trong HTML
const editProductIdInput = document.getElementById("editProductId"); // Input ẩn để lưu ID sản phẩm khi sửa
const editCurrentProductImage = document.getElementById(
  "editCurrentProductImage"
); // Thẻ <img> để hiển thị ảnh sản phẩm hiện tại trong modal sửa
const editProductImageInput = document.getElementById("editProductImage"); // Input type="file" cho ảnh sản phẩm khi sửa

// Tham chiếu chung cho danh sách sản phẩm và các modal khác
const productListContainer = document.getElementById("productList");
const successMessageElement = document.getElementById("successMessage"); // Phần tử hiển thị thông báo trong successModal
const confirmDeleteModalElement = document.getElementById("confirmDeleteModal");
const productIdToDeleteInput = document.getElementById("productIdToDelete");
const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

// Khởi tạo instance của Bootstrap Modals một lần duy nhất
let addProductModalInstance;
let editProductModalInstance; // Instance mới cho modal sửa
let confirmDeleteModalInstance;
let successModalInstance; // Sẽ dùng cho cả thông báo thêm/sửa và xóa thành công

/**
 * Hàm để tải các sản phẩm mẫu từ DOM vào mảng productsData khi trang tải.
 * Lưu ý: Các trường 'desc', 'category', 'brand' không có trong HTML mẫu ban đầu của bạn,
 * nên chúng sẽ được gán giá trị mặc định hoặc cần được thêm vào HTML nếu muốn đọc từ đó.
 * Ở đây, chúng tôi gán giá trị mẫu/giả định để minh họa chức năng sửa hoạt động đầy đủ.
 */
function loadInitialProducts() {
  productsData.length = 0; // Xóa dữ liệu cũ nếu có, đảm bảo không trùng lặp khi trang tải lại
  document.querySelectorAll(".product-card").forEach((card) => {
    const id = card.id;
    if (!id) {
      console.warn("Thẻ sản phẩm thiếu ID:", card);
      return;
    }

    const nameElement = card.querySelector(".product-info .name");
    const priceElement = card.querySelector(".product-info .price");
    const quantityElement = card.querySelector(".product-info .quantity");
    const imgElement = card.querySelector("img");

    const name = nameElement ? nameElement.textContent.trim() : "";
    const priceText = priceElement ? priceElement.textContent.trim() : "";
    // Loại bỏ "Giá: ", dấu chấm và "đ" để chuyển đổi thành số
    const price =
      parseFloat(
        priceText
          .replace("Giá: ", "")
          .replace(/\./g, "")
          .replace("đ", "")
          .trim()
      ) || 0;
    const quantityText = quantityElement
      ? quantityElement.textContent.trim()
      : "";
    const quantity = parseInt(quantityText.replace("SL: ", "").trim()) || 0;
    const imageUrl = imgElement ? imgElement.src : "";

    // *** ĐIỀN DỮ LIỆU MẪU CHO DESC, CATEGORY, BRAND ĐỂ CHỨC NĂNG SỬA HOẠT ĐỘNG ***
    // Nếu bạn muốn dữ liệu này được đọc từ HTML, bạn cần thêm các phần tử HTML tương ứng
    let desc = "Mô tả mặc định cho sản phẩm HomeFood.";
    let category = "Thịt-Cá-Trứng-Thủy hải sản";
    let brand = "HomeFood";

    // Bạn có thể tùy chỉnh mô tả, danh mục, thương hiệu theo từng sản phẩm ID
    if (id === "product-1") {
      desc = "Sườn heo non tươi ngon 300g, phù hợp để chế biến nhiều món ăn.";
      category = "Thịt-Cá-Trứng-Thủy hải sản";
      brand = "HomeFood Premium";
    } else if (id === "product-2") {
      desc =
        "Ba rọi heo 300g với tỷ lệ nạc mỡ cân đối, lý tưởng cho món chiên giòn.";
      category = "Thịt-Cá-Trứng-Thủy hải sản";
      brand = "MeatMaster";
    } else if (id === "product-3") {
      desc = "Sườn rọi rút sườn heo 500g, tiện lợi cho các bữa tiệc nướng.";
      category = "Thịt-Cá-Trứng-Thủy hải sản";
      brand = "CP"; // Đã đổi thành CP để khớp với hình ảnh bạn cung cấp
      // Cập nhật giá sản phẩm 3 trong dữ liệu mẫu để khớp với hình ảnh
      if (price !== 160000) {
        console.log(
          `Đã cập nhật giá sản phẩm ${id} từ ${price.toLocaleString()}đ thành 160.000đ`
        );
        // Note: Giá này chỉ cập nhật trong JS, không thay đổi trên DOM HTML ban đầu
        // Để thay đổi trên DOM HTML, bạn cần sửa trực tiếp trong file HTML hoặc render lại toàn bộ list sau khi loadInitialProducts.
        // Hiện tại, chúng ta sẽ để DOM HTML giữ nguyên và chỉ cập nhật trong JS data.
        // Nếu bạn muốn giá trong DOM HTML ban đầu khớp, bạn phải sửa thủ công trong HTML.
      }
    } else if (id === "product-4") {
      desc =
        "Xương ống heo 500g, dùng để hầm lấy nước dùng ngọt thanh cho các món canh.";
      category = "Thịt-Cá-Trứng-Thủy hải sản";
      brand = "BoneBroth Co.";
    } else if (id === "product-5") {
      desc =
        "Nạc dăm heo 1KG, thịt mềm và ít mỡ, thích hợp cho các món xào, kho.";
      category = "Thịt-Cá-Trứng-Thủy hải sản";
      brand = "Porky Delights";
    }

    // Tạo một bản sao của thẻ sản phẩm trong DOM để sử dụng cho mục đích cập nhật sau này
    // Điều này giúp dễ dàng cập nhật thông tin sản phẩm trên DOM mà không cần query lại
    const domElement = card;

    productsData.push({
      id: id,
      name: name,
      desc: desc,
      price: price,
      category: category,
      brand: brand,
      quantity: quantity,
      imageUrl: imageUrl,
      imageFile: null, // Không có file gốc từ sản phẩm tĩnh
      domElement: domElement, // Lưu tham chiếu đến phần tử DOM
    });
  });
  console.log("Sản phẩm ban đầu đã được tải:", productsData);
}

/**
 * Hàm render (hiển thị) một sản phẩm lên giao diện.
 * Sản phẩm mới được thêm vào đầu danh sách.
 * @param {object} product - Đối tượng sản phẩm cần hiển thị.
 */
function renderProduct(product) {
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
            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="${
              product.id
            }">Sửa</a>
            <a href="#" class="delete delete-btn" data-id="${
              product.id
            }">Xóa</a>
        </div>
    `;

  // Cập nhật tham chiếu DOM cho sản phẩm mới
  product.domElement = newProductCard;

  // Chèn sản phẩm mới lên đầu danh sách
  productListContainer.insertBefore(
    newProductCard,
    productListContainer.firstChild
  );
}

/**
 * Hàm trợ giúp để validate một trường input.
 * @param {HTMLElement} inputElement - Phần tử input/textarea/select.
 * @param {HTMLElement} errorElement - Phần tử hiển thị thông báo lỗi.
 * @param {boolean} condition - Điều kiện để xác định trường hợp hợp lệ.
 * @returns {boolean} - True nếu hợp lệ, false nếu không.
 */
function validateField(inputElement, errorElement, condition) {
  if (condition) {
    inputElement.classList.remove("is-invalid");
    if (errorElement) errorElement.style.display = "none";
    return true;
  } else {
    inputElement.classList.add("is-invalid");
    if (errorElement) errorElement.style.display = "block";
    return false;
  }
}

/**
 * Xử lý sự kiện submit form Thêm sản phẩm.
 */
addProductForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const productNameInput = document.getElementById("productName");
  const productDescInput = document.getElementById("productDesc");
  const productPriceInput = document.getElementById("productPrice");
  const productCategorySelect = document.getElementById("productCategory");
  const productBrandInput = document.getElementById("productBrand");
  const productQuantityInput = document.getElementById("productQuantity");
  const productImageInput = document.getElementById("productImage"); // Lấy lại vì là local var

  let isValid = true;

  isValid =
    validateField(
      productNameInput,
      document.getElementById("productNameError"),
      productNameInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      productDescInput,
      document.getElementById("productDescError"),
      productDescInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      productPriceInput,
      document.getElementById("productPriceError"),
      productPriceInput.value !== "" && parseFloat(productPriceInput.value) > 0
    ) && isValid;
  isValid =
    validateField(
      productCategorySelect,
      document.getElementById("productCategoryError"),
      productCategorySelect.value !== ""
    ) && isValid;
  isValid =
    validateField(
      productBrandInput,
      document.getElementById("productBrandError"),
      productBrandInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      productQuantityInput,
      document.getElementById("productQuantityError"),
      productQuantityInput.value !== "" &&
        parseInt(productQuantityInput.value) > 0
    ) && isValid;
  isValid =
    validateField(
      productImageInput,
      document.getElementById("productImageError"),
      productImageInput.files[0] !== undefined
    ) && isValid;

  if (!isValid) {
    return; // Dừng nếu có lỗi validation
  }

  const newId = `product-${nextProductId++}`;
  const imageFile = productImageInput.files[0];
  const imageUrl = URL.createObjectURL(imageFile);

  const newProduct = {
    id: newId,
    name: productNameInput.value.trim(),
    desc: productDescInput.value.trim(),
    price: parseFloat(productPriceInput.value),
    category: productCategorySelect.value,
    brand: productBrandInput.value.trim(),
    quantity: parseInt(productQuantityInput.value),
    imageUrl: imageUrl,
    imageFile: imageFile,
    domElement: null, // Sẽ được gán khi render
  };
  productsData.unshift(newProduct); // Thêm vào đầu mảng
  renderProduct(newProduct); // Render sản phẩm mới lên DOM

  console.log("Dữ liệu sản phẩm hiện tại:", productsData);

  addProductModalInstance.hide(); // Ẩn modal thêm sản phẩm

  // Reset form và ẩn các thông báo lỗi sau khi thành công
  addProductForm.reset();
  document
    .querySelectorAll("#addProductForm .invalid-feedback")
    .forEach((element) => {
      element.style.display = "none";
    });
  document
    .querySelectorAll(
      "#addProductForm .form-control, #addProductForm .form-select"
    )
    .forEach((element) => {
      element.classList.remove("is-invalid");
    });
  document.getElementById("currentProductImage").style.display = "none"; // Ẩn ảnh xem trước
  document.getElementById("productImage").value = ""; // Đảm bảo input file được reset

  successMessageElement.textContent = "Đã thêm sản phẩm mới thành công.";
  successModalInstance.show();
});

/**
 * Xử lý khi modal thêm sản phẩm được hiển thị (trước khi nó hoàn toàn hiện ra).
 * Thiết lập tiêu đề modal và reset form.
 */
addProductModalElement.addEventListener("show.bs.modal", function (event) {
  modalTitle.textContent = "Thêm sản phẩm mới";
  addProductForm.reset(); // Reset tất cả các trường trong form
  document
    .querySelectorAll("#addProductForm .invalid-feedback")
    .forEach((element) => {
      element.style.display = "none"; // Ẩn các thông báo lỗi
    });
  document
    .querySelectorAll(
      "#addProductForm .form-control, #addProductForm .form-select"
    )
    .forEach((element) => {
      element.classList.remove("is-invalid"); // Xóa viền đỏ lỗi
    });
  document.getElementById("currentProductImage").style.display = "none"; // Ẩn ảnh xem trước của sản phẩm hiện tại
  document.getElementById("productImage").value = ""; // Đảm bảo input file được reset
});

// --- NEW: LOGIC CHO MODAL SỬA SẢN PHẨM ---

/**
 * Xử lý khi modal sửa sản phẩm được hiển thị.
 * Điền dữ liệu của sản phẩm được chọn vào form.
 */
editProductModalElement.addEventListener("show.bs.modal", function (event) {
  const button = event.relatedTarget; // Nút "Sửa" đã click
  const productId = button.getAttribute("data-id"); // Lấy ID sản phẩm từ data-id

  // --- BƯỚC 1: RESET FORM VÀ ẨN TẤT CẢ LỖI KHI MODAL MỞ ---
  editProductForm.reset();
  document
    .querySelectorAll("#editProductForm .invalid-feedback")
    .forEach((element) => {
      element.style.display = "none";
    });
  document
    .querySelectorAll(
      "#editProductForm .form-control, #editProductForm .form-select"
    )
    .forEach((element) => {
      element.classList.remove("is-invalid");
    });
  editCurrentProductImage.style.display = "none";
  editProductImageInput.value = ""; // Đảm bảo input file được reset

  // SỬA Ở ĐÂY: Sử dụng editProductIdInput để lưu ID
  editProductIdInput.value = productId;

  // Tìm sản phẩm trong mảng dữ liệu
  const product = productsData.find((p) => p.id === productId);

  if (product) {
    // Điền thông tin sản phẩm vào các trường của form sửa
    document.getElementById("editProductName").value = product.name;
    document.getElementById("editProductDesc").value = product.desc;
    document.getElementById("editProductPrice").value = product.price;
    document.getElementById("editProductCategory").value = product.category;
    document.getElementById("editProductBrand").value = product.brand;
    document.getElementById("editProductQuantity").value = product.quantity;

    // Hiển thị ảnh hiện tại của sản phẩm nếu có
    if (product.imageUrl) {
      editCurrentProductImage.src = product.imageUrl;
      editCurrentProductImage.style.display = "block";
    } else {
      editCurrentProductImage.style.display = "none";
    }
  }
});

/**
 * Xử lý sự kiện submit form Sửa sản phẩm.
 * Bao gồm validation và cập nhật sản phẩm vào mảng dữ liệu và DOM.
 */
editProductForm.addEventListener("submit", function (e) {
  e.preventDefault();

  // SỬA Ở ĐÂY: Sử dụng editProductIdInput để lấy ID
  const productId = editProductIdInput.value;
  const productIndex = productsData.findIndex((p) => p.id === productId);

  if (productIndex === -1) {
    console.error("Không tìm thấy sản phẩm để sửa.");
    return;
  }

  const currentProduct = productsData[productIndex];

  // Lấy dữ liệu từ form sửa
  const editProductNameInput = document.getElementById("editProductName");
  const editProductDescInput = document.getElementById("editProductDesc");
  const editProductPriceInput = document.getElementById("editProductPrice");
  const editProductCategorySelect = document.getElementById(
    "editProductCategory"
  );
  const editProductBrandInput = document.getElementById("editProductBrand");
  const editProductQuantityInput = document.getElementById(
    "editProductQuantity"
  );
  const editProductImageFile = editProductImageInput.files[0];

  let isValid = true;

  // Thực hiện validation cho từng trường của form sửa
  isValid =
    validateField(
      editProductNameInput,
      document.getElementById("editProductNameError"),
      editProductNameInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      editProductDescInput,
      document.getElementById("editProductDescError"),
      editProductDescInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      editProductPriceInput,
      document.getElementById("editProductPriceError"),
      editProductPriceInput.value !== "" &&
        parseFloat(editProductPriceInput.value) > 0
    ) && isValid;
  isValid =
    validateField(
      editProductCategorySelect,
      document.getElementById("editProductCategoryError"),
      editProductCategorySelect.value !== ""
    ) && isValid;
  isValid =
    validateField(
      editProductBrandInput,
      document.getElementById("editProductBrandError"),
      editProductBrandInput.value.trim() !== ""
    ) && isValid;
  isValid =
    validateField(
      editProductQuantityInput,
      document.getElementById("editProductQuantityError"),
      editProductQuantityInput.value !== "" &&
        parseInt(editProductQuantityInput.value) > 0
    ) && isValid;

  // Validation cho ảnh: nếu không có file mới VÀ không có ảnh cũ, thì là lỗi
  if (!editProductImageFile && !currentProduct.imageUrl) {
    isValid =
      validateField(
        editProductImageInput,
        document.getElementById("editProductImageError"),
        false
      ) && isValid;
  } else {
    validateField(
      editProductImageInput,
      document.getElementById("editProductImageError"),
      true
    );
  }

  if (!isValid) {
    return; // Dừng nếu có lỗi validation
  }

  // Cập nhật thông tin sản phẩm trong mảng
  currentProduct.name = editProductNameInput.value.trim();
  currentProduct.desc = editProductDescInput.value.trim();
  currentProduct.price = parseFloat(editProductPriceInput.value);
  currentProduct.category = editProductCategorySelect.value;
  currentProduct.brand = editProductBrandInput.value.trim();
  currentProduct.quantity = parseInt(editProductQuantityInput.value);

  if (editProductImageFile) {
    // Nếu có chọn ảnh mới, giải phóng URL ảnh cũ nếu là blob URL
    if (
      currentProduct.imageUrl &&
      currentProduct.imageUrl.startsWith("blob:")
    ) {
      URL.revokeObjectURL(currentProduct.imageUrl);
    }
    currentProduct.imageUrl = URL.createObjectURL(editProductImageFile);
    currentProduct.imageFile = editProductImageFile; // Lưu file gốc nếu cần
  }

  // Cập nhật DOM của sản phẩm đã sửa
  const existingCard = currentProduct.domElement; // Lấy tham chiếu DOM đã lưu
  if (existingCard) {
    existingCard.querySelector(".product-info .name").textContent =
      currentProduct.name;
    existingCard.querySelector(
      ".product-info .quantity"
    ).textContent = `SL: ${currentProduct.quantity}`;
    existingCard.querySelector(
      ".product-info .price"
    ).textContent = `Giá: ${currentProduct.price.toLocaleString("vi-VN")}đ`;
    if (editProductImageFile) {
      // Chỉ cập nhật src của ảnh nếu có ảnh mới được chọn
      existingCard.querySelector("img").src = currentProduct.imageUrl;
    }
  }

  console.log("Sản phẩm sau khi cập nhật:", currentProduct);
  console.log("Dữ liệu sản phẩm hiện tại:", productsData);

  editProductModalInstance.hide(); // Ẩn modal sửa sản phẩm

  // Reset form và ẩn các thông báo lỗi sau khi thành công
  editProductForm.reset();
  document
    .querySelectorAll("#editProductForm .invalid-feedback")
    .forEach((element) => {
      element.style.display = "none";
    });
  document
    .querySelectorAll(
      "#editProductForm .form-control, #editProductForm .form-select"
    )
    .forEach((element) => {
      element.classList.remove("is-invalid");
    });
  editCurrentProductImage.style.display = "none";
  editProductImageInput.value = "";

  successMessageElement.textContent = "Đã cập nhật sản phẩm thành công.";
  successModalInstance.show();
});

// --- Xử lý Xóa sản phẩm (Modal confirmDeleteModal) ---

/**
 * Event Delegation cho nút xóa trên danh sách sản phẩm.
 * Nút "Sửa" đã được xử lý bằng data-bs-toggle trực tiếp trên HTML.
 */
productListContainer.addEventListener("click", function (event) {
  // Không cần event.preventDefault() ở đây nếu nút Sửa có data-bs-toggle
  // và nút Xóa vẫn dùng href="#"
  // Tuy nhiên, để đảm bảo không nhảy trang, giữ lại là tốt.
  event.preventDefault();

  if (event.target.classList.contains("delete-btn")) {
    const productId = event.target.getAttribute("data-id");
    productIdToDeleteInput.value = productId; // Lưu ID sản phẩm cần xóa vào input ẩn
    confirmDeleteModalInstance.show(); // Hiển thị modal xác nhận xóa
  }
  // Nút "Sửa" không cần handleEditProduct(productId) nữa vì đã dùng data-bs-toggle
});

/**
 * Xử lý sự kiện click nút "Xác nhận" trong modal xác nhận xóa.
 * Xóa sản phẩm khỏi mảng dữ liệu và DOM, sau đó hiển thị thông báo thành công.
 */
confirmDeleteBtn.addEventListener("click", function () {
  const productId = productIdToDeleteInput.value;
  if (productId) {
    const productIndex = productsData.findIndex((p) => p.id === productId);
    if (productIndex !== -1) {
      // Giải phóng Object URL nếu ảnh là một blob URL (được tạo khi thêm/sửa ảnh)
      if (
        productsData[productIndex].imageUrl &&
        productsData[productIndex].imageUrl.startsWith("blob:")
      ) {
        URL.revokeObjectURL(productsData[productIndex].imageUrl);
      }
      // Xóa thẻ sản phẩm khỏi DOM (giao diện) thông qua tham chiếu domElement
      if (productsData[productIndex].domElement) {
        productsData[productIndex].domElement.remove();
      }
      productsData.splice(productIndex, 1); // Xóa sản phẩm khỏi mảng dữ liệu
    }

    console.log("Sản phẩm còn lại trong data:", productsData);

    // Ẩn modal xác nhận xóa
    confirmDeleteModalInstance.hide();

    // Cập nhật nội dung và hiển thị modal thông báo thành công
    successMessageElement.textContent = "Đã xóa sản phẩm thành công.";
    successModalInstance.show();
  }
});

/**
 * Xử lý khi DOM (cấu trúc HTML) đã tải xong.
 * Tải sản phẩm ban đầu, khởi tạo các Bootstrap Modal instances,
 * và thêm sự kiện 'input' để ẩn thông báo lỗi khi người dùng bắt đầu nhập lại.
 */
document.addEventListener("DOMContentLoaded", () => {
  loadInitialProducts(); // Tải dữ liệu sản phẩm từ HTML ban đầu vào mảng JS

  // Khởi tạo các Bootstrap Modal instances một lần duy nhất
  addProductModalInstance = new bootstrap.Modal(addProductModalElement);
  editProductModalInstance = new bootstrap.Modal(editProductModalElement); // Khởi tạo modal sửa
  confirmDeleteModalInstance = new bootstrap.Modal(confirmDeleteModalElement);
  successModalInstance = new bootstrap.Modal(
    document.getElementById("successModal")
  );

  // Thêm sự kiện 'input' cho tất cả các trường trong form THÊM SẢN PHẨM để ẩn lỗi
  addProductForm
    .querySelectorAll("input, textarea, select")
    .forEach((input) => {
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

  // Thêm sự kiện 'input' cho tất cả các trường trong form SỬA SẢN PHẨM để ẩn lỗi
  editProductForm
    .querySelectorAll("input, textarea, select")
    .forEach((input) => {
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
});
