<?php
class Comment extends BaseModel
{
    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM comments";
        try {
            $stmt = $this->pdo->query($sql);
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getByProduct($productId)
    {
        // Some schemas may not have created_at column; order by id as fallback
        $sql = "SELECT c.*, u.username FROM comments c LEFT JOIN users u ON c.user_id = u.id WHERE c.product_id = :pid ORDER BY c.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':pid', $productId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Insert comment according to schema: id, user_id, product_id, content, status
        // Default status to 1 (visible)
        $sql = "INSERT INTO comments (product_id, user_id, content, status) VALUES (:product_id, :user_id, :content, :status)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':product_id', $data['product_id'], PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':content', $data['content']);
        $stmt->bindValue(':status', $data['status'] ?? 1, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT c.*, p.name as product_name, u.username FROM comments c LEFT JOIN products p ON c.product_id = p.id LEFT JOIN users u ON c.user_id = u.id ORDER BY c.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
