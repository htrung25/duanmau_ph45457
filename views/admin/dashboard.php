<div class="row">
    <div class="col-12">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Sản phẩm</h5>
                        <p class="card-text display-6"><?= number_format($counts['products'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục</h5>
                        <p class="card-text display-6"><?= number_format($counts['categories'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Tài khoản</h5>
                        <p class="card-text display-6"><?= number_format($counts['users'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Bình luận</h5>
                        <p class="card-text display-6"><?= number_format($counts['comments'] ?? 0) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
