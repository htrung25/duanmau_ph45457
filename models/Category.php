<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class Category extends BaseModel
{
    public function getAll() {
        $sql = "SELECT * FROM categories";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert($data)
    {
        // Insert name and optional description (some schemas require description NOT NULL)
        $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description'] ?? '');
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        // Update name and optional description if present
        $sql = "UPDATE categories SET name = :name";
        if (array_key_exists('description', $data)) {
            $sql .= ", description = :description";
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $data['name']);
        if (array_key_exists('description', $data)) {
            $stmt->bindValue(':description', $data['description']);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM categories";
        try {
            $stmt = $this->pdo->query($sql);
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }
}
?>