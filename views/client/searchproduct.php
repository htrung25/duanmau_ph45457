<div class="container py-4">
	<h2 class="mb-4">Kết quả tìm kiếm cho: "<?= isset($search_term) ? htmlspecialchars($search_term) : '' ?>"</h2>

	<?php if (!empty($products) && count($products) > 0): ?>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
			<?php foreach ($products as $p): ?>
				<div class="col">
					<div class="card h-100">
						<a href="<?= BASE_URL . '?action=detail-product&id=' . $p['id'] ?>" class="text-decoration-none">
							<img src="<?= BASE_ASSETS_UPLOADS . $p['img'] ?>" class="card-img-top" alt="<?= htmlspecialchars($p['name']) ?>" style="object-fit:contain; height:220px; padding:20px; background:#fafafa;">
						</a>
						<div class="card-body d-flex flex-column">
							<h5 class="card-title mb-2"><a href="<?= BASE_URL . '?action=detail-product&id=' . $p['id'] ?>" class="text-decoration-none text-dark"><?= htmlspecialchars($p['name']) ?></a></h5>
								<div class="text-muted mb-2">Danh mục: <?= htmlspecialchars($p['cat_name']) ?></div>
							<div class="mt-auto d-flex justify-content-between align-items-center">
								<div class="fw-bold text-danger"><?= number_format($p['price'], 0, ',', '.') ?>₫</div>
								<a href="<?= BASE_URL . '?action=detail-product&id=' . $p['id'] ?>" class="btn btn-primary">Xem Chi Tiết</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<div class="alert alert-info">Không tìm thấy sản phẩm nào phù hợp với từ khóa "<strong><?= isset($search_term) ? htmlspecialchars($search_term) : '' ?></strong>".</div>
	<?php endif; ?>
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