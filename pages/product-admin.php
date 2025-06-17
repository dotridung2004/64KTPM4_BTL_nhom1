<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý sản phẩm - HomeFood Admin</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../assets/css/product-admin.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row topbar text-center position-relative">
            <div class="col fw-bold text-center" style="color:white">Trang chủ</div>
            <div class="position-absolute end-0 pe-4 icons ">
                <i class="fas fa-search" style="margin-left:1500px;"></i>
                <i class="fas fa-user"></i>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-3 col-lg-2">
                <div class="sidebar">
                    <img src="../assets/img/logo.png" alt="HomeFood Logo">
                    <a href="#" class="active">Quản lý sản phẩm</a>
                    <a href="comment-admin.php">Quản lý đánh giá sản phẩm</a>
                    <a href="#">Chương trình khuyến mãi</a>
                    <a href="#">Tin tức</a>
                </div>
            </div>

            <div class="col-md-9 col-lg-10">
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm sản phẩm</button>
                </div>

                <div id="productList" class="product-list-container">
                    <div class="product-card" id="product-1">
                        <img src="../assets/img/Hot1.png" alt="Sườn heo non 300g" />
                        <div class="product-info">
                            <div class="d-flex justify-content-between">
                                <div class="name fw-bold">Sườn heo non 300g</div>
                                <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: 100</div>
                            </div>
                            <div class="price">Giá: 103.000đ</div>
                        </div>
                        <div class="actions">
                            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="product-1">Sửa</a>
                            <a href="#" class="delete delete-btn" data-id="product-1">Xóa</a>
                        </div>
                    </div>

                    <div class="product-card" id="product-2">
                        <img src="../assets/img/Hot2.png" alt="Ba rọi heo 300g">
                        <div class="product-info">
                            <div class="d-flex justify-content-between">
                                <div class="name fw-bold">Ba rọi heo 300g</div>
                                <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: 100</div>
                            </div>
                            <div class="price">Giá: 118.000đ</div>
                        </div>
                        <div class="actions">
                            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="product-2">Sửa</a>
                            <a href="#" class="delete delete-btn" data-id="product-2">Xóa</a>
                        </div>
                    </div>

                    <div class="product-card" id="product-3">
                        <img src="../assets/img/Hot3.png" alt="Ba rọi rút sườn heo 500g">
                        <div class="product-info">
                            <div class="d-flex justify-content-between">
                                <div class="name fw-bold">Sườn rọi rút sườn heo 500g</div>
                                <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: 100</div>
                            </div>
                            <div class="price">Giá: 103.000đ</div>
                        </div>
                        <div class="actions">
                            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="product-3">Sửa</a>
                            <a href="#" class="delete delete-btn" data-id="product-3">Xóa</a>
                        </div>
                    </div>

                    <div class="product-card" id="product-4">
                        <img src="../assets/img/Hot4.png" alt="Xương ống heo 500g">
                        <div class="product-info">
                            <div class="d-flex justify-content-between">
                                <div class="name fw-bold">Xương ống heo 500g</div> <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: 100</div>
                            </div>
                            <div class="price">Giá: 103.000đ</div>
                        </div>
                        <div class="actions">
                            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="product-4">Sửa</a>
                            <a href="#" class="delete delete-btn" data-id="product-4">Xóa</a>
                        </div>
                    </div>

                    <div class="product-card" id="product-5">
                        <img src="../assets/img/Hot5.png" alt="Nạc dăm heo 1KG">
                        <div class="product-info">
                            <div class="d-flex justify-content-between">
                                <div class="name fw-bold">Nạc dăm heo 1KG</div> <div class="quantity" style="margin-top: 30px;margin-right: 80px;">SL: 100</div>
                            </div>
                            <div class="price">Giá: 103.000đ</div>
                        </div>
                        <div class="actions">
                            <a href="#" class="edit edit-btn" data-bs-toggle="modal" data-bs-target="#editProductModal" data-id="product-5">Sửa</a>
                            <a href="#" class="delete delete-btn" data-id="product-5">Xóa</a>
                        </div>
                    </div>
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
    <br>
    <br>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4" style="background-color: #e4e4e4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center fw-bold text-danger" id="modalTitle">Thêm sản phẩm mới</h5>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <input type="hidden" id="productIdToEdit">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tên sản phẩm:</label>
                                <input type="text" id="productName" class="form-control" placeholder="Nhập tên sản phẩm">
                                <div class="invalid-feedback" id="productNameError">Không được bỏ trống trường này</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số lượng:</label>
                                <input type="number" id="productQuantity" class="form-control" placeholder="Nhập số lượng sản phẩm" min="1"> <div class="invalid-feedback" id="productQuantityError">Không được bỏ trống và phải là số nguyên dương</div> </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="productDesc" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
                            <div class="invalid-feedback" id="productDescError">Không được bỏ trống trường này</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Giá:</label>
                                <input type="number" id="productPrice" class="form-control" min="0"> <div class="invalid-feedback" id="productPriceError">Không được bỏ trống và phải lớn hơn 0</div> </div>
                            <div class="col-md-4">
                                <label class="form-label">Danh mục:</label>
                                <select id="productCategory" class="form-select">
                                    <option value="">Chọn danh mục</option>
                                    <option>Thịt-Cá-Trứng-Thủy hải sản</option>
                                    <option>Sản phẩm đông lạnh</option>
                                    <option>Rau củ quả</option>
                                </select>
                                <div class="invalid-feedback" id="productCategoryError">Vui lòng chọn danh mục</div> </div>
                            <div class="col-md-4">
                                <label class="form-label">Thương hiệu:</label>
                                <input type="text" id="productBrand" class="form-control" placeholder="Thương hiệu">
                                <div class="invalid-feedback" id="productBrandError">Không được bỏ trống trường này</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thêm hình ảnh:</label><br>
                            <input type="file" id="productImage" class="form-control w-50">
                            <img id="currentProductImage" src="" alt="Ảnh sản phẩm hiện tại" class="mt-2" style="max-width: 150px; display: none;">
                            <div class="invalid-feedback" id="productImageError">Vui lòng chọn hình ảnh</div> </div>

                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <button type="submit" class="btn btn-success px-5 rounded-pill">Lưu</button>
                            <button type="button" class="btn btn-outline-danger px-5 rounded-pill" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-4" style="background-color: #e4e4e4;">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center fw-bold text-danger" id="editModalTitle">Sửa thông tin sản phẩm</h5>
                </div>
                <div class="modal-body">
                    <form id="editProductForm">
                        <input type="hidden" id="editProductId"> <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Tên sản phẩm:</label>
                                <input type="text" id="editProductName" class="form-control" placeholder="Nhập tên sản phẩm">
                                <div class="invalid-feedback" id="editProductNameError">Không được bỏ trống trường này</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số lượng:</label>
                                <input type="number" id="editProductQuantity" class="form-control" placeholder="Nhập số lượng sản phẩm" min="1">
                                <div class="invalid-feedback" id="editProductQuantityError">Không được bỏ trống và phải là số nguyên dương</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="editProductDesc" rows="4" placeholder="Nhập mô tả sản phẩm..."></textarea>
                            <div class="invalid-feedback" id="editProductDescError">Không được bỏ trống trường này</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Giá:</label>
                                <input type="number" id="editProductPrice" class="form-control" min="0">
                                <div class="invalid-feedback" id="editProductPriceError">Không được bỏ trống và phải lớn hơn 0</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Danh mục:</label>
                                <select id="editProductCategory" class="form-select">
                                    <option value="">Chọn danh mục</option>
                                    <option>Thịt-Cá-Trứng-Thủy hải sản</option>
                                    <option>Sản phẩm đông lạnh</option>
                                    <option>Rau củ quả</option>
                                </select>
                                <div class="invalid-feedback" id="editProductCategoryError">Vui lòng chọn danh mục</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Thương hiệu:</label>
                                <input type="text" id="editProductBrand" class="form-control" placeholder="Thương hiệu">
                                <div class="invalid-feedback" id="editProductBrandError">Không được bỏ trống trường này</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hình ảnh hiện tại:</label><br>
                            <img id="editCurrentProductImage" src="" alt="Ảnh sản phẩm hiện tại" class="mt-2" style="max-width: 150px;">
                            <label class="form-label mt-3">Chọn hình ảnh mới (nếu muốn thay đổi):</label><br>
                            <input type="file" id="editProductImage" class="form-control w-50">
                            <div class="invalid-feedback" id="editProductImageError">Vui lòng chọn hình ảnh</div>
                        </div>

                        <div class="d-flex justify-content-center gap-4 mt-4">
                            <button type="submit" class="btn btn-success px-5 rounded-pill">Lưu thay đổi</button>
                            <button type="button" class="btn btn-outline-danger px-5 rounded-pill" data-bs-dismiss="modal">Hủy</button>
                        </div>
                    </form>
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
                    <p class="mb-0" id="successMessage">Thêm sản phẩm thành công.</p></div>
                    <div class="modal-footer"> <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-black">
                    <h5 class="modal-title fw-bold" id="confirmDeleteModalLabel">Thông báo !</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-black">
                    <p>Bạn có chắc chắn muốn xóa sản phẩm ?</p>
                    <input type="hidden" id="productIdToDelete"> </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success text-white" id="confirmDeleteBtn">Xác nhận</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Hủy</button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php' ?>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"
    ></script>
    <script src="../assets/js/product-admin.js"></script>
    <script
        src="https://kit.fontawesome.com/99651229fa.js"
        crossorigin="anonymous"
    ></script>
</body>
</html>