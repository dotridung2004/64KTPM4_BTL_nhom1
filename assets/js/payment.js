document.addEventListener("DOMContentLoaded", function () {
  const paymentProductItems = document.getElementById("payment-product-items");
  const finalTotalPriceSpan = document.getElementById("final-total-price");
  const placeOrderBtn = document.getElementById("place-order-btn");

  const paymentMethodsSelection = document.getElementById(
    "payment-methods-selection"
  );
  const momoQrDisplay = document.getElementById("momo-qr-display");
  const otpVerificationDisplay = document.getElementById(
    "otp-verification-display"
  );
  const fingerprintScanDisplay = document.getElementById(
    "fingerprint-scan-display"
  );

  // Renamed for clarity: this shows general bank transfer info (e.g., account number, QR)
  const bankTransferInfoDisplay = document.getElementById(
    "bank-transfer-details-display"
  );
  // Renamed for clarity: this is the form for entering card details
  const bankCardFormDisplay = document.getElementById(
    "bank-transfer-form-display"
  ); // KEEP THE ORIGINAL ID FROM YOUR HTML SNIPPET

  // --- LOGGING: Check if HTML elements are found ---
  console.log("paymentMethodsSelection:", paymentMethodsSelection);
  console.log("momoQrDisplay:", momoQrDisplay);
  console.log("otpVerificationDisplay:", otpVerificationDisplay);
  console.log("fingerprintScanDisplay:", fingerprintScanDisplay);
  console.log("bankTransferInfoDisplay:", bankTransferInfoDisplay);
  console.log("bankCardFormDisplay:", bankCardFormDisplay);

  const paymentRadios = document.querySelectorAll(
    'input[name="paymentMethod"]'
  );
  const backToPaymentMethodsBtn = document.getElementById(
    "back-to-payment-methods"
  );

  const cancelOtpBtn = document.getElementById("cancel-otp-btn");
  const confirmOtpBtn = document.getElementById("confirm-otp-btn");
  const resendOtpBtn = document.getElementById("resend-otp-btn");
  const otpCountdownSpan = document.getElementById("otp-countdown");
  const otpInputs = document.querySelectorAll(".otp-input");

  const cancelFingerprintBtn = document.getElementById(
    "cancel-fingerprint-btn"
  );

  // Elements from the bank card form
  const cancelBankPaymentBtn = document.getElementById(
    "cancel-bank-payment-btn"
  );
  const continueBankPaymentBtn = document.getElementById(
    "continue-bank-payment-btn"
  );
  const bankSelect = document.getElementById("bank-select");
  const cardNumber = document.getElementById("card-number");
  const cardHolderName = document.getElementById("card-holder-name");
  const cardPhone = document.getElementById("card-phone");
  const expiryDate = document.getElementById("expiry-date");

  // Error message elements for bank card form
  const bankSelectError = document.getElementById("bank-select-error");
  const cardNumberError = document.getElementById("card-number-error");
  const cardHolderNameError = document.getElementById("card-holder-name-error");
  const cardPhoneError = document.getElementById("card-phone-error");
  const expiryDateError = document.getElementById("expiry-date-error");

  // Buttons and spans for the bank transfer information section (if you have one)
  const backFromBankInfoBtn = document.getElementById(
    "back-from-bank-details-btn"
  ); // Renamed for consistency
  const proceedToCardInputBtn = document.getElementById(
    "proceed-to-card-input-btn"
  );
  console.log("proceedToCardInputBtn:", proceedToCardInputBtn); // LOGGING

  const bankDetailsTotalPriceSpan = document.getElementById(
    "bank-details-total-price"
  );
  const orderIdPlaceholder = document.getElementById("order-id-placeholder");

  // Initialize orderSuccessModal
  let orderSuccessModal;
  const orderSuccessModalElement = document.getElementById("orderSuccessModal");
  if (orderSuccessModalElement) {
    orderSuccessModal = new bootstrap.Modal(orderSuccessModalElement);
  } else {
    console.error(
      "Lỗi: Không tìm thấy phần tử 'orderSuccessModal' trong HTML. Modal này sẽ không hoạt động."
    );
  }

  const orderSuccessConfirmBtn = document.getElementById(
    "orderSuccessConfirmBtn"
  );

  let selectedCartItems = [];
  let isMomoQrVisible = false;
  let isOtpVerificationVisible = false;
  let isFingerprintScanVisible = false;
  let isBankTransferInfoVisible = false; // New state for general bank transfer info
  let isBankCardFormVisible = false; // New state for bank card input form

  let originalPlaceOrderBtnText = placeOrderBtn.textContent;
  let originalPlaceOrderBtnClass = placeOrderBtn.className;

  let otpTimerInterval;

  // --- Function to manage OTP countdown ---
  function startOtpCountdown(duration) {
    let timer = duration;
    otpCountdownSpan.textContent = "00:" + String(timer).padStart(2, "0");

    clearInterval(otpTimerInterval);

    otpTimerInterval = setInterval(() => {
      timer--;
      otpCountdownSpan.textContent = "00:" + String(timer).padStart(2, "0");

      if (timer <= 0) {
        clearInterval(otpTimerInterval);
        otpCountdownSpan.textContent = "Hết hạn";
        if (resendOtpBtn) resendOtpBtn.disabled = false;
        alert("Mã OTP đã hết hạn. Vui lòng yêu cầu gửi lại mã mới.");
      }
    }, 1000);
  }

  // --- Function to reset the interface to initial state (payment method selection) ---
  function resetPaymentMethodDisplay() {
    console.log("resetPaymentMethodDisplay() called.");
    paymentMethodsSelection.style.display = "block";
    momoQrDisplay.style.display = "none";
    otpVerificationDisplay.style.display = "none";
    fingerprintScanDisplay.style.display = "none";
    // Ensure both bank transfer sections are hidden
    if (bankTransferInfoDisplay) bankTransferInfoDisplay.style.display = "none";
    if (bankCardFormDisplay) bankCardFormDisplay.style.display = "none";

    placeOrderBtn.style.display = "block";
    placeOrderBtn.textContent = originalPlaceOrderBtnText;
    placeOrderBtn.className = originalPlaceOrderBtnClass;
    isMomoQrVisible = false;
    isOtpVerificationVisible = false;
    isFingerprintScanVisible = false;
    isBankTransferInfoVisible = false;
    isBankCardFormVisible = false;
    clearInterval(otpTimerInterval);
    otpInputs.forEach((input) => (input.value = ""));
    clearBankFormInputs();
    clearBankFormErrors(); // Clear errors when resetting
  }

  // Clear bank card form inputs
  function clearBankFormInputs() {
    if (bankSelect) bankSelect.value = "MB Bank"; // Reset to default option
    if (cardNumber) cardNumber.value = "";
    if (cardHolderName) cardHolderName.value = "";
    if (cardPhone) cardPhone.value = "";
    if (expiryDate) expiryDate.value = "";
  }

  // Clear bank card form validation errors
  function clearBankFormErrors() {
    [bankSelect, cardNumber, cardHolderName, cardPhone, expiryDate].forEach(
      (input) => {
        if (input) {
          input.classList.remove("is-invalid");
        }
      }
    );
    [
      bankSelectError,
      cardNumberError,
      cardHolderNameError,
      cardPhoneError,
      expiryDateError,
    ].forEach((errorElem) => {
      if (errorElem) {
        errorElem.textContent = "";
      }
    });
  }

  // --- Function to display OTP screen and hide others ---
  function showOtpVerification() {
    console.log("showOtpVerification() called.");
    paymentMethodsSelection.style.display = "none";
    momoQrDisplay.style.display = "none";
    otpVerificationDisplay.style.display = "block";
    fingerprintScanDisplay.style.display = "none";
    if (bankTransferInfoDisplay) bankTransferInfoDisplay.style.display = "none";
    if (bankCardFormDisplay) bankCardFormDisplay.style.display = "none";
    placeOrderBtn.style.display = "none";
    isOtpVerificationVisible = true;
    startOtpCountdown(30);
    if (otpInputs[0]) otpInputs[0].focus();
  }

  // --- Function to display fingerprint scan screen ---
  function showFingerprintScan() {
    console.log("showFingerprintScan() called.");
    paymentMethodsSelection.style.display = "none";
    momoQrDisplay.style.display = "none";
    otpVerificationDisplay.style.display = "none";
    fingerprintScanDisplay.style.display = "block";
    if (bankTransferInfoDisplay) bankTransferInfoDisplay.style.display = "none";
    if (bankCardFormDisplay) bankCardFormDisplay.style.display = "none";
    placeOrderBtn.style.display = "none";
    isFingerprintScanVisible = true;

    // Simulate fingerprint scan success
    setTimeout(() => {
      if (isFingerprintScanVisible && orderSuccessModal) {
        localStorage.removeItem("selectedItemsForPayment");
        orderSuccessModal.show();
        if (orderSuccessConfirmBtn) {
          orderSuccessConfirmBtn.onclick = function () {
            orderSuccessModal.hide();
            window.location.href = "../index.php";
          };
        }
      }
    }, 3000);
  }

  // --- Function to display the general bank transfer information (NEW) ---
  function showBankTransferInfo() {
    console.log("showBankTransferInfo() called.");
    paymentMethodsSelection.style.display = "none";
    momoQrDisplay.style.display = "none";
    otpVerificationDisplay.style.display = "none";
    fingerprintScanDisplay.style.display = "none";
    if (bankCardFormDisplay) bankCardFormDisplay.style.display = "none";
    if (bankTransferInfoDisplay)
      bankTransferInfoDisplay.style.display = "block";
    placeOrderBtn.style.display = "none";
    isBankTransferInfoVisible = true;

    // Update total price and generate order ID on this screen
    if (bankDetailsTotalPriceSpan && finalTotalPriceSpan) {
      bankDetailsTotalPriceSpan.textContent = finalTotalPriceSpan.textContent;
    }
    if (orderIdPlaceholder) {
      orderIdPlaceholder.textContent = Math.floor(
        100000 + Math.random() * 900000
      ); // Dummy order ID
    }
  }

  // --- Function to display the bank card input form (MODIFIED) ---
  function showBankCardForm() {
    console.log("showBankCardForm() called.");
    paymentMethodsSelection.style.display = "none";
    momoQrDisplay.style.display = "none";
    otpVerificationDisplay.style.display = "none";
    fingerprintScanDisplay.style.display = "none";
    if (bankTransferInfoDisplay) bankTransferInfoDisplay.style.display = "none"; // Hide general info when showing form
    if (bankCardFormDisplay) bankCardFormDisplay.style.display = "block"; // Show the card input form
    placeOrderBtn.style.display = "none";
    isBankCardFormVisible = true;
    clearBankFormErrors(); // Clear previous errors when showing the form
  }

  // --- Client-side validation for bank card form ---
  function validateBankCardForm() {
    let isValid = true;
    clearBankFormErrors(); // Clear previous errors

    // Validate Bank Select
    if (!bankSelect || bankSelect.value === "") {
      if (bankSelect) bankSelect.classList.add("is-invalid");
      if (bankSelectError)
        bankSelectError.textContent = "Vui lòng chọn ngân hàng.";
      isValid = false;
    }

    // Validate Card Number
    const cardNum = cardNumber ? cardNumber.value.replace(/\s/g, "") : "";
    if (!cardNumber || !/^\d{16}$/.test(cardNum)) {
      if (cardNumber) cardNumber.classList.add("is-invalid");
      if (cardNumberError)
        cardNumberError.textContent = "Số thẻ không hợp lệ (16 chữ số).";
      isValid = false;
    }

    // Validate Card Holder Name
    const holderName = cardHolderName ? cardHolderName.value.trim() : "";
    if (!cardHolderName || holderName === "") {
      if (cardHolderName) cardHolderName.classList.add("is-invalid");
      if (cardHolderNameError)
        cardHolderNameError.textContent = "Vui lòng nhập tên chủ thẻ.";
      isValid = false;
    } else if (!/^[A-Z\s]+$/.test(holderName)) {
      // Basic check for uppercase letters and spaces
      if (cardHolderName) cardHolderName.classList.add("is-invalid");
      if (cardHolderNameError)
        cardHolderNameError.textContent =
          "Tên chủ thẻ chỉ chứa chữ in hoa và khoảng trắng.";
      isValid = false;
    }

    // Validate Phone Number
    const phone = cardPhone ? cardPhone.value.trim() : "";
    if (!cardPhone || !/^\d{10}$/.test(phone)) {
      if (cardPhone) cardPhone.classList.add("is-invalid");
      if (cardPhoneError)
        cardPhoneError.textContent = "Số điện thoại không hợp lệ (10 chữ số).";
      isValid = false;
    }

    // Validate Expiry Date MM/YYYY
    const expiry = expiryDate ? expiryDate.value.trim() : "";
    if (!expiryDate || !/^(0[1-9]|1[0-2])\/\d{4}$/.test(expiry)) {
      if (expiryDate) expiryDate.classList.add("is-invalid");
      if (expiryDateError)
        expiryDateError.textContent = "Ngày hết hạn không hợp lệ (MM/YYYY).";
      isValid = false;
    } else {
      const [month, year] = expiry.split("/").map(Number);
      const currentYear = new Date().getFullYear();
      const currentMonth = new Date().getMonth() + 1; // getMonth() returns 0-11
      if (
        year < currentYear ||
        (year === currentYear && month < currentMonth)
      ) {
        if (expiryDate) expiryDate.classList.add("is-invalid");
        if (expiryDateError)
          expiryDateError.textContent = "Ngày hết hạn đã qua.";
        isValid = false;
      }
    }

    return isValid;
  }

  // --- Event listeners for payment method radio buttons ---
  paymentRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      resetPaymentMethodDisplay();
    });
  });

  // --- Event listener for "Back to Payment Methods" button from QR screen ---
  if (backToPaymentMethodsBtn) {
    backToPaymentMethodsBtn.addEventListener("click", function () {
      document.getElementById("cod").checked = true; // Select COD as default
      resetPaymentMethodDisplay();
    });
  }

  // --- Event listeners for buttons on OTP screen ---
  if (cancelOtpBtn) {
    cancelOtpBtn.addEventListener("click", function () {
      alert("Đã hủy xác thực OTP. Vui lòng thử lại.");
      document.getElementById("cod").checked = true; // Select COD as default
      resetPaymentMethodDisplay();
    });
  }

  if (confirmOtpBtn) {
    confirmOtpBtn.addEventListener("click", function () {
      let otpCode = "";
      otpInputs.forEach((input) => (otpCode += input.value));

      // Basic OTP validation: assuming "123456" is the correct OTP for demo
      if (otpCode === "123456") {
        alert("Mã OTP chính xác. Chuyển sang xác thực vân tay.");
        showFingerprintScan();
      } else {
        alert("Mã OTP không hợp lệ. Vui lòng thử lại.");
        otpInputs.forEach((input) => (input.value = ""));
        if (otpInputs[0]) otpInputs[0].focus();
      }
    });
  }

  if (resendOtpBtn) {
    resendOtpBtn.addEventListener("click", function () {
      alert("Đã gửi lại mã OTP mới.");
      startOtpCountdown(30);
      resendOtpBtn.disabled = true;
      otpInputs.forEach((input) => (input.value = ""));
      if (otpInputs[0]) otpInputs[0].focus();
    });
  }

  // Move focus between OTP input fields
  otpInputs.forEach((input, index) => {
    input.addEventListener("keyup", function (event) {
      if (event.key === "Backspace" && input.value === "") {
        if (index > 0) {
          otpInputs[index - 1].focus();
        }
      } else if (input.value.length === input.maxLength) {
        if (index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        }
      }
    });
  });

  // --- Event listener for "Cancel" button on fingerprint screen ---
  if (cancelFingerprintBtn) {
    cancelFingerprintBtn.addEventListener("click", function () {
      alert("Đã hủy xác thực vân tay. Vui lòng thử lại.");
      document.getElementById("cod").checked = true; // Select COD as default
      resetPaymentMethodDisplay();
    });
  }

  // --- Event listeners for the general bank transfer information section ---
  if (backFromBankInfoBtn) {
    backFromBankInfoBtn.addEventListener("click", function () {
      document.getElementById("cod").checked = true; // Select COD as default
      resetPaymentMethodDisplay();
    });
  }

  if (proceedToCardInputBtn) {
    proceedToCardInputBtn.addEventListener("click", function () {
      console.log("proceedToCardInputBtn clicked! Calling showBankCardForm().");
      showBankCardForm(); // Transition from general bank info to card input form
    });
  }

  // --- Event listeners for the bank card input form ---
  if (cancelBankPaymentBtn) {
    cancelBankPaymentBtn.addEventListener("click", function () {
      alert("Đã hủy thanh toán thẻ ngân hàng.");
      document.getElementById("cod").checked = true; // Select COD as default
      resetPaymentMethodDisplay();
    });
  }

  if (continueBankPaymentBtn) {
    continueBankPaymentBtn.addEventListener("click", function () {
      if (!validateBankCardForm()) {
        alert("Vui lòng kiểm tra lại thông tin thẻ ngân hàng.");
        return;
      }

      // If all information is valid (client-side check only)
      alert("Thông tin thẻ hợp lệ. Đang chuyển đến bước xác thực OTP...");

      // --- MODIFICATION STARTS HERE ---
      // Instead of showing order success directly, show OTP verification
      showOtpVerification(); // Call the existing function to display OTP screen
      // --- MODIFICATION ENDS HERE ---

      // Note: In a real application, at this point, you would send the
      // card details to your backend/payment gateway. The gateway would then
      // initiate the 3D Secure/OTP process and your backend would await
      // the callback before confirming success.
    });
  }

  // --- Function to load selected cart items from localStorage ---
  function loadSelectedCartItemsForPayment() {
    const storedSelectedCart = localStorage.getItem("selectedItemsForPayment");
    if (storedSelectedCart) {
      selectedCartItems = JSON.parse(storedSelectedCart);
      // Ensure price is a number and img src is correct
      selectedCartItems = selectedCartItems.map((item) => ({
        ...item,
        price:
          typeof item.price === "string"
            ? parseInt(item.price.replace(/[^\d]/g, "")) || 0
            : item.price || 0,
        image: item.imgSrc || item.image, // Use imgSrc or fallback to image if imgSrc isn't set
      }));
    } else {
      alert(
        "Không có sản phẩm nào được chọn để thanh toán. Vui lòng quay lại giỏ hàng."
      );
      window.location.href = "../pages/cart.php";
      return;
    }

    displayPaymentItems();
    calculateAndDisplayTotal();
    resetPaymentMethodDisplay();
  }

  // --- Functions for cart management (savePaymentCartToLocalStorage, displayPaymentItems, calculateAndDisplayTotal, addEventListenersToProductControls, updateQuantity, removeProduct, showConfirmDeleteModal) ---
  function savePaymentCartToLocalStorage() {
    localStorage.setItem(
      "selectedItemsForPayment",
      JSON.stringify(selectedCartItems)
    );
  }

  function displayPaymentItems() {
    paymentProductItems.innerHTML = "";
    if (selectedCartItems.length === 0) {
      paymentProductItems.innerHTML =
        '<p class="text-center text-muted">Không có sản phẩm nào trong đơn hàng của bạn.</p>';
      calculateAndDisplayTotal();
      if (placeOrderBtn) placeOrderBtn.disabled = true;
      return;
    } else {
      if (placeOrderBtn) placeOrderBtn.disabled = false;
    }
    selectedCartItems.forEach((item, index) => {
      const priceNum = parseInt(String(item.price).replace(/[^\d]/g, "")) || 0;
      const productTotal = priceNum * item.quantity;
      const productHtml = `
            <div class="d-flex align-items-center product-item" data-id="${
              item.id
            }">
              <img src="${item.image}" alt="${
        item.name
      }" class="me-3 product-image">
              <div class="product-details">
                <h5 class="mb-1 product-name">${item.name}</h5>
                <p class="mb-0 product-price-per-unit">${priceNum.toLocaleString(
                  "vi-VN"
                )}đ</p>
                <div class="d-flex align-items-center mt-2 product-quantity-control">
                  <button class="btn btn-outline-light btn-sm me-2 quantity-minus" data-id="${
                    item.id
                  }">-</button>
                  <span class="me-2 product-quantity" data-id="${item.id}">${
        item.quantity
      }</span>
                  <button class="btn btn-outline-light btn-sm quantity-plus" data-id="${
                    item.id
                  }">+</button>
                </div>
              </div>
              <span class="ms-auto product-subtotal">${productTotal.toLocaleString(
                "vi-VN"
              )}đ</span>
              <i class="fas fa-trash-alt ms-3 delete-product-btn" data-id="${
                item.id
              }"></i>
            </div>
            ${
              index < selectedCartItems.length - 1
                ? '<hr class="product-divider">'
                : ""
            }
          `;
      if (paymentProductItems) paymentProductItems.innerHTML += productHtml;
    });
    addEventListenersToProductControls();
  }

  function calculateAndDisplayTotal() {
    let total = 0;
    selectedCartItems.forEach((item) => {
      const priceNum = parseInt(String(item.price).replace(/[^\d]/g, "")) || 0;
      total += priceNum * item.quantity;
    });
    if (finalTotalPriceSpan)
      finalTotalPriceSpan.textContent = total.toLocaleString("vi-VN") + "đ";
  }

  function addEventListenersToProductControls() {
    // Re-attach listeners to dynamically added elements
    document
      .querySelectorAll(".quantity-minus, .quantity-plus, .delete-product-btn")
      .forEach((btn) => {
        const newBtn = btn.cloneNode(true);
        btn.parentNode.replaceChild(newBtn, btn);
      });

    document.querySelectorAll(".quantity-minus").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.dataset.id;
        updateQuantity(id, -1);
      });
    });

    document.querySelectorAll(".quantity-plus").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.dataset.id;
        updateQuantity(id, 1);
      });
    });

    document.querySelectorAll(".delete-product-btn").forEach((button) => {
      button.addEventListener("click", function () {
        const id = this.dataset.id;
        showConfirmDeleteModal(id);
      });
    });
  }

  function updateQuantity(id, change) {
    const itemIndex = selectedCartItems.findIndex((item) => item.id === id);
    if (itemIndex > -1) {
      selectedCartItems[itemIndex].quantity += change;
      if (selectedCartItems[itemIndex].quantity < 1) {
        selectedCartItems[itemIndex].quantity = 1;
      }
      savePaymentCartToLocalStorage();
      displayPaymentItems();
      calculateAndDisplayTotal();

      const updateSuccessModalElement =
        document.getElementById("updateSuccessModal");
      if (updateSuccessModalElement) {
        const updateSuccessModal = new bootstrap.Modal(
          updateSuccessModalElement
        );
        updateSuccessModal.show();
      } else {
        console.error(
          "Lỗi: Không tìm thấy phần tử 'updateSuccessModal' trong HTML."
        );
      }
    }
  }

  function removeProduct(id) {
    selectedCartItems = selectedCartItems.filter((item) => item.id !== id);
    savePaymentCartToLocalStorage();
    displayPaymentItems();
    calculateAndDisplayTotal();
  }

  function showConfirmDeleteModal(productId) {
    const confirmDeleteModalElement =
      document.getElementById("confirmDeleteModal");
    if (confirmDeleteModalElement) {
      const confirmDeleteModal = new bootstrap.Modal(confirmDeleteModalElement);
      confirmDeleteModal.show();

      const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");
      if (confirmDeleteBtn) {
        // IMPORTANT: Clear previous event listeners to avoid multiple calls
        const newConfirmDeleteBtn = confirmDeleteBtn.cloneNode(true);
        confirmDeleteBtn.parentNode.replaceChild(
          newConfirmDeleteBtn,
          confirmDeleteBtn
        );

        newConfirmDeleteBtn.addEventListener("click", function handler() {
          removeProduct(productId);
          confirmDeleteModal.hide();
          // Remove this specific handler after it's used
          newConfirmDeleteBtn.removeEventListener("click", handler);
        });
      } else {
        console.error("Lỗi: Không tìm thấy nút 'confirmDeleteBtn'.");
      }
    } else {
      console.error(
        "Lỗi: Không tìm thấy phần tử 'confirmDeleteModal' trong HTML."
      );
    }
  }

  // --- Event listener for placing the order ---
  if (placeOrderBtn) {
    placeOrderBtn.addEventListener("click", function () {
      console.log("Place Order button clicked!");
      const selectedPaymentMethod = document.querySelector(
        'input[name="paymentMethod"]:checked'
      )?.value;

      console.log("Selected Payment Method:", selectedPaymentMethod);

      if (selectedCartItems.length === 0) {
        alert("Không có sản phẩm nào để đặt hàng.");
        return;
      }

      if (!selectedPaymentMethod) {
        alert("Vui lòng chọn phương thức thanh toán.");
        return;
      }

      const orderDetails = {
        customerName: document.getElementById("customer-name-phone")
          ?.textContent,
        customerAddress:
          document.getElementById("customer-address")?.textContent,
        items: selectedCartItems.map((item) => ({
          id: item.id,
          name: item.name,
          quantity: item.quantity,
          price: parseInt(String(item.price).replace(/[^\d]/g, "")) || 0,
        })),
        totalAmount:
          parseInt(finalTotalPriceSpan.textContent.replace(/[^\d]/g, "")) || 0,
        paymentMethod: selectedPaymentMethod,
      };

      console.log("Order Details:", orderDetails);

      if (selectedPaymentMethod === "cod") {
        if (orderSuccessModal) {
          orderSuccessModal.show();
          if (orderSuccessConfirmBtn) {
            orderSuccessConfirmBtn.onclick = function () {
              orderSuccessModal.hide();
              localStorage.removeItem("selectedItemsForPayment");
              window.location.href = "../index.php";
            };
          }
        } else {
          console.error(
            "Lỗi: orderSuccessModal không được khởi tạo. Không thể hiển thị."
          );
          localStorage.removeItem("selectedItemsForPayment");
          window.location.href = "../index.php";
        }
      } else if (selectedPaymentMethod === "momo") {
        // Ensure no other specific payment flow is active
        if (
          !isMomoQrVisible &&
          !isOtpVerificationVisible &&
          !isFingerprintScanVisible &&
          !isBankTransferInfoVisible &&
          !isBankCardFormVisible
        ) {
          paymentMethodsSelection.style.display = "none";
          momoQrDisplay.style.display = "block";
          placeOrderBtn.style.display = "none";
          isMomoQrVisible = true;

          setTimeout(() => {
            if (isMomoQrVisible) {
              alert("Đã quét mã Momo thành công! Vui lòng xác thực OTP.");
              momoQrDisplay.style.display = "none";
              showOtpVerification();
            }
          }, 3000);
        }
      } else if (selectedPaymentMethod === "bankTransfer") {
        console.log("Payment method is bankTransfer.");
        // Always show the general bank transfer info first for this flow
        showBankTransferInfo();
      }
    });
  }

  // Formatting for card number input (add spaces every 4 digits)
  if (cardNumber) {
    cardNumber.addEventListener("input", function (e) {
      let input = e.target.value.replace(/\s/g, ""); // Remove existing spaces
      let formattedInput = "";
      for (let i = 0; i < input.length; i++) {
        if (i > 0 && i % 4 === 0) {
          formattedInput += " ";
        }
        formattedInput += input[i];
      }
      e.target.value = formattedInput;
      // Also clear validation error when user types
      if (cardNumber) cardNumber.classList.remove("is-invalid");
      if (cardNumberError) cardNumberError.textContent = "";
    });
  }

  // Formatting for expiry date input (MM/YYYY)
  if (expiryDate) {
    expiryDate.addEventListener("input", function (e) {
      let input = e.target.value.replace(/\D/g, ""); // Remove non-digits
      if (input.length > 2) {
        input = input.substring(0, 2) + "/" + input.substring(2, 6);
      }
      e.target.value = input;
      // Also clear validation error when user types
      if (expiryDate) expiryDate.classList.remove("is-invalid");
      if (expiryDateError) expiryDateError.textContent = "";
    });
  }

  // Clear validation for other fields on input
  if (bankSelect) {
    bankSelect.addEventListener("change", () => {
      if (bankSelect) bankSelect.classList.remove("is-invalid");
      if (bankSelectError) bankSelectError.textContent = "";
    });
  }
  if (cardHolderName) {
    cardHolderName.addEventListener("input", () => {
      if (cardHolderName) cardHolderName.classList.remove("is-invalid");
      if (cardHolderNameError) cardHolderNameError.textContent = "";
    });
  }
  if (cardPhone) {
    cardPhone.addEventListener("input", () => {
      if (cardPhone) cardPhone.classList.remove("is-invalid");
      if (cardPhoneError) cardPhoneError.textContent = "";
    });
  }

  // Initial load
  loadSelectedCartItemsForPayment();
});
