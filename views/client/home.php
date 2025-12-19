<!-- Slideshow -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="assets/uploads/slide1.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/uploads/slide2.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/uploads/slide3.webp" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="assets/uploads/slide4.webp" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- Hết slide -->
<style>
    .product-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .product-img {
        width: 100%;
        height: 260px;
        object-fit: contain;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .badge-new {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #ff3b30;
        color: white;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .badge-sale {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #0071e3;
        color: white;
        font-size: 0.8rem;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: 600;
    }

    .product-title {
        font-size: 1.05rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        height: 52px;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: bold;
        color: #d70018;
    }

    .old-price {
        font-size: 1rem;
        color: #999;
        text-decoration: line-through;
        margin-left: 8px;
    }

    .btn-buy {
        background: #0071e3;
        color: white;
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-weight: 600;
        margin-top: auto;
    }

    .btn-buy:hover {
        background: #005bb5;
    }
</style>
<!-- Khu vực top 4 sản phẩm moi -->
<h3 class="mt-3">Sản phẩm mới</h3>
<div class="row">
    <?php foreach ($top4Lasted as $pro): ?>
        <div class="col">
            <div class="card product-card position-relative">
                <!-- Badge (tùy chọn) -->
                <span class="badge-new">Mới</span>
                <span class="badge-sale">Giảm giá</span>

                <!-- Hình ảnh sản phẩm -->
                <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="text-decoration-none">
                    <img src="<?= BASE_ASSETS_UPLOADS . $pro['img'] ?>" alt="" class="product-img">
                </a>

                <!-- Nội dung -->
                <div class="card-body d-flex flex-column p-4">
                    <h3 class="product-title">
                        <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="text-decoration-none text-dark">
                            <?= $pro['name'] ?>
                        </a>
                    </h3>
                    <div class="text-muted mb-2">Danh mục: <?= $pro['cat_name'] ?></div>

                    <div class="mt-auto">
                        <!-- Giá -->
                        <div class="mb-3">
                            <span class="product-price"><?= number_format($pro['price'], 0, ',', '.') ?>₫</span>
                        </div>

                        <!-- Nút hành động -->
                        <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="btn btn-buy w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<!-- Het Khu Vuc 4 San Pham Moi -->
<!-- Khu vu top 4 san pham yeu thich -->
<h3 class="mt-3">Sản phẩm yêu thích</h3>
<div class="row">
    <?php foreach ($top4View as $pro): ?>
        <div class="col">
            <div class="card product-card position-relative">
                <!-- Badge (tùy chọn) -->
                <span class="badge-new">Mới</span>
                <span class="badge-sale">Giảm giá</span>

                <!-- Hình ảnh sản phẩm -->
                <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="text-decoration-none">
                    <img src="<?= BASE_ASSETS_UPLOADS . $pro['img'] ?>" alt="" class="product-img">
                </a>

                <!-- Nội dung -->
                <div class="card-body d-flex flex-column p-4">
                    <h3 class="product-title">
                        <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="text-decoration-none text-dark">
                            <?= $pro['name'] ?>
                        </a>
                    </h3>
					<div class="text-muted mb-2">Danh mục: <?= htmlspecialchars($pro['cat_name']) ?></div>

                    <div class="mt-auto">
                        <!-- Giá -->
                        <div class="mb-3">
                            <span class="product-price"><?= number_format($pro['price'], 0, ',', '.') ?>₫</span>
                        </div>

                        <!-- Nút hành động -->
                        <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro['id'] ?>" class="btn btn-buy w-100">
                            Xem chi tiết
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<!-- Het khu vuc top 4 san pham yeu thich -->