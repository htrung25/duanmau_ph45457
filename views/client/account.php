<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<div class="card p-4">
    <h3>Thông tin tài khoản</h3>
    <form method="POST" action="<?= BASE_URL . '?action=account_update' ?>">
        <div class="mb-3">
            <label class="form-label">Tên người dùng</label>
            <input type="text" name="username" class="form-control" required value="<?= htmlspecialchars($data['username'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($data['email'] ?? '') ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Mật khẩu mới (để trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Lưu thay đổi</button>
    </form>
</div>
