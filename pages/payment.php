<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/header.css" />
    <link rel="stylesheet" href="../assets/css/payment.css" />
    <link rel="stylesheet" href="../assets/css/footer.css" />
    <title>Thanh toán</title>
    <style>
        /* CSS để ẩn/hiện phần Momo QR */
        .momo-qr-section {
            display: none; /* Mặc định ẩn */
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container mt-4 payment-container">
        <h2 class="payment-header mb-4">THANH TOÁN</h2>

        <div class="row">
            <div class="col-md-7 left-column">
                <div class="card payment-info-card address-card mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="customer-name-phone" class="mb-0">Alexis (+84)386669999</h5>
                        <span class="change-address-btn" role="button">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    </div>
                    <p id="customer-address" class="mb-0">175 P. Tây Sơn, Trung Liệt, Đống Đa, Hà Nội, Việt Nam</p>
                </div>

                <div class="card payment-info-card product-list-card">
                    <div id="payment-product-items" class="card-body">
                        </div>
                </div>
            </div>

            <div class="col-md-5 right-column">
                <div class="card payment-info-card payment-summary-card">
                    <h4 class="mb-4">Chi tiết thanh toán</h4>

                    <div class="mb-3 payment-methods" id="payment-methods-selection">
                        <label class="form-label fw-bold">Phương thức thanh toán</label>
                        <div class="form-check d-flex align-items-center mb-2">
                            <input class="form-check-input payment-radio" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                            <label class="form-check-label d-flex align-items-center ms-2" for="cod">
                                <img src="../assets/img/COD.png" alt="Thanh toán khi nhận hàng" class="me-2 payment-icon" style="width:50px;height:50px">
                                Thanh toán khi nhận hàng
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center mb-2">
                            <input class="form-check-input payment-radio" type="radio" name="paymentMethod" id="momo" value="momo">
                            <label class="form-check-label d-flex align-items-center ms-2" for="momo">
                                <img src="../assets/img/MoMo.png" alt="Momo" class="me-2 payment-icon" style="width:50px;height:50px">
                                Momo
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center">
                            <input class="form-check-input payment-radio" type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer">
                            <label class="form-check-label d-flex align-items-center ms-2" for="bankTransfer">
                                <img src="../assets/img/BankCard.png" alt="Thẻ ngân hàng" class="me-2 payment-icon" style="width:50px;height:50px">
                                Thẻ ngân hàng
                            </label>
                        </div>
                    </div>

                    <div class="momo-qr-section text-center p-3 rounded" id="momo-qr-display">
                        <h5 class="fw-bold mb-3 text-white">QUÉT MÃ ĐỂ THANH TOÁN</h5>
                        <img src="../assets/img/QR.png" alt="Momo QR Code" class="img-fluid mb-3" style="max-width: 250px;">
                        <p class="text-muted small">Sử dụng App MoMo hoặc ứng dụng camera hỗ trợ QR code để quét mã</p>
                        <p class="text-muted small">Đang chờ bạn quét...</p>
                        <button class="btn btn-secondary mt-3" id="back-to-payment-methods">Quay lại lựa chọn</button>
                    </div>

                    <div class="bank-transfer-details-section p-3 rounded" id="bank-transfer-details-display" style="display: none;">
                        <h5 class="fw-bold mb-3 text-center">HOMEFOOD - THANH TOÁN THẺ NGÂN HÀNG</h5>
                        <p class="text-center">Vui lòng kiểm tra lại thông tin đơn hàng và tiếp tục thanh toán.</p>

                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Tổng số tiền cần thanh toán:</h6>
                                <p class="card-text fw-bold fs-4 text-success" id="bank-details-total-price">0đ</p>
                            </div>
                        </div>

                        <p class="text-muted text-center">
                            Bạn sẽ được chuyển đến trang nhập thông tin thẻ ngân hàng sau khi xác nhận.
                        </p>

                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-secondary flex-fill me-2" id="back-from-bank-details-btn">Quay lại</button>
                            <button class="btn btn-primary flex-fill ms-2" id="proceed-to-card-input-btn">Tiếp tục thanh toán bằng thẻ</button>
                        </div>
                    </div>

                    <div class="bank-transfer-form-section p-3 rounded" id="bank-transfer-form-display" style="display: none;">
                        <h5 class="fw-bold mb-3 text-center text-white">THANH TOÁN THẺ NGÂN HÀNG</h5>
                        <div class="mb-3">
                            <label for="bank-select" class="form-label text-white">Ngân hàng:</label>
                            <select class="form-select" id="bank-select">
                                <option value="">Chọn ngân hàng</option>
                                <option value="MB Bank">MB Bank</option>
                                <option value="Vietcombank">Vietcombank</option>
                                <option value="Techcombank">Techcombank</option>
                                <option value="ACB">ACB</option>
                            </select>
                            <div class="invalid-feedback" id="bank-select-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="card-number" class="form-label text-white">Số thẻ:</label>
                            <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9875 5478" maxlength="19">
                            <div class="invalid-feedback" id="card-number-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="card-holder-name" class="form-label text-white">Tên chủ thẻ:</label>
                            <input type="text" class="form-control" id="card-holder-name" placeholder="NGUYEN VAN A">
                            <div class="invalid-feedback" id="card-holder-name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="card-phone" class="form-label text-white">Số điện thoại:</label>
                            <input type="tel" class="form-control" id="card-phone" placeholder="0987654312" maxlength="10">
                            <div class="invalid-feedback" id="card-phone-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="expiry-date" class="form-label text-white">Ngày hết hạn:</label>
                            <input type="text" class="form-control" id="expiry-date" placeholder="MM/YYYY" maxlength="7">
                            <div class="invalid-feedback" id="expiry-date-error"></div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button class="btn btn-success flex-fill" id="continue-bank-payment-btn" style="margin-right:20px">Tiếp tục thanh toán</button>
                            <button class="btn btn-danger flex-fill me-2" id="cancel-bank-payment-btn">Hủy</button>       
                        </div>
                    </div>
                    <div class="otp-verification-section text-center p-3 rounded" id="otp-verification-display" style="display: none;">
                        <h5 class="fw-bold mb-3">NHẬP MÃ XÁC THỰC OTP</h5>
                        <p class="text-muted small">Một mã xác thực đã được gửi đến 038****9999</p>
                        <div class="d-flex justify-content-center mb-3">
                            <input type="text" class="form-control otp-input me-2 text-center" maxlength="1">
                            <input type="text" class="form-control otp-input me-2 text-center" maxlength="1">
                            <input type="text" class="form-control otp-input me-2 text-center" maxlength="1">
                            <input type="text" class="form-control otp-input me-2 text-center" maxlength="1">
                            <input type="text" class="form-control otp-input me-2 text-center" maxlength="1">
                            <input type="text" class="form-control otp-input text-center" maxlength="1">
                        </div>
                        <p class="text-muted small">Mã sẽ hết hạn sau <span id="otp-countdown">00:30</span></p>
                        <button class="btn btn-danger me-2" id="cancel-otp-btn">Hủy</button>
                        <button class="btn btn-success" id="confirm-otp-btn">Xác nhận</button>
                        <button class="btn btn-link mt-2" id="resend-otp-btn">Gửi lại mã</button>
                    </div>

                    <div class="fingerprint-scan-section text-center p-3 rounded" id="fingerprint-scan-display" style="display: none;">
                        <h5 class="fw-bold mb-3">XÁC THỰC VÂN TAY</h5>
                        <p class="text-muted small">Vui lòng đặt ngón tay của bạn lên cảm biến vân tay.</p>
                        <div class="fingerprint-icon-container mb-4">
                            <i class="fas fa-fingerprint fa-5x text-primary animate-pulse"></i> </div>
                        <p class="text-muted small">Đang chờ quét vân tay...</p>
                        <button class="btn btn-secondary mt-3" id="cancel-fingerprint-btn">Hủy</button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4 total-amount-section">
                        <span class="fw-bold text-white">Thành tiền:</span>
                        <span id="final-total-price" class="fw-bold total-price">0đ</span>
                    </div>

                    <button id="place-order-btn" class="btn btn-success w-100 py-2">Đặt hàng</button>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <div class="modal fade" id="favoriteModal" tabindex="-1" aria-labelledby="favoriteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="favoriteModalLabel">Thông báo !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Đã lưu vào yêu thích
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" data-bs-dismiss="modal">Xác nhận</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="confirmDeleteLabel">Thông báo !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" id="confirmDeleteBtn">Xác nhận</button>
                    <button type="button" class="btn btn-outline-danger" style="color:black;border-radius: 50px;" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateSuccessModal" tabindex="-1" aria-labelledby="updateSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="confirmDeleteLabel">Thông báo !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Cập nhật thành công.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-labelledby="orderSuccessModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="orderSuccessModalLabel">Thông báo !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Đặt hàng thành công.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-success" style="color:white;border-radius: 50px;" data-bs-dismiss="modal" id="orderSuccessConfirmBtn">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/99651229fa.js" crossorigin="anonymous"></script>
    <script src="../assets/js/payment.js"></script>
</body>
</html>