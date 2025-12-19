<div class="card mb-3" style="max-width: 900px;">
    <div class="row g-0">
        <div class="col-md-4 d-flex align-items-center justify-content-center p-3">
            <?php if (!empty($data['img'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $data['img'] ?>" class="img-fluid" alt="">
            <?php else: ?>
                <div class="text-muted">No image</div>
            <?php endif; ?>
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($data['name']) ?></h5>
                <p class="card-text"><strong>Danh mục:</strong> <?= htmlspecialchars($data['cat_name'] ?? '') ?></p>
                <p class="card-text"><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($data['description'] ?? '')) ?></p>
                <p class="card-text"><strong>Giá:</strong> <?= number_format($data['price'] ?? 0) ?></p>
                <p class="card-text"><strong>Số lượng:</strong> <?= intval($data['quantity'] ?? 0) ?></p>
                <p class="card-text"><strong>View count:</strong> <?= intval($data['view_count'] ?? 0) ?></p>

                <a href="<?= BASE_URL_ADMIN . '&action=edit-product&id=' . $data['id'] ?>" class="btn btn-success">Sửa</a>
                <a href="<?= BASE_URL_ADMIN . '&action=list-product' ?>" class="btn btn-secondary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
