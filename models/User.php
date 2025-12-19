<?php
class User extends BaseModel
{
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function findByUsername($username)
    {
        $sql = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function find($id)
    {
        $sql = "SELECT * FROM users WHERE id = ? LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (username, email, password, is_main) VALUES (:username, :email, :password, :is_main)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':username', $data['username']);
        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':password', $data['password']);
        $stmt->bindValue(':is_main', $data['is_main'] ?? 0, PDO::PARAM_INT);
        $stmt->execute();
        return $this->pdo->lastInsertId();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function updateIsMain($id, $is_main)
    {
        $sql = "UPDATE users SET is_main = :is_main WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':is_main', $is_main ? 1 : 0, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $fields = [];
        $params = [':id' => $id];

        if (isset($data['username'])) {
            $fields[] = 'username = :username';
            $params[':username'] = $data['username'];
        }
        if (isset($data['email'])) {
            $fields[] = 'email = :email';
            $params[':email'] = $data['email'];
        }
        if (isset($data['password']) && $data['password'] !== '') {
            $fields[] = 'password = :password';
            $params[':password'] = $data['password'];
        }
        if (isset($data['is_main'])) {
            $fields[] = 'is_main = :is_main';
            $params[':is_main'] = $data['is_main'] ? 1 : 0;
        }

        if (empty($fields)) return false;

        $sql = 'UPDATE users SET ' . implode(', ', $fields) . ' WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM users";
        try {
            $stmt = $this->pdo->query($sql);
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }
}
