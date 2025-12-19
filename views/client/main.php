<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Home' ?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="views/client/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <style>
        .header-top {
            background-color: #2d2d2d;
            color: white;
            padding: 1rem 0;
        }

        .search-bar {
            max-width: 500px;
            border-radius: 50px;
            border: none;
            padding-left: 2.5rem;
            background-color: white;
        }

        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .nav-bottom {
            background-color: #3a3a3a;
            padding: 0.75rem 0;
        }

        .nav-bottom .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
        }

        .nav-bottom .nav-link:hover {
            color: #ff0000 !important;
        }

        .language-flag {
            width: 24px;
            height: 16px;
            object-fit: cover;
        }

        .logo-img {
            height: 50px;
        }

        .authorised-text {
            font-size: 0.8rem;
            margin-left: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- header -->
    <div>
        <?php require_once PATH_VIEW_CLIENT . 'header.php'; ?>
    </div>
    <!-- end header -->

    <div class="container">
        <h1 class="mt-3 mb-3"><?= $title ?? '' ?></h1>

        <div class="row">
            <?php
            if (isset($view)) {
                require_once PATH_VIEW_CLIENT . $view . '.php';
            }
            ?>
        </div>
    </div>

</body>

</html>