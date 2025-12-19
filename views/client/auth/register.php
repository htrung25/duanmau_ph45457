<?php
// Register form view
?>
<div class="col-12 col-md-6 offset-md-3">
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-3">Đăng ký</h4>
            <form method="POST" action="<?= BASE_URL . '?action=register_post' ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên người dùng</label>
                    <input type="text" class="form-control" id="username" name="username" required value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-success">Đăng ký</button>
                    <a href="<?= BASE_URL . '?action=login' ?>">Đã có tài khoản? Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>
</div>
