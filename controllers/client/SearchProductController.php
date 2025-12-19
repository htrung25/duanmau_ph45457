<?php
 class SearchProductController{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function search()
    {
        $header = 'header';
        $view = 'searchproduct';
        $title = 'Tìm kiếm sản phẩm';
        $search_term = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
        $products = $this->productModel->search($search_term);
        require_once PATH_VIEW_CLIENT_MAIN;
    }
 }
?>