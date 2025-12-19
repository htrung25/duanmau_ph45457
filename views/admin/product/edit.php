<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form action="<?= BASE_URL_ADMIN . '&action=update-product' ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['product']['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Tên:</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['product']['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Danh mục:</label>
        <select name="category_id" class="form-control">
            <?php foreach ($data['categories'] as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?php if ($cat['id'] == $data['product']['category_id']) echo 'selected'; ?>><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả:</label>
        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($data['product']['description']) ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Giá:</label>
        <input type="number" name="price" class="form-control" value="<?= htmlspecialchars($data['product']['price']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Số lượng:</label>
        <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($data['product']['quantity']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ảnh hiện tại:</label>
        <div>
            <?php if (!empty($data['product']['img'])): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . $data['product']['img'] ?>" alt="" width="120">
            <?php else: ?>
                <div class="text-muted">Chưa có ảnh</div>
            <?php endif; ?>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Thay ảnh mới (tùy chọn):</label>
        <input type="file" name="img" class="form-control">
    </div>
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>
