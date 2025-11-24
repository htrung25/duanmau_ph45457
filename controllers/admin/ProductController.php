<?php
class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function dashboad() {
        $title = 'ĐÂY LÀ TRANG QUẢN TRỊ';
        require_once PATH_VIEW_ADMIN_MAIN;
    }
    
    public function index() {
        $view = 'product/index';
        $title = 'Danh sách sản phẩm';
        $data = $this->productModel->getAll();
        // var_dump($data);
        // die;
        require_once PATH_VIEW_ADMIN_MAIN;
    }
}
?>