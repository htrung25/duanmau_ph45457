<?php
class ProductController
{
    private $productModel;
    private $catModel;

    public function __construct()
    {
        $this->productModel = new Product();
        $this->catModel = new Category();
    }

    public function dashboad()
    {
        $title = 'Dashboard';

        // prepare counts
        $counts = [];
        $counts['products'] = $this->productModel->countAll();

        $catModel = new Category();
        $counts['categories'] = $catModel->countAll();

        $userModel = new User();
        $counts['users'] = $userModel->countAll();

        // comments may not exist; use Comment model which returns 0 on error
        $commentModel = new Comment();
        $counts['comments'] = $commentModel->countAll();

        $view = 'dashboard';
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function index()
    {
        $view = 'product/index';
        $title = 'Danh sách sản phẩm';
        $data = $this->productModel->getAll();
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function delete()
    {
        try {
            if (!isset($_GET["id"])) {
                throw new Exception("Thiếu tham số id");
            }
            $id = $_GET["id"];
            $pro = $this->productModel->find($id);
            if ($pro) {
                // thực hiện xóa nếu $pro tồn tại trong CSDL
                $deleted = $this->productModel->delete($id);
                if (!$deleted) {
                    throw new Exception('Xóa sản phẩm không thành công.');
                }
            } else {
                throw new Exception("Không có sản phẩm ID = $id");
            }
        } catch (Exception $ex) {
            $_SESSION['error'] = $ex->getMessage();
            header('Location:' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        }
        header('Location:' . BASE_URL_ADMIN . '&action=list-product');
        exit();
    }

    // Hiển trị trang tạo mới
    public function create()
    {
        $view = 'product/create';
        $title = 'Tạo mới sản phẩm';
        $categories = $this->catModel->getAll();
        // var_dump($categories);

        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số id');
            }

            $id = intval($_GET['id']);
            $pro = $this->productModel->find($id);
            if (!$pro) {
                throw new Exception("Không tìm thấy sản phẩm với id = $id");
            }

            $categories = $this->catModel->getAll();
            $view = 'product/edit';
            $title = 'Sửa sản phẩm';
            $data = ['product' => $pro, 'categories' => $categories];
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        }
    }

    public function update()
    {
        try {
            $id = intval($_POST['id'] ?? 0);
            if ($id <= 0) throw new Exception('Thiếu id.');

            $name        = trim($_POST['name'] ?? '');
            $description = $_POST['description'] ?? '';
            $price       = floatval($_POST['price'] ?? 0);
            $quantity    = intval($_POST['quantity'] ?? 0);
            $category_id = intval($_POST['category_id'] ?? 0);

            if (empty($name)) throw new Exception('Tên sản phẩm không được để trống.');

            // Get existing product
            $pro = $this->productModel->find($id);
            if (!$pro) throw new Exception('Sản phẩm không tồn tại.');

            // Handle image upload if provided
            $img_path = $pro['img'] ?? null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $new = $this->uploadProductImage($_FILES['img']);
                if ($new === false) {
                    throw new Exception('Upload ảnh thất bại.');
                }
                $img_path = $new;
            }

            $data = [
                'category_id' => $category_id,
                'name' => $name,
                'description' => $description,
                'price' => $price,
                'quantity' => $quantity,
            ];
            if ($img_path !== null) $data['img'] = $img_path;

            $this->productModel->update($id, $data);
            $_SESSION['success'] = 'Cập nhật sản phẩm thành công.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=edit-product&id=' . ($id ?? ''));
            exit();
        }
    }

    public function show()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số id');
            }

            $id = intval($_GET['id']);
            $pro = $this->productModel->find($id);
            if (!$pro) {
                throw new Exception("Không tìm thấy sản phẩm với id = $id");
            }

            // Lấy tên danh mục nếu cần
            $cat = $this->catModel->find($pro['category_id']);
            $pro['cat_name'] = $cat['name'] ?? '';

            $view = 'product/show';
            $title = 'Chi tiết sản phẩm';
            $data = $pro;
            require_once PATH_VIEW_ADMIN_MAIN;
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        }
    }

    public function store()
    {
        try {
            // Lấy dữ liệu từ form POST
            $name        = trim($_POST['name'] ?? '');
            $description = $_POST['description'] ?? '';
            $price       = floatval($_POST['price'] ?? 0);
            $quantity    = intval($_POST['quantity'] ?? 0);
            $category_id = intval($_POST['category_id'] ?? 0);

            // Validate dữ liệu bắt buộc
            if (empty($name)) {
                throw new Exception("Tên sản phẩm không được để trống.");
            }
            if ($price <= 0) {
                throw new Exception("Giá sản phẩm phải lớn hơn 0.");
            }
            if ($quantity < 0) {
                throw new Exception("Số lượng không hợp lệ.");
            }
            if ($category_id <= 0) {
                throw new Exception("Vui lòng chọn danh mục sản phẩm.");
            }

            // Xử lý upload ảnh
            // Xử lý ảnh
            $img_path = null;
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $img_path = $this->uploadProductImage($_FILES['img']);

                if ($img_path === false) {
                    throw new Exception("Upload ảnh thất bại. Vui lòng thử lại hoặc kiểm tra tên folder project trong đường dẫn tuyệt đối.");
                }
            }

            // Chuẩn bị dữ liệu để insert vào database
            $data = [
                'name'        => $name,
                'description' => $description,
                'price'       => $price,
                'quantity'    => $quantity,
                'category_id' => $category_id,
                'img'         => $img_path,          // ← Đường dẫn ảnh: assets/uploads/products/ten-file.webp
                'view_count'  => 0
            ];

            // Gọi model để insert vào database
            $this->productModel->insert($data);

            // Thành công → thông báo và redirect
            $_SESSION['success'] = "Thêm sản phẩm thành công!";
            header('Location: ' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        } catch (Exception $e) {
            // Có lỗi → lưu thông báo và quay lại form thêm
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=list-product');
            exit();
        }
    }

    /**
     * Hàm upload ảnh sản phẩm (đặt trong cùng controller hoặc helper)
     */
    private function uploadProductImage($file)
    {
        // Thư mục upload trên hệ thống file (đúng với PATH_ASSETS_UPLOADS)
        $upload_dir = PATH_ASSETS_UPLOADS . 'products/';

        // Tạo thư mục nếu chưa có
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Kiểm tra định dạng và kích thước
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            return false;
        }

        if ($file['size'] > 5 * 1024 * 1024) { // 5MB
            return false;
        }

        // Tên file mới
        $new_name = 'product_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $destination = $upload_dir . $new_name;

        // Thực hiện move
        move_uploaded_file($file['tmp_name'], $destination);

        // KIỂM TRA THỰC TẾ: File có tồn tại trong thư mục không?
        if (file_exists($destination)) {
            // Trả về đường dẫn tương đối phù hợp để lưu vào DB
            // Views dùng `BASE_ASSETS_UPLOADS . $pro['img']`, nên lưu `products/filename`
            return 'products/' . $new_name;
        }

        return false;
    }
}
