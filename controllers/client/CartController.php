<?php

class CartController{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new Product();
    }
    public function cart()
    {
        $view = 'cart';
        $header = 'header';
        $title = 'Giỏ hàng của bạn';
        // prepare cart data from session
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        $shipping = $total > 0 ? 30000 : 0; // ví dụ phí cố định
        $grand_total = $total + $shipping;

        require_once PATH_VIEW_CLIENT_MAIN;
    }

    // add product to cart
    public function add()
    {
        // Require login before adding to cart
        require_once PATH_ROOT . 'configs/middleware.php';
        require_auth();
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $qty = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
        if ($id <= 0) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $product = $this->productModel->find($id);
        if (!$product) {
            header('Location: ' . BASE_URL);
            exit;
        }

        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity'] += $qty;
        } else {
            $_SESSION['cart'][$id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => (float)$product['price'],
                'img' => BASE_ASSETS_UPLOADS . $product['img'],
                'quantity' => $qty,
            ];
        }

        header('Location: ' . BASE_URL . '?action=cart');
        exit;
    }

    // update quantities or remove
    public function update()
    {
        // handles increase/decrease or direct quantity update via POST
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $action = $_POST['action'] ?? '';

        if ($id <= 0 || !isset($_SESSION['cart'][$id])) {
            header('Location: ' . BASE_URL . '?action=cart');
            exit;
        }

        if ($action === 'increase') {
            $_SESSION['cart'][$id]['quantity'] += 1;
        } elseif ($action === 'decrease') {
            $_SESSION['cart'][$id]['quantity'] = max(1, $_SESSION['cart'][$id]['quantity'] - 1);
        } elseif ($action === 'set') {
            $q = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
            $_SESSION['cart'][$id]['quantity'] = $q;
        }

        header('Location: ' . BASE_URL . '?action=cart');
        exit;
    }

    public function remove()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0 && isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: ' . BASE_URL . '?action=cart');
        exit;
    }
}
?>