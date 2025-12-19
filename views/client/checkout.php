<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">THANH TOÁN ĐƠN HÀNG</h2>

    <div class="row g-5">
        <!-- Form thông tin khách hàng -->
        <div class="col-lg-8">
            <div class="checkout-card bg-white p-4 p-md-5">
                <h4 class="mb-4">Thông tin giao hàng</h4>
                <form action="process_order.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="3" name="address" required></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ghi chú (tùy chọn)</label>
                            <textarea class="form-control" rows="2" name="note"></textarea>
                        </div>
                    </div>

                    <h4 class="mt-5 mb-4">Phương thức thanh toán</h4>
                    <div class="border rounded p-3 mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                            <label class="form-check-label fw-bold" for="cod">
                                <i class="fas fa-money-bill-wave me-2"></i> Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="radio" name="payment" id="bank" value="bank">
                            <label class="form-check-label fw-bold" for="bank">
                                <i class="fas fa-university me-2"></i> Chuyển khoản ngân hàng
                            </label>
                            <small class="text-muted d-block mt-2 ms-4">
                                Ngân hàng: Vietcombank<br>
                                STK: 1234567890<br>
                                Chủ tài khoản: Nguyễn Văn A
                            </small>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tóm tắt đơn hàng -->
        <div class="col-lg-4">
                <div class="summary-card bg-white p-4">
                    <h4 class="mb-4">Tóm tắt đơn hàng</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Tạm tính</span>
                        <span><?= number_format($total) ?> ₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Phí vận chuyển</span>
                        <span><?= number_format($shipping) ?> ₫</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 text-danger mb-4">
                        <span>Tổng cộng</span>
                        <span><?= number_format($grand_total) ?> ₫</span>
                    </div>

                    <a href=" #>" class="btn btn-checkout w-100">
                        <i class="fas fa-credit-card me-2"></i> TIẾN HÀNH THANH TOÁN
                    </a>

                    <div class="text-center mt-3">
                        <a href="<?= BASE_URL ?>" class="text-muted">
                            <i class="fas fa-arrow-left me-1"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>





<style>
        body { background-color: #f8f9fa; }
        .checkout-card { box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px; }
        .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .summary { background: #fff; border-radius: 10px; padding: 20px; }
        .btn-checkout {
            background: #28a745;
            color: white;
            font-weight: bold;
            padding: 12px;
            font-size: 1.1rem;
        }
        .btn-checkout:hover { background: #218838; }
        .btn-place-order:hover { background: #218838; }
</style>