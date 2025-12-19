<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
        $view = 'user/list_user';
        $title = 'Danh sách tài khoản';
        $data = $this->userModel->getAll();
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function create()
    {
        $view = 'user/create';
        $title = 'Tạo tài khoản mới';
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function store()
    {
        try {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $is_main = isset($_POST['is_main']) ? 1 : 0;

            if ($username === '' || $email === '' || $password === '') throw new Exception('Vui lòng điền đủ thông tin.');
            if ($this->userModel->findByEmail($email)) throw new Exception('Email đã tồn tại.');
            if ($this->userModel->findByUsername($username)) throw new Exception('Tên người dùng đã tồn tại.');

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->create(['username' => $username, 'email' => $email, 'password' => $hashed, 'is_main' => $is_main]);
            $_SESSION['success'] = 'Tạo tài khoản thành công.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=create-user');
            exit();
        }
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'Thiếu id.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit();
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            $_SESSION['error'] = 'Tài khoản không tồn tại.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit();
        }

        $view = 'user/edit';
        $title = 'Sửa tài khoản';
        $data = $user;
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function update()
    {
        try {
            $id = $_POST['id'] ?? null;
            if (!$id) throw new Exception('Thiếu id.');

            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $is_main = isset($_POST['is_main']) ? 1 : 0;

            if ($username === '' || $email === '') throw new Exception('Tên và email không được để trống.');

            $updateData = ['username' => $username, 'email' => $email, 'is_main' => $is_main];
            if ($password !== '') {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->userModel->update($id, $updateData);
            $_SESSION['success'] = 'Cập nhật tài khoản thành công.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL_ADMIN . '&action=edit-user&id=' . ($id ?? ''));
            exit();
        }
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'Thiếu id.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit();
        }

        $this->userModel->delete($id);
        $_SESSION['success'] = 'Xóa tài khoản thành công.';
        header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
        exit();
    }
}
