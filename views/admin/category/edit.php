<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
<form action="<?= BASE_URL_ADMIN . '&action=update-category' ?>" method="POST">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($data['name']) ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả (tùy chọn)</label>
        <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Cập nhật</button>
</form>
