<?php

class DetailProductController{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function show(){
        $view = 'detail_product';
        $header = 'header';
        $title = 'Chi Tiết Sản Phẩm';
        $comments = [];
        try{
            if(!isset($_GET["id"])){
                throw new Exception("Khong tim thay tham so ID");
            }
            $id = $_GET["id"];
            //Lay thong tin chi tiet san Pham
            $pro = $this->productModel->find($id);
            if(empty($pro)){
                throw new Exception("Khong tim thay san pham voi ID = $id");
            }

            //Thuc hien cap nhat view_count
            $view_count = $pro['view_count'] + 1;
            //Goi CSDL de cap nhat view_count
            $this->productModel->updateViewCount($id, $view_count);
            // Load comments for this product (if model exists)
            if (class_exists('Comment')) {
                $commentModel = new Comment();
                $comments = $commentModel->getByProduct($id);
            }
        }catch (Exception $ex){
            throw new Exception("Thao tac xay ra loi");
        }
        require_once PATH_VIEW_CLIENT_MAIN;
    }

    public function postComment()
    {
        try {
            if (empty($_SESSION['user'])) {
                $_SESSION['error'] = 'Bạn cần đăng nhập để bình luận.';
                header('Location: ' . BASE_URL . '?action=login');
                exit();
            }

            $productId = intval($_POST['product_id'] ?? 0);
            $content = trim($_POST['content'] ?? '');
            if ($productId <= 0 || $content === '') {
                throw new Exception('Nội dung bình luận không được để trống.');
            }

            $commentModel = new Comment();
            $commentModel->create([
                'product_id' => $productId,
                'user_id' => $_SESSION['user']['id'],
                'content' => $content,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            header('Location: ' . BASE_URL . '?action=detail-product&id=' . $productId);
            exit();
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: ' . BASE_URL . '?action=detail-product&id=' . ($productId ?? ''));
            exit();
        }
    }
}
?>