<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars($data['name']) ?></h5>
        <a href="<?= BASE_URL_ADMIN . '&action=edit-category&id=' . $data['id'] ?>" class="btn btn-success">Sửa</a>
        <a href="<?= BASE_URL_ADMIN . '&action=list-category' ?>" class="btn btn-secondary">Quay lại</a>
    </div>
</div>
