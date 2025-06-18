// ../assets/js/comment-admin.js

document.addEventListener("DOMContentLoaded", function () {
  const hideReasonModal = new bootstrap.Modal(
    document.getElementById("hideReasonModal")
  );
  const reviewModerationModal = new bootstrap.Modal(
    document.getElementById("reviewModerationModal")
  );
  const reportFilterModal = new bootstrap.Modal(
    document.getElementById("reportFilterModal")
  );
  const reportDisplayModal = new bootstrap.Modal(
    document.getElementById("reportDisplayModal")
  );
  const generalSuccessModal = new bootstrap.Modal(
    document.getElementById("successModal")
  );
  const logoutConfirmModal = new bootstrap.Modal(
    document.getElementById("logoutConfirmModal")
  );
  const hideReviewErrorModal = new bootstrap.Modal(
    document.getElementById("hideReviewErrorModal")
  );
  // NEW: Duyệt đánh giá thất bại Modal
  const moderateReviewErrorModal = new bootstrap.Modal(
    document.getElementById("moderateReviewErrorModal")
  );
  // NEW: Xuất báo cáo thất bại Modal
  const reportGenerationErrorModal = new bootstrap.Modal(
    document.getElementById("reportGenerationErrorModal")
  );

  // Elements for Hide Reason Modal
  const reviewIdToHideReasonInput = document.getElementById(
    "reviewIdToHideReason"
  );
  const hideReasonTextArea = document.getElementById("hideReasonTextArea");
  const confirmHideReasonBtn = document.getElementById("confirmHideReasonBtn");
  const successMessage = document.getElementById("successMessage"); // Message for generalSuccessModal

  // Elements for Review Moderation Modal
  const reviewIdToModerateInput = document.getElementById("reviewIdToModerate");
  const moderationReviewAvatar = document.getElementById(
    "moderationReviewAvatar"
  );
  const moderationReviewUser = document.getElementById("moderationReviewUser");
  const moderationReviewStars = document.getElementById(
    "moderationReviewStars"
  );
  const moderationReviewDateTime = document.getElementById(
    "moderationReviewDateTime"
  );
  const moderationReviewProduct = document.getElementById(
    "moderationReviewProduct"
  );
  const moderationReviewText = document.getElementById("moderationReviewText");
  const moderationReviewImageContainer = document.getElementById(
    "moderationReviewImageContainer"
  );
  const moderationReviewImage = document.getElementById(
    "moderationReviewImage"
  );
  const approveReviewBtn = document.getElementById("approveReviewBtn");
  const rejectReviewBtn = document.getElementById("rejectReviewBtn");

  // Elements for Report Filter Modal
  const reportProductIdInput = document.getElementById("reportProductId");
  const reportStartDateInput = document.getElementById("reportStartDate");
  const reportEndDateInput = document.getElementById("reportEndDate");
  const reportProductTypeSelect = document.getElementById("reportProductType");
  const reportRatingLevelSelect = document.getElementById("reportRatingLevel");
  const generateReportBtn = document.getElementById("generateReportBtn");

  // Elements for Report Display Modal
  const displayReportStartDate = document.getElementById(
    "displayReportStartDate"
  );
  const displayReportEndDate = document.getElementById("displayReportEndDate");
  const displayReportTotal = document.getElementById("displayReportTotal");
  const displayReportAverageStars = document.getElementById(
    "displayReportAverageStars"
  );
  const displayReportApprovedRate = document.getElementById(
    "displayReportApprovedRate"
  );
  const displayReportHiddenRate = document.getElementById(
    "displayReportHiddenRate"
  );
  const reportProductImage = document.getElementById("reportProductImage");

  // Elements for Logout Confirmation Modal
  const confirmLogoutBtn = document.getElementById("confirmLogoutBtn");

  // --- Helper function to simulate an error (e.g., 30% chance of error) ---
  function simulateBackendError() {
    return Math.random() < 0.3; // 30% chance of returning true (error)
  }

  // --- Function to handle general error/network error and display appropriate modal ---
  // Added a 'type' parameter to specify which error modal to show
  function showErrorMessage(message, type = "general") {
    // Close any potentially open action modals before showing an error
    hideReasonModal.hide();
    reviewModerationModal.hide();
    reportFilterModal.hide();
    reportDisplayModal.hide();
    logoutConfirmModal.hide();

    switch (type) {
      case "hideReview":
        hideReviewErrorModal.show();
        break;
      case "moderateReview":
        moderateReviewErrorModal.show();
        break;
      case "reportGeneration":
        reportGenerationErrorModal.show();
        break;
      case "general":
      default:
        successMessage.textContent = message; // Using successMessage for general errors
        generalSuccessModal.show();
        break;
    }
    console.error("Lỗi: " + message);
  }

  // --- Hide Review Functionality ---
  document.querySelectorAll(".hide-review-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const reviewElement = this.closest(".review");
      const reviewId = reviewElement ? reviewElement.dataset.reviewId : null;
      if (reviewId) {
        reviewIdToHideReasonInput.value = reviewId;
        hideReasonTextArea.value = "";
      }
    });
  });

  confirmHideReasonBtn.addEventListener("click", function () {
    // Check network status first
    if (!navigator.onLine) {
      showErrorMessage(
        "Mất kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn.",
        "hideReview"
      );
      return; // Stop execution if offline
    }

    const reviewId = reviewIdToHideReasonInput.value;
    const hideReason = hideReasonTextArea.value.trim();

    if (!hideReason) {
      alert("Vui lòng nhập lý do ẩn đánh giá.");
      return;
    }

    // Rẽ nhánh E-2: Lỗi khi ẩn đánh giá (Backend Simulation)
    if (simulateBackendError()) {
      hideReasonModal.hide(); // Close the reason input modal
      showErrorMessage(
        "Không thể ẩn đánh giá. Vui lòng kiểm tra kết nối hoặc dữ liệu.",
        "hideReview"
      );
      return;
    }

    if (reviewId) {
      const reviewElement = document.querySelector(
        `.review[data-review-id="${reviewId}"]`
      );
      if (reviewElement) {
        const hideButton = reviewElement.querySelector(".hide-review-btn");

        if (hideButton) {
          hideButton.textContent = "Đã ẩn";
          hideButton.classList.remove("btn-warning");
          hideButton.classList.add("btn-secondary");
          hideButton.disabled = true;
          hideButton.removeAttribute("data-bs-toggle");
          hideButton.removeAttribute("data-bs-target");
        }

        console.log(
          `Review ID: ${reviewId} hidden with reason: "${hideReason}"`
        );

        hideReasonModal.hide();
        successMessage.textContent = "Đánh giá đã được ẩn.";
        generalSuccessModal.show();
      }
    }
  });

  document
    .getElementById("hideReasonModal")
    .addEventListener("hidden.bs.modal", function () {
      reviewIdToHideReasonInput.value = "";
      hideReasonTextArea.value = "";
    });

  // --- Review Moderation Functionality ---

  document.querySelectorAll(".moderation-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const reviewElement = this.closest(".review");
      if (reviewElement) {
        reviewIdToModerateInput.value = reviewElement.dataset.reviewId || "";
        moderationReviewUser.textContent =
          reviewElement.dataset.reviewerName || "N/A";
        moderationReviewDateTime.textContent = `${
          reviewElement.dataset.reviewDate || "N/A"
        } ${reviewElement.dataset.reviewTime || "N/A"}`;
        moderationReviewProduct.textContent = `Phân loại hàng: ${
          reviewElement.dataset.productCategory || "N/A"
        }`;
        moderationReviewText.textContent =
          reviewElement.dataset.reviewText || "";

        moderationReviewStars.textContent = "★★★★★"; // This needs to be dynamic based on actual rating data

        const reviewImageUrl = reviewElement.dataset.reviewImage;
        if (reviewImageUrl) {
          moderationReviewImage.src = reviewImageUrl;
          moderationReviewImageContainer.style.display = "block";
        } else {
          moderationReviewImage.src = "";
          moderationReviewImageContainer.style.display = "none";
        }

        moderationReviewAvatar.src =
          reviewElement.querySelector("img.rounded-circle").src ||
          "../assets/img/default-avatar.png";
      }
    });
  });

  approveReviewBtn.addEventListener("click", function () {
    // Check network status first
    if (!navigator.onLine) {
      showErrorMessage(
        "Mất kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn.",
        "moderateReview"
      );
      return; // Stop execution if offline
    }

    const reviewId = reviewIdToModerateInput.value;
    if (reviewId) {
      // Rẽ nhánh E-1: Không thể duyệt đánh giá (Backend Simulation)
      if (simulateBackendError()) {
        reviewModerationModal.hide();
        showErrorMessage(
          "Không thể duyệt đánh giá. Vui lòng thử lại.",
          "moderateReview"
        );
        return;
      }

      console.log(`Review ID: ${reviewId} approved (Hiển thị).`);

      const reviewElement = document.querySelector(
        `.review[data-review-id="${reviewId}"]`
      );
      if (reviewElement) {
        const statusButton = reviewElement.querySelector(".status-btn");
        if (statusButton) {
          statusButton.textContent = "Hiển thị";
          statusButton.classList.remove("btn-secondary", "btn-danger");
          statusButton.classList.add("btn-success");
          statusButton.disabled = true;
          statusButton.removeAttribute("data-bs-toggle");
          statusButton.removeAttribute("data-bs-target");
        }
      }

      reviewModerationModal.hide();
      successMessage.textContent = "Duyệt đánh giá thành công.";
      generalSuccessModal.show();
    }
  });

  rejectReviewBtn.addEventListener("click", function () {
    // Check network status first
    if (!navigator.onLine) {
      showErrorMessage(
        "Mất kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn.",
        "moderateReview"
      );
      return; // Stop execution if offline
    }

    const reviewId = reviewIdToModerateInput.value;
    if (reviewId) {
      // Added simulated error for reject as well for consistency
      if (simulateBackendError()) {
        reviewModerationModal.hide();
        showErrorMessage(
          "Không thể từ chối đánh giá. Vui lòng thử lại.",
          "moderateReview"
        );
        return;
      }

      console.log(`Review ID: ${reviewId} rejected (Bị từ chối).`);

      const reviewElement = document.querySelector(
        `.review[data-review-id="${reviewId}"]`
      );
      if (reviewElement) {
        const statusButton = reviewElement.querySelector(".status-btn");
        if (statusButton) {
          statusButton.textContent = "Bị từ chối";
          statusButton.classList.remove("btn-secondary", "btn-success");
          statusButton.classList.add("btn-danger");
          statusButton.disabled = true;
          statusButton.removeAttribute("data-bs-toggle");
          statusButton.removeAttribute("data-bs-target");
        }
      }

      reviewModerationModal.hide();
      successMessage.textContent = "Đánh giá đã bị từ chối.";
      generalSuccessModal.show();
    }
  });

  document
    .getElementById("reviewModerationModal")
    .addEventListener("hidden.bs.modal", function () {
      reviewIdToModerateInput.value = "";
      moderationReviewUser.textContent = "";
      moderationReviewStars.textContent = "";
      moderationReviewDateTime.textContent = "";
      moderationReviewProduct.textContent = "";
      moderationReviewText.textContent = "";
      moderationReviewImage.src = "";
      moderationReviewImageContainer.style.display = "none";
      moderationReviewAvatar.src = "";
    });

  // --- Report Generation Functionality ---

  document.querySelectorAll(".export-report-btn").forEach((button) => {
    button.addEventListener("click", function () {
      const productId = this.dataset.productId;
      reportProductIdInput.value = productId || "";

      reportStartDateInput.value = "";
      reportEndDateInput.value = "";
      reportProductTypeSelect.value = "";
      reportRatingLevelSelect.value = "";
    });
  });

  generateReportBtn.addEventListener("click", function () {
    // Check network status first
    if (!navigator.onLine) {
      showErrorMessage(
        "Mất kết nối mạng. Vui lòng kiểm tra kết nối internet của bạn.",
        "reportGeneration"
      );
      return; // Stop execution if offline
    }

    const productId = reportProductIdInput.value;
    const startDate = reportStartDateInput.value;
    const endDate = reportEndDateInput.value;
    const productType = reportProductTypeSelect.value;
    const ratingLevel = reportRatingLevelSelect.value;

    // Rẽ nhánh E-3: Xuất báo cáo thất bại (Backend Simulation)
    if (simulateBackendError()) {
      reportFilterModal.hide();
      showErrorMessage(
        "Xuất báo cáo thất bại. Vui lòng thử lại sau hoặc liên hệ kỹ thuật.",
        "reportGeneration"
      );
      return;
    }

    console.log("Generating report with filters:");
    console.log(`    Product ID: ${productId || "All Products"}`);
    console.log(`    Start Date: ${startDate || "N/A"}`);
    console.log(`    End Date: ${endDate || "N/A"}`);
    console.log(`    Product Type: ${productType || "All Types"}`);
    console.log(`    Rating Level: ${ratingLevel || "All Levels"}`);

    let simulatedTotalReviews;
    let simulatedAverageStars;
    let simulatedApprovedRate;
    let simulatedHiddenRate;
    let simulatedProductImagePath;

    if (productId === "product-1") {
      simulatedTotalReviews = 159;
      simulatedAverageStars = "4.9/5";
      simulatedApprovedRate = "90%";
      simulatedHiddenRate = "10%";
      simulatedProductImagePath = "../assets/img/Hot1.png";
    } else if (productId === "product-2") {
      simulatedTotalReviews = 100;
      simulatedAverageStars = "4.5/5";
      simulatedApprovedRate = "80%";
      simulatedHiddenRate = "20%";
      simulatedProductImagePath = "../assets/img/Hot2.png";
    } else {
      simulatedTotalReviews = 259;
      simulatedAverageStars = "4.7/5";
      simulatedApprovedRate = "88%";
      simulatedHiddenRate = "12%";
      simulatedProductImagePath = "../assets/img/logo.png";
    }

    reportProductImage.src = simulatedProductImagePath;
    displayReportStartDate.textContent = startDate || "N/A";
    displayReportEndDate.textContent = endDate || "N/A";
    displayReportTotal.textContent = simulatedTotalReviews;
    displayReportAverageStars.textContent = simulatedAverageStars;
    displayReportApprovedRate.textContent = simulatedApprovedRate;
    displayReportHiddenRate.textContent = simulatedHiddenRate;

    reportFilterModal.hide();
    reportDisplayModal.show();
  });

  document
    .getElementById("reportFilterModal")
    .addEventListener("hidden.bs.modal", function () {
      reportProductIdInput.value = "";
      reportStartDateInput.value = "";
      reportEndDateInput.value = "";
      reportProductTypeSelect.value = "";
      reportRatingLevelSelect.value = "";
    });

  // --- Logout Functionality ---
  confirmLogoutBtn.addEventListener("click", function () {
    console.log("Đăng xuất thành công. Đang chuyển hướng...");
    localStorage.removeItem("loggedInUser");
    logoutConfirmModal.hide();
    window.location.href = "../index.php";
  });

  // Event listener for "Thử lại" button in the specific hide review error modal
  document
    .getElementById("hideReviewErrorModal")
    .addEventListener("click", function (event) {
      if (
        event.target.tagName === "BUTTON" &&
        event.target.classList.contains("btn-danger")
      ) {
        console.log("Người dùng nhấn Thử lại từ modal lỗi ẩn đánh giá.");
        hideReviewErrorModal.hide();
        // Optional: You can re-trigger the hide review logic here if needed
      }
    });

  // NEW: Event listener for "Thử lại" button in the specific moderate review error modal
  document
    .getElementById("moderateReviewErrorModal")
    .addEventListener("click", function (event) {
      if (
        event.target.tagName === "BUTTON" &&
        event.target.classList.contains("btn-danger")
      ) {
        console.log("Người dùng nhấn Thử lại từ modal lỗi duyệt đánh giá.");
        moderateReviewErrorModal.hide();
        // Optional: You can re-trigger the approve/reject review logic here if needed
        // For example, if you know which action failed, you could call approveReviewBtn.click() or rejectReviewBtn.click()
        // However, it's generally better to re-run the underlying function that made the AJAX call.
      }
    });

  // NEW: Event listener for "Thử lại" button in the specific report generation error modal
  document
    .getElementById("reportGenerationErrorModal")
    .addEventListener("click", function (event) {
      if (
        event.target.tagName === "BUTTON" &&
        event.target.classList.contains("btn-danger")
      ) {
        console.log("Người dùng nhấn Thử lại từ modal lỗi xuất báo cáo.");
        reportGenerationErrorModal.hide();
        // Optional: You can re-trigger the report generation logic here if needed
        // For example, generateReportBtn.click();
      }
    });
});
