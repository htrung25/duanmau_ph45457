<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center">GIỎ HÀNG CỦA BẠN</h2>

    <?php if (empty($cart)): ?>
        <div class="empty-cart">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h4>Giỏ hàng trống</h4>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <a href="index.php" class="btn btn-primary btn-lg mt-3">
                <i class="fas fa-arrow-left me-2"></i> Tiếp tục mua sắm
            </a>
        </div>
    <?php else: ?>
        <div class="row g-5">
            <!-- Danh sách sản phẩm -->
            <div class="col-lg-8">
                <div class="table-responsive">
                    <table class="table cart-table align-middle">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $id => $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-img me-3">
                                        <div>
                                            <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="fw-bold"><?= number_format($item['price']) ?> ₫</td>
                                <td>
                                        <form action="<?= BASE_URL ?>?action=update_cart" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $id ?>">
                                            <div class="input-group" style="width: 130px;">
                                                <button type="submit" name="action" value="decrease" class="btn quantity-btn">-</button>
                                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" class="form-control quantity-input" min="1" readonly>
                                                <button type="submit" name="action" value="increase" class="btn quantity-btn">+</button>
                                            </div>
                                        </form>
                                </td>
                                <td class="fw-bold text-danger"><?= number_format($item['price'] * $item['quantity']) ?> ₫</td>
                                <td>
                                    <a href="<?= BASE_URL ?>?action=remove_from_cart&id=<?= $id ?>" class="text-danger">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tóm tắt thanh toán -->
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

                    <a href="<?= BASE_URL . '?action=checkout' ?>" class="btn btn-checkout w-100">
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
    <?php endif; ?>
</div>

<style>
        body { background-color: #f8f9fa; }
        .cart-table th { background-color: #f1f1f1; }
        .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; }
        .quantity-btn {
            width: 36px;
            height: 36px;
            border: 1px solid #ddd;
            background: white;
            color: #333;
        }
        .quantity-input { width: 60px; text-align: center; }
        .summary-card { box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px; }
        .btn-checkout {
            background: #28a745;
            color: white;
            font-weight: bold;
            padding: 12px;
            font-size: 1.1rem;
        }
        .btn-checkout:hover { background: #218838; }
        .empty-cart { text-align: center; padding: 60px 20px; color: #666; }
</style>