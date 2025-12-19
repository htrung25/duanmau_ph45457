<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Home' ?></title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-2 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <h5 class="px-3 mb-3">Admin</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Thống kê</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN . '&action=list-product' ?>">Quản lý sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN . '&action=list-category' ?>">Quản lý danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN . '&action=list-user' ?>">Quản lý tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN . '&action=list-comment' ?>">Quản lý bình luận</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= $title ?? 'Home' ?></h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <?php
                        if (isset($view)) {
                            require_once PATH_VIEW_ADMIN . $view . '.php';
                        }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>

</html>