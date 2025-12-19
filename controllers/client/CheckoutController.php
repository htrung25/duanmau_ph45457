<?php
class CheckoutController{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function checkout(){
        $view = 'checkout';
        $header = 'header';
        $cart = $_SESSION['cart'] ?? [];
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['price'] * $item['quantity']);
        }
        $shipping = $total > 0 ? 30000 : 0; // ví dụ phí cố định
        $grand_total = $total + $shipping;
        require_once PATH_VIEW_CLIENT_MAIN;
    }
}
?>