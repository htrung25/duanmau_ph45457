<div class="container py-5">

    <div class="row mt-4">
        <!-- Hình ảnh sản phẩm -->
        <div class="col-lg-6">
            <!-- Ảnh chính -->
            <div class="text-center mb-4">
                <img src="<?= BASE_ASSETS_UPLOADS . $pro['img'] ?>" 
                     alt="" class="img-fluid" id="mainImage">
            </div>
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-lg-6">
            <h1 class="h3 fw-bold"><?= $pro['name'] ?></h1>

            <!-- Giá -->
            <div class="mb-4">
                <span class="product-price"><?= number_format($pro['price'], 0, ',', '.') ?>₫</span>
                <div class="text-muted small">(Đã bao gồm VAT)</div>
            </div>
            <!-- Chọn màu sắc -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Màu sắc</label><br>
                <span class="color-circle color-white active me-3" data-color="white"></span>
                <span class="color-circle color-orange me-3" data-color="orange"></span>
                <span class="color-circle color-blue" data-color="blue"></span>
            </div>

            <!-- Cửa hàng có sẵn -->
            <div class="alert alert-info small py-2">
                <i class="fas fa-store me-2"></i> Cửa hàng có sẵn sản phẩm
            </div>

            <!-- Nút mua hàng -->
            <div class="mb-4">
                <form method="POST" action="<?= BASE_URL ?>?action=add_to_cart">
                    <input type="hidden" name="id" value="<?= $pro['id'] ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn buy-btn w-100 mb-3">MUA NGAY</button>
                </form>

                <div class="row g-2">
                    <div class="col">
                        <button class="btn installment-btn w-100">Mua trả góp 0%<br><small>Qua công ty tài chính</small></button>
                    </div>
                    <div class="col">
                        <button class="btn installment-btn w-100">Trả góp 0% qua thẻ<br><small>Visa, Mastercard, JCB, Amex</small></button>
                    </div>
                </div>
            </div>

            <!-- Thu cũ đổi mới -->
            <div class="border rounded p-3 mb-4 text-center">
                <a href="#" class="text-decoration-none text-primary fw-semibold">
                    <i class="fas fa-sync-alt me-2"></i> Thu cũ đổi mới
                </a>
            </div>

            <!-- Thông tin bổ sung -->
            <div class="info-item"><i class="fas fa-check text-primary me-2"></i> Bộ sản phẩm gồm: Hộp, Sách hướng dẫn, Cây lấy sim, Cáp Type C</div>
            <div class="info-item"><i class="fas fa-check text-primary me-2"></i> Miễn phí 1 đổi 1 trong 30 ngày đầu tiên (nếu có lỗi do NSX)</div>
            <div class="info-item"><i class="fas fa-check text-primary me-2"></i> Bảo hành chính hãng 1 năm (chi tiết)</div>
            <div class="info-item"><i class="fas fa-check text-primary me-2"></i> Giao hàng nhanh toàn quốc (chi tiết)</div>
            <div class="info-item"><i class="fas fa-check text-primary me-2"></i> Tax Refund for Foreigners (detail)</div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Đổi ảnh chính khi click thumbnail
    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
        document.querySelectorAll('.thumbnail-img').forEach(img => img.classList.remove('active'));
        element.classList.add('active');
    }
</script>
<style>
        body { background-color: #f8f8f8; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .product-price { font-size: 2rem; font-weight: bold; color: #d70018; }
        .old-price { font-size: 1.5rem; color: #999; text-decoration: line-through; margin-left: 10px; }
        .capacity-btn { border: 1px solid #ddd; border-radius: 8px; padding: 8px 20px; margin-right: 10px; }
        .capacity-btn.active { border-color: #0071e3; background-color: #f5f9ff; color: #0071e3; }
        .color-circle { width: 32px; height: 32px; border-radius: 50%; display: inline-block; border: 2px solid transparent; cursor: pointer; }
        .color-circle.active { border-color: #0071e3; }
        .color-white { background-color: #f0f0f0; }
        .color-orange { background-color: #d98c5a; }
        .color-blue { background-color: #3c3c6e; }
        .buy-btn { background-color: #0071e3; color: white; font-size: 1.2rem; padding: 12px 40px; border-radius: 12px; }
        .installment-btn { border: 1px solid #0071e3; color: #0071e3; background: white; border-radius: 12px; padding: 10px 20px; }
        .info-item { margin-bottom: 12px; }
        .thumbnail-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; cursor: pointer; opacity: 0.7; }
        .thumbnail-img.active { opacity: 1; border: 2px solid #0071e3; }
    </style>

<!-- Comments Section -->
<div class="container py-4">
    <div class="card mb-3">
        <div class="card-body">
            <h5>Bình luận</h5>

            <?php if(!empty($comments)): foreach($comments as $c): ?>
                <div class="border rounded p-3 mb-2">
                    <div class="small text-muted"><?= htmlspecialchars($c['username'] ?? 'Khách') ?> · <?= htmlspecialchars($c['created_at'] ?? $c['id']) ?></div>
                    <div class="mt-2"><?= nl2br(htmlspecialchars($c['content'])) ?></div>
                </div>
            <?php endforeach; else: ?>
                <div class="text-muted">Chưa có bình luận nào.</div>
            <?php endif; ?>

            <?php if(!empty($_SESSION['user'])): ?>
                <form method="POST" action="<?= BASE_URL . '?action=post_comment' ?>" class="mt-3">
                    <input type="hidden" name="product_id" value="<?= $pro['id'] ?>">
                    <div class="mb-2">
                        <textarea name="content" class="form-control" rows="3" placeholder="Viết bình luận..." required></textarea>
                    </div>
                    <button class="btn btn-primary">Gửi bình luận</button>
                </form>
            <?php else: ?>
                <div class="mt-3">
                    <a href="<?= BASE_URL . '?action=login' ?>" class="btn btn-outline-primary">Đăng nhập để bình luận</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>