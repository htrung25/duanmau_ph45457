<div class="header-top">
    <style>
        .header-top .icons a { color: #fff; margin-right: 1rem; display: inline-flex; align-items: center; text-decoration: none; }
        .header-top .icons a i { font-size: 1.25rem; margin-right: .5rem; }
        .header-top .icons .language-flag { width: 24px; height: auto; border-radius: 2px; }
        @media (max-width: 768px) {
            .header-top .icons a span { display: none; }
        }
    </style>
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-lg-2 col-md-3 col-6 text-start">
                <a href="<?= BASE_URL ?>" class="d-flex align-items-center text-white text-decoration-none">
                    <img src="assets/uploads/logo1.png" alt="Logo" class="logo-img me-2">
                </a>
            </div>

            <!-- Search Bar -->
            <div class="col-lg-6 col-md-6 col-12 mx-auto my-3 my-md-0">
                <div class="search-container mx-auto position-relative">
                    <form class="search" method="GET" action="<?= BASE_URL . '?action=searchproduct' ?>">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="hidden" name="action" value="search">
                        <input type="text" name="q" class="form-control search-bar" placeholder="Bạn tìm gì..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                    </form>
                </div>
            </div>

            <!-- Icons Right -->
            <div class="col-lg-4 col-md-3 col-6 text-end icons">
                <?php if (!empty($_SESSION['user'])): ?>
                    <a href="<?= BASE_URL . '?action=cart' ?>" class="text-white">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="d-none d-md-inline ms-1">Giỏ hàng</span>
                    </a>
                    <a href="<?= BASE_URL . '?action=account' ?>" class="text-white">
                        <i class="fas fa-user-circle"></i>
                        <span class="d-none d-md-inline ms-1">Tài khoản</span>
                    </a>
                    <a href="<?= BASE_URL ?>?action=logout" class="text-white">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="d-none d-md-inline ms-1">Đăng xuất (<?= htmlspecialchars($_SESSION['user']['username'] ?? $_SESSION['user']['email']) ?>)</span>
                    </a>
                <?php else: ?>
                    <a href="<?= BASE_URL . '?action=cart' ?>" class="text-white">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="d-none d-md-inline ms-1">Giỏ hàng</span>
                    </a>
                    <a href="<?= BASE_URL . '?action=login' ?>" class="text-white">
                        <i class="fas fa-user"></i>
                        <span class="d-none d-md-inline ms-1">Đăng nhập</span>
                    </a>
                    <a href="<?= BASE_URL . '?action=register' ?>" class="text-white">
                        <i class="fas fa-user-plus"></i>
                        <span class="d-none d-md-inline ms-1">Đăng ký</span>
                    </a>
                <?php endif; ?>
                <a href="#" class="text-decoration-none">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/21/Flag_of_Vietnam.svg" alt="VN" class="language-flag">
                </a>
                <a href="#" class="text-decoration-none ms-2">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="US" class="language-flag">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Navigation Bottom -->
<div class="nav-bottom">
    <div class="container">
        <div class="row align-items-center">

            <!-- Menu Items -->
            <div class="col-lg-12 col-10">
                <ul class="nav justify-content-center">
                    <li class="nav-item d-lg-block d-none">
                        <a class="nav-link" href="<?= BASE_URL . '?action=listproduct' ?>">Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_iphone&catname=iphone' ?>">iPhone</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_oppo&catname=oppo' ?>">Oppo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_samsung&catname=samsung' ?>">SamSung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_asus&catname=asus' ?>">Asus</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_hp&catname=hp' ?>">HP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL . '?action=catname_product_appawatch&catname=applewatch' ?>">Apple Watch</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>