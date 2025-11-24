<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Danh mục</th>
            <th>Mô tả</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $pro): ?>
        <tr>
            <td><?= $pro["id"] ?></td>
            <td>
                <img src="<?= BASE_ASSETS_UPLOADS . $pro['img']?>" alt="" width="50">
            </td>
            <td><?= $pro["name"] ?></td>
            <td><?= $pro["cat_name"] ?></td>
            <td><?= $pro["description"] ?></td>
            <td><?= $pro["price"] ?></td>
            <td><?= $pro["quantity"] ?></td>
            <td>
                <button type="button" class="btn btn-primary">Xem</button>
                <button type="button" class="btn btn-success">Sửa</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>