<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Trang quản lý đánh giá</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/comment-admin.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0V4LLanw2qksYuRlEzO+tcaEPQogQ0K45I5T6jUf0Q5L9b+6Wqg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
</head>
<body class="bg-dark text-white">

    <div class="container-fluid">
        <div class="row topbar text-center position-relative">
            <div class="col fw-bold text-center" style="color:white">Trang chủ</div>
            <div class="position-absolute end-0 pe-4 icons ">
                <i class="fas fa-search" style="margin-left:1500px;"></i>
                <div class="dropdown d-inline-block">
                    <i class="fas fa-user" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;"></i>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../index.php" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-lg-2">
                <div class="sidebar">
                    <img src="../assets/img/logo.png" alt="HomeFood Logo">
                    <a href="product-admin.php">Quản lý sản phẩm</a>
                    <a href="comment-admin.php" class="active">Quản lý đánh giá sản phẩm</a>
                    <a href="#">Chương trình khuyến mãi</a>
                    <a href="#">Tin tức</a>
                </div>
            </div>

            <div class="col-md-10 p-4">
                <div class="product-review bg-light text-dark p-3 mb-4 rounded shadow-sm">
                    <div class="d-flex">
                        <img src="../assets/img/Hot1.png" class="img-thumbnail me-3" width="100" alt="Sườn heo" />
                        <div>
                            <strong>Giá: Sườn heo non 300g</strong><br />
                            <span>103.000đ</span>
                        </div>
                    </div>

                    <div class="bg-warning-subtle p-2 mt-3 rounded">
                        <strong>Tổng đánh giá đã duyệt: 285</strong><br />
                        <span class="badge bg-warning text-dark">5 Sao(159)</span>
                        <span class="badge bg-warning text-dark">4 Sao(95)</span>
                        <span class="badge bg-warning text-dark">3 Sao(15)</span>
                        <span class="badge bg-warning text-dark">2 Sao(9)</span>
                        <span class="badge bg-warning text-dark">1 Sao(7)</span>
                        <span class="badge bg-warning text-dark">Có Bình Luận (200)</span>
                        <span class="badge bg-warning text-dark">Có Hình Ảnh/Video(155)</span>
                    </div>

                    <div class="mt-3">
                        <h6>Đánh giá chờ duyệt:</h6>
                        <div class="review d-flex align-items-start mb-3" data-review-id="review-1"
                             data-reviewer-name="trungdung"
                             data-review-date="2024-12-24"
                             data-review-time="11:58"
                             data-product-category="Sườn heo non 300g"
                             data-review-text="Giao hàng nhanh. Thực phẩm tươi."
                             data-review-image="../assets/img/Hot1.png">
                            <img src="../assets/img/avatar1.png" class="rounded-circle me-2" width="50" />
                            <div class="flex-grow-1">
                                <strong>trungdung</strong><br />
                                ★★★★★<br />
                                Giao hàng nhanh. Thực phẩm tươi.
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-warning btn-sm mb-1 hide-review-btn" data-bs-toggle="modal" data-bs-target="#hideReasonModal">Ẩn đánh giá</button>
                                <button class="btn btn-secondary btn-sm status-btn moderation-btn" data-bs-toggle="modal" data-bs-target="#reviewModerationModal">Chờ duyệt</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="review d-flex align-items-start mb-3" data-review-id="review-2"
                             data-reviewer-name="cutecute"
                             data-review-date="2024-12-25"
                             data-review-time="14:30"
                             data-product-category="Sườn heo non 300g"
                             data-review-text="Đóng gói cẩn thận, thịt tươi ngon."
                             data-review-image="../assets/img/Hot1.png">
                            <img src="../assets/img/avatar1.png" class="rounded-circle me-2" width="50" />
                            <div class="flex-grow-1">
                                <strong>cutecute</strong><br />
                                ★★★★☆<br />
                                Đóng gói cẩn thận, thịt tươi ngon.
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-warning btn-sm mb-1 hide-review-btn" data-bs-toggle="modal" data-bs-target="#hideReasonModal">Ẩn đánh giá</button>
                                <button class="btn btn-secondary btn-sm status-btn moderation-btn" data-bs-toggle="modal" data-bs-target="#reviewModerationModal">Chờ duyệt</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2 export-report-btn" data-bs-toggle="modal" data-bs-target="#reportFilterModal" data-product-id="product-1" style="margin-left:1200px">Xuất báo cáo</button>
                </div>

                <div class="product-review bg-light text-dark p-3 mb-4 rounded shadow-sm">
                    <div class="d-flex">
                        <img src="../assets/img/Hot2.png" class="img-thumbnail me-3" width="100" alt="Xương ống heo" />
                        <div>
                            <strong>Xương ống heo 500G</strong><br />
                            <span>Giá: 53.000đ</span>
                        </div>
                    </div>

                    <div class="bg-warning-subtle p-2 mt-3 rounded">
                        <strong>Tổng đánh giá đã duyệt: 155</strong><br />
                        <span class="badge bg-warning text-dark">5 Sao(90)</span>
                        <span class="badge bg-warning text-dark">4 Sao(25)</span>
                        <span class="badge bg-warning text-dark">3 Sao(20)</span>
                        <span class="badge bg-warning text-dark">2 Sao(10)</span>
                        <span class="badge bg-warning text-dark">1 Sao(10)</span>
                        <span class="badge bg-warning text-dark">Có Bình Luận (119)</span>
                        <span class="badge bg-warning text-dark">Có Hình Ảnh/Video(55)</span>
                    </div>

                    <div class="mt-3">
                        <h6>Đánh giá chờ duyệt:</h6>
                        <div class="review d-flex align-items-start mb-3" data-review-id="review-3"
                             data-reviewer-name="hahaha"
                             data-review-date="2024-12-26"
                             data-review-time="09:00"
                             data-product-category="Xương ống heo 500G"
                             data-review-text="rất hài lòng với sản phẩm"
                             data-review-image="../assets/img/Hot2.png">
                            <img src="../assets/img/avatar2.png" class="rounded-circle me-2" width="50" />
                            <div class="flex-grow-1">
                                <strong>hahaha</strong><br />
                                ★★★★★<br />
                                rất hài lòng với sản phẩm
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-warning btn-sm mb-1 hide-review-btn" data-bs-toggle="modal" data-bs-target="#hideReasonModal">Ẩn đánh giá</button>
                                <button class="btn btn-secondary btn-sm status-btn moderation-btn" data-bs-toggle="modal" data-bs-target="#reviewModerationModal">Chờ duyệt</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="review d-flex align-items-start mb-3" data-review-id="review-4"
                             data-reviewer-name="hehehe"
                             data-review-date="2024-12-27"
                             data-review-time="10:15"
                             data-product-category="Xương ống heo 500G"
                             data-review-text="Giao hàng nhanh."
                             data-review-image="../assets/img/Hot2.png">
                            <img src="../assets/img/avatar2.png" class="rounded-circle me-2" width="50" />
                            <div class="flex-grow-1">
                                <strong>hehehe</strong><br />
                                ★★★☆☆<br />
                                Giao hàng nhanh.
                            </div>
                            <div class="ms-2">
                                <button class="btn btn-warning btn-sm mb-1 hide-review-btn" data-bs-toggle="modal" data-bs-target="#hideReasonModal">Ẩn đánh giá</button>
                                <button class="btn btn-secondary btn-sm status-btn moderation-btn" data-bs-toggle="modal" data-bs-target="#reviewModerationModal">Chờ duyệt</button>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success mt-2 export-report-btn" data-bs-toggle="modal" data-bs-target="#reportFilterModal" data-product-id="product-2" style="margin-left:1200px">Xuất báo cáo</button>
                </div>

                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <br><br>
    <?php include '../includes/footer.php'?>

    <div class="modal fade" id="hideReasonModal" tabindex="-1" aria-labelledby="hideReasonModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black">
                    <h5 class="modal-title fw-bold" id="hideReasonModalLabel">Ẩn đánh giá</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <div class="mb-3">
                        <label for="hideReasonTextArea" class="form-label visually-hidden">Lý do ẩn đánh giá</label>
                        <textarea class="form-control" id="hideReasonTextArea" rows="5" placeholder="Lý do ẩn đánh giá..."></textarea>
                    </div>
                    <input type="hidden" id="reviewIdToHideReason">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" id="confirmHideReasonBtn">Xác nhận</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reviewModerationModal" tabindex="-1" aria-labelledby="reviewModerationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="reviewModerationModalLabel">Duyệt đánh giá</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <div class="card p-3" style="background-color: #e0f7fa;">
                        <div class="d-flex align-items-center mb-3">
                            <img id="moderationReviewAvatar" src="" class="rounded-circle me-3" width="60" height="60" alt="Avatar" />
                            <div>
                                <strong id="moderationReviewUser"></strong><br />
                                <span id="moderationReviewStars" class="text-warning"></span><br />
                                <span id="moderationReviewDateTime" class="text-muted small"></span> -
                                <span id="moderationReviewProduct" class="text-muted small fw-bold"></span>
                            </div>
                        </div>
                        <p id="moderationReviewText"></p>
                        <div id="moderationReviewImageContainer" class="mt-2">
                               <img id="moderationReviewImage" src="" class="img-fluid rounded" style="max-width: 150px; height: auto;" alt="Review Image" />
                        </div>
                        <input type="hidden" id="reviewIdToModerate">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success text-white" id="approveReviewBtn">Duyệt</button>
                    <button type="button" class="btn btn-danger text-white" id="rejectReviewBtn">Từ chối</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportFilterModal" tabindex="-1" aria-labelledby="reportFilterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="reportFilterModalLabel">Xuất báo cáo đánh giá</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <div class="mb-3">
                        <label for="reportStartDate" class="form-label">Từ ngày:</label>
                        <input type="date" class="form-control" id="reportStartDate">
                    </div>
                    <div class="mb-3">
                        <label for="reportEndDate" class="form-label">Đến ngày:</label>
                        <input type="date" class="form-control" id="reportEndDate">
                    </div>
                    <div class="mb-3">
                        <label for="reportProductType" class="form-label">Loại sản phẩm:</label>
                        <select class="form-select" id="reportProductType">
                            <option value="">Tất cả</option>
                            <option value="Sườn heo non 300g">Sườn heo non 300g</option>
                            <option value="Xương ống heo 500G">Xương ống heo 500G</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reportRatingLevel" class="form-label">Mức đánh giá:</label>
                        <select class="form-select" id="reportRatingLevel">
                            <option value="">Tất cả</option>
                            <option value="5">5 Sao</option>
                            <option value="4">4 Sao</option>
                            <option value="3">3 Sao</option>
                            <option value="2">2 Sao</option>
                            <option value="1">1 Sao</option>
                        </select>
                    </div>
                    <input type="hidden" id="reportProductId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" id="generateReportBtn">Xuất báo cáo</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportDisplayModal" tabindex="-1" aria-labelledby="reportDisplayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="reportDisplayModalLabel">Báo cáo đánh giá</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <div class="d-flex align-items-center mb-3">
                        <img id="reportProductImage" src="../assets/img/Hot1.png" class="img-thumbnail me-3" width="100" alt="Product Image" />
                        <div class="d-flex flex-column w-100">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <label class="form-label mb-0">Từ ngày:</label>
                                    <span id="displayReportStartDate" class="fw-bold">25/11/2024</span>
                                    <i class="fas fa-calendar-alt text-success ms-1"></i>
                                </div>
                                <div>
                                    <label class="form-label mb-0">Đến ngày:</label>
                                    <span id="displayReportEndDate" class="fw-bold">30/05/2025</span>
                                    <i class="fas fa-calendar-alt text-success ms-1"></i>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <p class="mb-0">Số lượng : <span id="displayReportTotal" class="fw-bold">159</span></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Trung bình sao : <span id="displayReportAverageStars" class="fw-bold">4.9/5</span></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Tỉ lệ duyệt : <span id="displayReportApprovedRate" class="fw-bold">90%</span></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-0">Tỉ lệ ẩn : <span id="displayReportHiddenRate" class="fw-bold">10%</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black fw-bold"> <h5 class="modal-title" id="successModalLabel">Thông báo !</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0" id="successMessage"></p></div>
                    <div class="modal-footer"> <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="logoutConfirmModal" tabindex="-1" aria-labelledby="logoutConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="logoutConfirmModalLabel">Xác nhận đăng xuất</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    Bạn có chắc chắn muốn đăng xuất khỏi hệ thống?
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger text-white" id="confirmLogoutBtn">Đăng xuất</button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hideReviewErrorModal" tabindex="-1" aria-labelledby="hideReviewErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black fw-bold">
                    <h5 class="modal-title" id="hideReviewErrorModalLabel">Thông báo!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <p class="mb-0">Không thể ẩn đánh giá. Vui lòng kiểm tra kết nối hoặc dữ liệu.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Thử lại</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="moderateReviewErrorModal" tabindex="-1" aria-labelledby="moderateReviewErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black fw-bold">
                    <h5 class="modal-title" id="moderateReviewErrorModalLabel">Thông báo!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <p class="mb-0">Không thể duyệt đánh giá. Vui lòng thử lại.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Thử lại</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reportGenerationErrorModal" tabindex="-1" aria-labelledby="reportGenerationErrorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black fw-bold">
                    <h5 class="modal-title" id="reportGenerationErrorModalLabel">Thông báo!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <p class="mb-0">Xuất báo cáo thất bại. Vui lòng kiểm tra kết nối hoặc thử lại sau.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Thử lại</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://kit.fontawesome.com/99651229fa.js"
        crossorigin="anonymous"
    ></script>
    <script src="../assets/js/comment-admin.js"></script>
</body>
</html>