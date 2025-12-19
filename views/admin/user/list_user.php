<div class="d-flex justify-content-between mb-2">
    <div>
        <a href="<?= BASE_URL_ADMIN . '&action=create-user' ?>" class="btn btn-success">Tạo mới</a>
        <a href="<?= BASE_URL_ADMIN ?>" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success mt-2"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger mt-2"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<table class="table table-striped mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($data)): foreach($data as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= ((int)($u['is_main'] ?? 0)) ? 'Admin' : 'User' ?></td>
            <td>
                <a href="<?= BASE_URL_ADMIN . '&action=edit-user&id=' . $u['id'] ?>" class="btn btn-sm btn-primary">Sửa</a>
                <a href="<?= BASE_URL_ADMIN . '&action=delete-user&id=' . $u['id'] ?>" onclick="return confirm('Có chắc chắn muốn xóa tài khoản này?');" class="btn btn-sm btn-danger">Xóa</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <tr><td colspan="5">Không có tài khoản nào.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
