<?php
class CommentController
{
    private $commentModel;

    public function __construct()
    {
        $this->commentModel = new Comment();
    }

    public function index()
    {
        $view = 'comment/list_comment';
        $title = 'Quản lý bình luận';
        $data = $this->commentModel->getAll();
        require_once PATH_VIEW_ADMIN_MAIN;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'Thiếu id.';
            header('Location: ' . BASE_URL_ADMIN . '&action=list-comment');
            exit();
        }

        $this->commentModel->delete($id);
        $_SESSION['success'] = 'Xóa bình luận thành công.';
        header('Location: ' . BASE_URL_ADMIN . '&action=list-comment');
        exit();
    }
}
