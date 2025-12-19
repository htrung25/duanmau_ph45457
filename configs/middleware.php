<?php
// Simple middleware helpers
if (!function_exists('require_role')) {
    function require_role($role)
    {
        // If user not logged in or role mismatch, redirect to login (client login page)
        $user = $_SESSION['user'] ?? null;
        if (!$user || ($role && ($user['role'] ?? '') !== $role)) {
            $_SESSION['error'] = 'Bạn cần đăng nhập với quyền phù hợp để truy cập trang này.';
            header('Location: ' . BASE_URL . '?action=login');
            exit();
        }
    }
}

if (!function_exists('redirect_after_login')) {
    function redirect_after_login()
    {
        $user = $_SESSION['user'] ?? null;
        if (!$user) {
            header('Location: ' . BASE_URL);
            exit();
        }
        if (($user['role'] ?? '') === 'admin') {
            header('Location: ' . BASE_URL_ADMIN);
            exit();
        }
        header('Location: ' . BASE_URL);
        exit();
    }
}

if (!function_exists('require_auth')) {
    function require_auth($redirectTo = null)
    {
        if (empty($_SESSION['user'])) {
            // Save target to redirect back after login
            if ($redirectTo) {
                $_SESSION['redirect_after_login'] = $redirectTo;
            } else {
                // try to capture current full URL
                $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
                $host = $_SERVER['HTTP_HOST'] ?? '';
                $uri = $_SERVER['REQUEST_URI'] ?? '';
                $_SESSION['redirect_after_login'] = $scheme . '://' . $host . $uri;
            }
            $_SESSION['error'] = 'Vui lòng đăng nhập để tiếp tục.';
            header('Location: ' . BASE_URL . '?action=login');
            exit();
        }
    }
}

?>