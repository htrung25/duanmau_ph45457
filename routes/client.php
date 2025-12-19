<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'detail-product' => (new DetailProductController)->show(),
    'post_comment' => (new DetailProductController)->postComment(),
    'listproduct' => (new ListProductController)->list(),
    'search' => (new SearchProductController)->search(),
    'cart' => (new CartController)->cart(),
    'add_to_cart' => (new CartController)->add(),
    'update_cart' => (new CartController)->update(),
    'remove_from_cart' => (new CartController)->remove(),
    'checkout' => (new CheckoutController)->checkout(),
    'catname_product_hp'=> (new CatnameProduct())->hp(),
    'catname_product_oppo'=> (new CatnameProduct())->oppo(),
    'catname_product_samsung'=> (new CatnameProduct())->samsung(),
    'catname_product_asus'=> (new CatnameProduct())->asus(),
    'catname_product_iphone'=> (new CatnameProduct())->iphone(),
    'catname_product_appawatch'=> (new CatnameProduct())->applewatch(),
    'login' => (new AuthController())->showLogin(),
    'login_post' => (new AuthController())->login(),
    'register' => (new AuthController())->showRegister(),
    'register_post' => (new AuthController())->register(),
    'logout' => (new AuthController())->logout(),
    'account' => (new AuthController())->showProfile(),
    'account_update' => (new AuthController())->updateProfile(),
};