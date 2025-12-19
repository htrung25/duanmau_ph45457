<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL_ADMIN . '&action=update-user' ?>">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($data['username'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Password (để trống nếu không đổi)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_main" id="is_main" <?= ((int)($data['is_main'] ?? 0)) ? 'checked' : '' ?> >
        <label class="form-check-label" for="is_main">Admin</label>
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>
