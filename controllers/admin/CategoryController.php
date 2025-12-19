<?php
class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $view = 'category/list_category';
        $title = 'Danh sách danh mục';
        $data = $this->categoryModel->getAll();
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function create()
    {
        $view = 'category/create';
        $title = 'Tạo mới danh mục';
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function store()
    {
        // Debug: ensure storage dir exists
        $logDir = PATH_ROOT . 'storage/logs/';
        if (!is_dir($logDir)) {
            @mkdir($logDir, 0777, true);
        }
        @file_put_contents($logDir . 'category_debug.log', "---- STORE called at " . date('c') . "\n", FILE_APPEND);
        @file_put_contents($logDir . 'category_debug.log', "REQUEST_METHOD=" . ($_SERVER['REQUEST_METHOD'] ?? '') . "\n", FILE_APPEND);
        @file_put_contents($logDir . 'category_debug.log', "POST=" . print_r($_POST, true) . "\n", FILE_APPEND);

        try {
            $name = trim($_POST['name'] ?? '');
            if ($name === '') {
                throw new Exception('Tên danh mục không được để trống.');
            }

            $description = trim($_POST['description'] ?? '');
            $this->categoryModel->insert(['name' => $name, 'description' => $description]);
            @file_put_contents($logDir . 'category_debug.log', "INSERT OK for name={$name}\n", FILE_APPEND);
            $_SESSION['success'] = 'Thêm danh mục thành công.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
            exit();
        } catch (Exception $e) {
            @file_put_contents($logDir . 'category_debug.log', "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n", FILE_APPEND);
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=create-category');
            exit();
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'Thiếu id danh mục.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
            exit();
        }

        $category = $this->categoryModel->find($id);
        if (!$category) {
            $_SESSION['error'] = 'Danh mục không tồn tại.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
            exit();
        }

        $view = 'category/edit';
        $title = 'Sửa danh mục';
        $data = $category;
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function update()
    {
        try {
            $id = $_POST['id'] ?? null;
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            if (!$id) throw new Exception('Thiếu id.');
            if ($name === '') throw new Exception('Tên danh mục không được để trống.');

            $this->categoryModel->update($id, ['name' => $name, 'description' => $description]);
            $_SESSION['success'] = 'Cập nhật danh mục thành công.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=edit-category&id=' . ($id ?? ''));
            exit();
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'Thiếu id.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
            exit();
        }

        $this->categoryModel->delete($id);
        $_SESSION['success'] = 'Xóa danh mục thành công.';
        header('Location: ' . BASE_URL_ADMIN . '&action=list-category');
        exit();
    }
}