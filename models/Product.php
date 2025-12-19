<?php
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class Product extends BaseModel
{
    public function getAll()
    {
        $sql = "SELECT p.*, c.name cat_name FROM `products` 
            as p JOIN categories as c ON p.category_id = c.id
            ORDER BY p.id DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Lấy tất cả sản phẩm theo thứ tự truyền vào
     * Các giá trị sort: newest, price_asc, price_desc, name_asc, name_desc
     */
    public function getAllSorted($sort = 'newest')
    {
        switch ($sort) {
            case 'price_asc':
                $order = 'p.price ASC';
                break;
            case 'price_desc':
                $order = 'p.price DESC';
                break;
            case 'name_asc':
                $order = 'p.name ASC';
                break;
            case 'name_desc':
                $order = 'p.name DESC';
                break;
            case 'newest':
            default:
                $order = 'p.id DESC';
                break;
        }

        $sql = "SELECT p.*, c.name cat_name FROM `products` as p JOIN categories as c ON p.category_id = c.id ORDER BY " . $order . ";";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Lấy sản phẩm với bộ lọc và sắp xếp
     * $filters: ['category_id' => int|null, 'min_price' => float|null, 'max_price' => float|null, 'keyword' => string|null]
     */
    public function getFiltered($filters = [], $sort = 'newest')
    {
        $where = [];
        $params = [];

        if (!empty($filters['category_id'])) {
            $where[] = 'p.category_id = :category_id';
            $params[':category_id'] = (int)$filters['category_id'];
        }

        if (isset($filters['min_price']) && $filters['min_price'] !== '') {
            $where[] = 'p.price >= :min_price';
            $params[':min_price'] = $filters['min_price'];
        }

        if (isset($filters['max_price']) && $filters['max_price'] !== '') {
            $where[] = 'p.price <= :max_price';
            $params[':max_price'] = $filters['max_price'];
        }

        if (!empty($filters['keyword'])) {
            $where[] = '(p.name LIKE :kw OR p.description LIKE :kw)';
            $params[':kw'] = '%' . $filters['keyword'] . '%';
        }

        switch ($sort) {
            case 'price_asc':
                $order = 'p.price ASC';
                break;
            case 'price_desc':
                $order = 'p.price DESC';
                break;
            case 'name_asc':
                $order = 'p.name ASC';
                break;
            case 'name_desc':
                $order = 'p.name DESC';
                break;
            case 'newest':
            default:
                $order = 'p.id DESC';
                break;
        }

        $sql = "SELECT p.*, c.name cat_name FROM products AS p JOIN categories AS c ON p.category_id = c.id";
        if (!empty($where)) {
            $sql .= ' WHERE ' . implode(' AND ', $where);
        }
        $sql .= ' ORDER BY ' . $order;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm xóa dữ liệu
    public function delete($id)
    {
        try {
            $this->pdo->beginTransaction();

            // Delete related comments first to satisfy foreign key constraint
            $sqlComments = "DELETE FROM comments WHERE product_id = :id";
            $stmtC = $this->pdo->prepare($sqlComments);
            $stmtC->execute([':id' => $id]);

            // Then delete the product
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $res = $stmt->execute([':id' => $id]);

            $this->pdo->commit();
            return $res;
        } catch (Exception $e) {
            if ($this->pdo->inTransaction()) {
                $this->pdo->rollBack();
            }
            return false;
        }
    }

    // Hàm tìm bằng id
    public function find($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stms = $this->pdo->prepare($sql);
        $stms->execute([':id' => $id]);
        return $stms->fetch();
    }

    // Hàm thêm dữ liệu
    public function insert($data)
    {
        $sql = "INSERT INTO `products` (`category_id`, `name`, `description`, `price`, `quantity`, `img`, `view_count`) 
        VALUES (:category_id, :name, :description, :price, :quantity, :img, :view_count)";

        $stms = $this->pdo->prepare($sql);
        $stms->bindValue(':category_id', $data['category_id']);
        $stms->bindValue(':name', $data['name']);
        $stms->bindValue(':description', $data['description']);
        $stms->bindValue(':price', $data['price']);
        $stms->bindValue(':quantity', $data['quantity']);
        // Use 'img' key (controller sets 'img')
        $stms->bindValue(':img', $data['img'] ?? null);
        $stms->bindValue(':view_count', $data['view_count'] ?? 0, PDO::PARAM_INT);

        $stms->execute();
    }

    public function top4Lasted()
    {
        // $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
        // $stms = $this->pdo->prepare($sql);
        // $stms->execute();
        // return $stms->fetchAll();

        $sql = "SELECT 
                p.id, p.category_id, p.name, p.description, 
                p.price, p.quantity, p.img, p.view_count,
                c.name AS cat_name
            FROM products AS p
            LEFT JOIN categories AS c ON p.category_id = c.id
            ORDER BY p.id DESC LIMIT 4";

        $stms = $this->pdo->prepare($sql);
        $stms->execute();
        return $stms->fetchAll();
    }

    public function updateViewCount($id, $view_count)
    {
        $sql = "UPDATE products SET view_count = $view_count WHERE id = $id";
        $stml =  $this->pdo->prepare($sql);
        $stml->execute();
    }
    public function top4View()
    {
        $sql = "SELECT 
                p.id, p.category_id, p.name, p.description, 
                p.price, p.quantity, p.img, p.view_count,
                c.name AS cat_name
            FROM products AS p
            LEFT JOIN categories AS c ON p.category_id = c.id
            ORDER BY view_count DESC LIMIT 4";
        $stms = $this->pdo->prepare($sql);
        $stms->execute();
        return $stms->fetchAll();
    }

    public function search($keyword)
    {
        $search_term = trim((string)$keyword);
        if ($search_term === '') {
            return [];
        }

        $like = "%" . $search_term . "%";

        $sql = "SELECT 
                p.id, p.category_id, p.name, p.description, 
                p.price, p.quantity, p.img, p.view_count,
                c.name AS cat_name
            FROM products AS p
            LEFT JOIN categories AS c ON p.category_id = c.id
            WHERE p.name LIKE ? OR p.description LIKE ?
            ORDER BY p.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$like, $like]);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Cập nhật sản phẩm
     */
    public function update($id, $data)
    {
        // Build dynamic SQL: if img provided, update it; otherwise keep existing
        $sql = "UPDATE products SET category_id = :category_id, name = :name, description = :description, price = :price, quantity = :quantity";
        if (array_key_exists('img', $data)) {
            $sql .= ", img = :img";
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $data['category_id']);
        $stmt->bindValue(':name', $data['name']);
        $stmt->bindValue(':description', $data['description']);
        $stmt->bindValue(':price', $data['price']);
        $stmt->bindValue(':quantity', $data['quantity']);
        if (array_key_exists('img', $data)) {
            $stmt->bindValue(':img', $data['img']);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function countAll()
    {
        $sql = "SELECT COUNT(*) FROM products";
        try {
            $stmt = $this->pdo->query($sql);
            return (int)$stmt->fetchColumn();
        } catch (Exception $e) {
            return 0;
        }
    }
}
