<?php
class ProductController {
    private $productModel;
    private $catModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->catModel = new Category();
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

    public function delete() {
        try {
            if (!isset($_GET["id"])) {
                throw new Exception("Thiếu tham số id");
            }
            $id = $_GET["id"];
            $pro = $this->productModel->find($id);
            if ($pro) {
                // thực hiện xóa nếu $pro tồn tại trong CSDL
                $this->productModel->delete($id);
            } else {
                throw new Exception("Không có sản phẩm ID = $id");
            }
        } catch(Exception $ex) {
            throw new Exception('Thao tác xóa không thành công');
        } 
    }

    // Hiển trị trang tạo mới
    public function create() {
        $view = 'product/create';
        $title = 'Tạo mới sản phẩm';
        $categories = $this->catModel->getAll();
        // var_dump($categories);

        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function store() {
        try {
            $data = $_POST + $_FILES;
            // Xử lý ảnh
            if ($data["image"]["size"] > 0) {
                // Lưu file vào thư mục chỉ định, và thay thế image = đường dẫn ảnh
                $data["image"] = upload_file('products', $data["image"]);
            } else {
                $data["image"] = null;
            }
            // Lưu giá trị vào CSDL
            $this->productModel->insert($data);
        } catch (Exception $ex) {
            throw new Exception("Thao tác tạo mới không thành công");
        }
        header('Location:' .BASE_URL_ADMIN .'&action=create-product');
        exit();
    }
}
?>