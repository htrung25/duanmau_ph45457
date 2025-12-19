<a href="<?= BASE_URL_ADMIN . '&action=create-category' ?>" class="btn btn-success">Tạo mới</a>
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
			<th>Tên</th>
			<th>Hành động</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $cat): ?>
		<tr>
			<td><?= $cat['id'] ?></td>
			<td><?= htmlspecialchars($cat['name']) ?></td>
			<td>
				<a href="<?= BASE_URL_ADMIN . '&action=edit-category&id=' . $cat['id'] ?>" class="btn btn-success">Sửa</a>
				<a href="<?= BASE_URL_ADMIN . '&action=delete-category&id=' . $cat['id'] ?>" onclick="return confirm('Có chắc chắn muốn xóa không?');" class="btn btn-danger">Xóa</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>