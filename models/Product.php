<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class Product extends BaseModel
{
    public function getAll() {
        $sql = "SELECT p.*, c.name cat_name FROM `products` 
            as p JOIN categories as c ON p.category_id = c.id
            ORDER BY p.id DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
