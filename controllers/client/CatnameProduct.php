<?php
class CatnameProduct{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }
    private function renderCategoryPage($slug, $title, $actionName)
    {
        $view = 'catname_product/' . $slug;
        $header = 'header';
        $title = $title;

        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
        $minPrice = isset($_GET['min_price']) ? trim($_GET['min_price']) : '';
        $maxPrice = isset($_GET['max_price']) ? trim($_GET['max_price']) : '';
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        // find category id by slug (match on category name)
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        $categoryId = null;
        foreach ($categories as $c) {
            if (stripos($c['name'], $slug) !== false || str_replace(' ', '', strtolower($c['name'])) === strtolower($slug)) {
                $categoryId = $c['id'];
                break;
            }
        }

        $filters = ['category_id' => $categoryId, 'min_price' => $minPrice, 'max_price' => $maxPrice, 'keyword' => $keyword];
        $allProducts = $this->productModel->getFiltered($filters, $sort);
        $currentSort = $sort;

        // variables for view: $allProducts, $currentSort, $minPrice, $maxPrice, $keyword, $actionName
        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function iphone(){
        $this->renderCategoryPage('iphone', 'Sản phẩm iPhone', 'catname_product_iphone');
    }
    public function oppo(){
        $this->renderCategoryPage('oppo', 'Sản phẩm Oppo', 'catname_product_oppo');
    }
    public function samsung(){
        $this->renderCategoryPage('samsung', 'Sản phẩm Samsung', 'catname_product_samsung');
    }
    public function asus(){
        $this->renderCategoryPage('asus', 'Sản phẩm Asus', 'catname_product_asus');
    }
    public function hp(){
        $this->renderCategoryPage('hp', 'Sản phẩm HP', 'catname_product_hp');
    }
    public function applewatch(){
        $this->renderCategoryPage('applewatch', 'Sản phẩm Apple Watch', 'catname_product_applewatch');
    }
}
?>