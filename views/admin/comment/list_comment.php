<?php if(isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
<?php endif; ?>
<?php if(isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
<?php endif; ?>

<a href="<?= BASE_URL_ADMIN ?>" class="btn btn-secondary mb-3">Quay lại Dashboard</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Người dùng</th>
            <th>Nội dung</th>
            <th>Ngày</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= htmlspecialchars($c['product_name'] ?? '') ?></td>
            <td><?= htmlspecialchars($c['username'] ?? '') ?></td>
            <td><?= nl2br(htmlspecialchars($c['content'])) ?></td>
            <td><?= htmlspecialchars($c['created_at'] ?? $c['id']) ?></td>
            <td>
                <a href="<?= BASE_URL_ADMIN . '&action=delete-comment&id=' . $c['id'] ?>" onclick="return confirm('Xóa bình luận này?');" class="btn btn-sm btn-danger">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
