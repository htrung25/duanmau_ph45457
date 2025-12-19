<div class="container">
    <div class="container py-5">
        <!-- Tiêu đề trang -->
        <h2 class="mb-4 fw-bold">Tất cả sản phẩm</h2>

        <!-- Bộ lọc (sắp xếp + lọc) -->
        <div class="row mb-4">
            <div class="col-md-12">
                <form method="get" class="row g-2 align-items-end">
                    <input type="hidden" name="action" value="listproduct">
                    <div class="col-md-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category_id" class="form-select">
                            <option value="">Tất cả</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?php if(isset($categoryId) && $categoryId == $cat['id']) echo 'selected'; ?>><?= htmlspecialchars($cat['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Khoảng giá (VNĐ)</label>
                        <div class="d-flex">
                            <input type="number" name="min_price" class="form-control me-2" placeholder="Từ" value="<?= htmlspecialchars($minPrice ?? '') ?>">
                            <input type="number" name="max_price" class="form-control" placeholder="Đến" value="<?= htmlspecialchars($maxPrice ?? '') ?>">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Từ khoá</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Tên hoặc mô tả" value="<?= htmlspecialchars($keyword ?? '') ?>">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Sắp xếp</label>
                        <select name="sort" class="form-select">
                            <option value="newest" <?php if (!isset($currentSort) || $currentSort === 'newest') echo 'selected'; ?>>Mới nhất</option>
                            <option value="price_asc" <?php if (isset($currentSort) && $currentSort === 'price_asc') echo 'selected'; ?>>Giá: Thấp→Cao</option>
                            <option value="price_desc" <?php if (isset($currentSort) && $currentSort === 'price_desc') echo 'selected'; ?>>Giá: Cao→Thấp</option>
                            <option value="name_asc" <?php if (isset($currentSort) && $currentSort === 'name_asc') echo 'selected'; ?>>Tên A→Z</option>
                            <option value="name_desc" <?php if (isset($currentSort) && $currentSort === 'name_desc') echo 'selected'; ?>>Tên Z→A</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button class="btn btn-primary w-100">Lọc</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

    <!-- Bootstrap JS -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">

        <!-- ===== MỘT Ô SẢN PHẨM ===== -->
        <?php foreach ($allProducts as $pro): ?>
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
</div>