<?php
class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function showLogin()
    {
        $view = 'auth/login';
        $title = 'Đăng nhập';
        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function login()
    {
        try {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            if ($email === '' || $password === '') throw new Exception('Email và mật khẩu là bắt buộc.');

            $user = $this->userModel->findByEmail($email);

            // Logging for debug (safe: do not log raw password)
            $logDir = __DIR__ . '/../../storage/logs';
            if (!is_dir($logDir)) {
                @mkdir($logDir, 0755, true);
            }
            $storedHash = $user['password'] ?? '';
            $isFound = $user ? 'yes' : 'no';
            $isAdminDb = isset($user['is_main']) ? (int)$user['is_main'] : (isset($user['is_admin']) ? (int)$user['is_admin'] : 0);
            $verify = $user ? (password_verify($password, $storedHash) ? 'pass' : 'fail') : 'n/a';
            $logLine = sprintf("[%s] login attempt: email=%s, found=%s, verify=%s, is_main=%s, db=%s\n", date('c'), $email, $isFound, $verify, $isAdminDb, defined('DB_NAME') ? DB_NAME : 'unknown');
            @file_put_contents($logDir . '/login_debug.log', $logLine, FILE_APPEND);

            if (!$user) {
                throw new Exception('Email không tồn tại.');
            }
            if (!password_verify($password, $storedHash)) {
                throw new Exception('Mật khẩu không đúng.');
            }

            // Login success - set session and role
            $isAdmin = (int)($user['is_main'] ?? 0) === 1;
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'is_main' => $isAdmin ? 1 : 0,
                'role' => $isAdmin ? 'admin' : 'user'
            ];

            // redirect back to previous page if set; otherwise send admin to admin area
            $redirect = $_SESSION['redirect_after_login'] ?? null;
            unset($_SESSION['redirect_after_login']);
            if ($redirect) {
                header('Location: ' . $redirect);
            } else {
                if ($isAdmin) {
                    header('Location: ' . BASE_URL_ADMIN);
                } else {
                    header('Location: ' . BASE_URL);
                }
            }
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '?action=login');
            exit();
        }
    }

    public function showRegister()
    {
        $view = 'auth/register';
        $title = 'Đăng ký';
        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function register()
    {
        try {
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if ($username === '' || $email === '' || $password === '') throw new Exception('Vui lòng điền đủ thông tin.');
            if ($password !== $password_confirm) throw new Exception('Mật khẩu xác nhận không khớp.');

            if ($this->userModel->findByEmail($email)) throw new Exception('Email đã được sử dụng.');
            if ($this->userModel->findByUsername($username)) throw new Exception('Tên người dùng đã được sử dụng.');

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $this->userModel->create(['username' => $username, 'email' => $email, 'password' => $hashed, 'is_main' => 0]);

            $_SESSION['success'] = 'Đăng ký thành công. Vui lòng đăng nhập.';
            header('Location: ' . BASE_URL . '?action=login');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '?action=register');
            exit();
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: ' . BASE_URL);
        exit();
    }

    public function showProfile()
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'] ?? BASE_URL;
            header('Location: ' . BASE_URL . '?action=login');
            exit();
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->find($userId);

        $view = 'account';
        $title = 'Thông tin tài khoản';
        $data = $user;
        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function updateProfile()
    {
        try {
            if (empty($_SESSION['user'])) {
                throw new Exception('Bạn cần đăng nhập.');
            }

            $userId = $_SESSION['user']['id'];
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $email === '') throw new Exception('Tên và email không được để trống.');

            $existing = $this->userModel->findByEmail($email);
            if ($existing && $existing['id'] != $userId) throw new Exception('Email đã được sử dụng bởi tài khoản khác.');

            $existingUser = $this->userModel->findByUsername($username);
            if ($existingUser && $existingUser['id'] != $userId) throw new Exception('Tên người dùng đã được sử dụng bởi tài khoản khác.');

            $updateData = ['username' => $username, 'email' => $email];
            if ($password !== '') {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->userModel->update($userId, $updateData);

            // Update session info
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['email'] = $email;

            $_SESSION['success'] = 'Cập nhật thông tin thành công.';
            header('Location: ' . BASE_URL . '?action=account');
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '?action=account');
            exit();
        }
    }
}
