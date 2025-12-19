<?php
class ListProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function list()
    {
        $view = 'listproduct';
        $header = 'header';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
        $categoryId = isset($_GET['category_id']) && $_GET['category_id'] !== '' ? (int)$_GET['category_id'] : null;
        $minPrice = isset($_GET['min_price']) ? trim($_GET['min_price']) : '';
        $maxPrice = isset($_GET['max_price']) ? trim($_GET['max_price']) : '';
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        // Load categories for filter dropdown
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $filters = ['category_id' => $categoryId, 'min_price' => $minPrice, 'max_price' => $maxPrice, 'keyword' => $keyword];
        $allProducts = $this->productModel->getFiltered($filters, $sort);
        $currentSort = $sort;
        require_once PATH_VIEW_CLIENT_MAIN;
    }
}
