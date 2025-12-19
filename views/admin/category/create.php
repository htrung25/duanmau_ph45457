<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>
<form action="<?= BASE_URL_ADMIN . '&action=store-category' ?>" method="POST">
    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Mô tả (tùy chọn)</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <button class="btn btn-primary" type="submit">Lưu</button>
</form>
